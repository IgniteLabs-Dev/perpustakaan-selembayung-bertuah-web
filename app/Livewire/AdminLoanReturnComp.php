<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use App\Models\LoanTransaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class AdminLoanReturnComp extends Component
{
    use WithPagination;
    public $user_id, $book_id, $status, $borrowed_at, $returned_at, $due_date, $condition, $fine, $point, $cover, $userName, $bookTitle;
    public $search;
    public $confirmDelete;
    public $editId;
    public $dataShow, $showId;
    public $users;
    public $jenis = 'literasi';
    public $books;
    public $roleFilter;
    public $typeFilter;
    public $timeFilter;
    public $finePoint;
    public $conditionFilter;
    public $statusFilter;
    public $editUser = false;
    public $editBook = false;

    public function mount()
    {
        $this->users = User::whereIn('role', ['siswa', 'guru'])->get();
        $this->books = Book::all();
    }

    public function render()
    {
        $data = LoanTransaction::where(function ($query) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->orWhereHas('book', function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            });
        })
            ->when($this->conditionFilter, function ($query) {
                $query->where('condition', $this->conditionFilter);
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->roleFilter, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('role', $this->roleFilter);
                });
            })
            ->when($this->typeFilter, function ($query) {
                $query->whereHas('book', function ($q) {
                    $q->where('type', $this->typeFilter);
                });
            })
            ->when($this->timeFilter, function ($query) {
                switch ($this->timeFilter) {
                    case 'hari_ini':
                        $query->whereDate('borrowed_at', now()->toDateString());
                        break;
                    case 'mingguan':
                        $query->whereBetween('borrowed_at', [
                            now()->startOfWeek(),
                            now()->endOfWeek()
                        ]);
                        break;
                    case 'bulanan':
                        $query->whereBetween('borrowed_at', [
                            now()->startOfMonth(),
                            now()->endOfMonth()
                        ]);
                        break;
                    case 'tahunan':
                        $query->whereBetween('borrowed_at', [
                            now()->startOfYear(),
                            now()->endOfYear()
                        ]);
                        break;
                    default:
                        break;
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);




        $this->countFinePoint();
        return view('livewire.admin-loan-return-comp', compact('data'))->extends('layouts.master-admin');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedJenis()
    {
        if ($this->jenis == 'paketan') {
            $this->due_date = Carbon::now()->addYears(2)->format('Y-m-d');
        } else {
            $this->due_date = null;
        }
    }
    public function resetInput()
    {

        $this->editId = '';
        $this->user_id = '';
        $this->book_id = '';
        $this->status = '';
        $this->borrowed_at = '';
        $this->returned_at = '';
        $this->due_date = '';
        $this->condition = '';
        $this->fine = '';
        $this->point = '';
        $this->jenis = '';
        $this->dataShow = null;
        $this->userName = '';
        $this->bookTitle = '';
        $this->bookTitle = '';
        $this->editUser = false;
        $this->editBook = false;
        $this->dispatch('resetTomSelect');

        $this->resetValidation();
    }
    public function edit($id)
    {
        $this->editId = $id;
        $data = LoanTransaction::find($id);
        $this->user_id = $data->user_id;
        $this->book_id = $data->book_id;
        $this->status = $data->status;
        $this->borrowed_at = $data->borrowed_at;
        $this->returned_at = $data->returned_at;
        $this->due_date = $data->due_date;
        $this->condition = $data->condition;
        $this->userName = $data->user->name;
        $this->bookTitle = $data->book->title;
        $this->editUser = true;
        $this->editBook = true;
    }

    public function show($id)
    {
        $this->showId = $id;
        $this->dataShow = LoanTransaction::find($id);
        $this->returned_at = $this->dataShow->returned_at;
        $this->due_date = $this->dataShow->due_date;
        $this->status = 'returned';
    }

    public function countFinePoint()
    {
        if ($this->status === 'returned' && $this->returned_at != null) {
            $returnedAt = Carbon::parse($this->returned_at);
            $dueDate = Carbon::parse($this->due_date);
            if ($this->condition === 'hilang') {
                $this->fine = 25; // Hilang → -25
                $this->point = 0;
            } elseif ($returnedAt <= $dueDate && $this->condition === 'baik') {
                $this->fine = 0;
                $this->point = 10; // Tepat waktu
            } elseif ($returnedAt->diffInDays($dueDate) <= 3 && $this->condition === 'baik') {
                $this->fine = 5; // Terlambat 1-3 hari 
                $this->point = 0;
            } elseif ($returnedAt->diffInDays($dueDate) > 3 && $this->condition === 'baik') {
                $this->fine = 10; // Terlambat >3 hari 
                $this->point = 0;
            } elseif ($this->condition === 'rusak' && $returnedAt <= $dueDate) {
                $this->fine = 15; // Rusak dan tepat waktu
                $this->point = 0;
            } elseif ($this->condition === 'rusak' && $returnedAt->diffInDays($dueDate) <= 3) {
                $this->fine = 20; // Rusak dan telat kurang dari 3 hari
                $this->point = 0;
            } elseif ($this->condition === 'rusak' && $returnedAt->diffInDays($dueDate) > 3) {
                $this->fine = 25; // Rusak dan telat lebih dari 3 hari
                $this->point = 0;
            }
        } else {
            $this->fine = 0;
            $this->point = 0;
        }
        $this->finePoint = max($this->fine, $this->point);
        if ($this->fine == 0) {
            $this->finePoint = '+' . $this->finePoint;
        } elseif ($this->fine != 0) {
            $this->finePoint = '-' . $this->finePoint;
        }
    }
    public function storeEdit()
    {
        $this->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'status' => 'required',
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrowed_at',
        ], [
            'user_id.required' => 'Siswa harus dipilih.',
            'book_id.required' => 'Buku harus dipilih.',
            'status.required' => 'Status harus diisi.',
            'borrowed_at.required' => 'Tanggal peminjaman harus diisi.',
            'due_date.required' => 'Tanggal jatuh tempo harus diisi.',
            'due_date.after_or_equal' => 'Tanggal jatuh tempo harus setelah tanggal peminjaman.',
        ]);

        $id = $this->editId;
        $data = LoanTransaction::find($id);
        $book = Book::find($this->book_id);
        $loaned = LoanTransaction::where('status', 'borrowed')
            ->where('book_id', $this->book_id)
            ->count();


        if (($book->stock - $loaned) <= 0 && ($data->book_id != $this->book_id)) {
            throw ValidationException::withMessages([
                'book_id' => 'Semua buku ini sedang dipinjam.'
            ]);
        }



        $data->user_id = $this->user_id;
        $data->book_id = $this->book_id;
        $data->status = $this->status;
        $data->borrowed_at = $this->borrowed_at;
        $data->returned_at = $this->returned_at;
        $data->due_date = $this->due_date;
        $data->condition = $this->condition;
        $data->fine = preg_replace('/[^0-9]/', '', $this->fine);
        $data->point = preg_replace('/[^0-9]/', '', $this->point);

        if ($data->save()) {
            LivewireAlert::title('Data Berhasil Diubah!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();

            $this->dispatch('close-modal');
            $this->resetInput();
        } else {
            LivewireAlert::title('Data Gagal Diubah!')
                ->position('top-end')
                ->toast()
                ->error()
                ->show();
        }
    }
    public function storeReturn()
    {
        $this->validate([
            'status' => 'required',
            'returned_at' => 'required',
            'condition' => 'required',
        ], [
            'status.required' => 'Status harus diisi.',
            'returned_at.required' => 'Tanggal pengembalian harus diisi.',
            'condition.required' => 'Kondisi buku harus diisi.',
        ]);

        $id = $this->showId;
        $data = LoanTransaction::find($id);
        $data->status = $this->status;
        $data->returned_at = $this->returned_at;
        $data->condition = $this->condition;
        $data->fine = preg_replace('/[^0-9]/', '', $this->fine);
        $data->point = preg_replace('/[^0-9]/', '', $this->point);

        if ($data->save()) {
            LivewireAlert::title('Data Berhasil Diubah!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();

            $this->dispatch('close-modal2');
            $this->resetInput();
        } else {
            LivewireAlert::title('Data Gagal Diubah!')
                ->position('top-end')
                ->toast()
                ->error()
                ->show();
        }
    }
    public function resetFilter()
    {
        $this->conditionFilter = '';
        $this->statusFilter = '';
        $this->search = '';
        $this->resetPage();
    }
    public function storeCreate()
    {
        $this->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'borrowed_at' => 'required',
            'due_date' => 'nullable|date|after_or_equal:borrowed_at',
        ], [
            'user_id.required' => 'User harus dipilih.',
            'book_id.required' => 'Buku harus dipilih.',
            'borrowed_at.required' => 'Tanggal peminjaman harus diisi.',
            'due_date.after_or_equal' => 'Tanggal jatuh tempo harus setelah tanggal peminjaman.',
        ]);



        $book = Book::find($this->book_id);
        $loaned = LoanTransaction::where('status', 'borrowed')
            ->where('book_id', $this->book_id)
            ->count();


        if ($book->stock - $loaned <= 0) {
            throw ValidationException::withMessages([
                'book_id' => 'Semua buku ini sedang dipinjam.'
            ]);
        }



        $data = new LoanTransaction();
        $data->user_id = $this->user_id;
        $data->book_id = $this->book_id;
        $data->borrowed_at = $this->borrowed_at;
        if ($this->due_date == null) {
            $data->due_date = Carbon::now()->addYears(2)->format('Y-m-d');
        }
        $data->book->stock = 'borrowed';

        if ($data->save()) {
            LivewireAlert::title('Data Berhasil Ditambah!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();

            $this->dispatch('close-modal');
            $this->resetInput();
        } else {
            LivewireAlert::title('Data Gagal Ditambah!')
                ->position('top-end')
                ->toast()
                ->error()
                ->show();
        }
    }



    public function delete($id)
    {
        $data = LoanTransaction::where('id', $id)->first();
        if ($data->delete()) {
            LivewireAlert::title('Data berhasil dihapus!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();
        } else {
            LivewireAlert::title('Data gagal dihapus!')
                ->position('top-end')
                ->toast()
                ->error()
                ->show();
        }
    }
    public function endLoan(){
        $this->returned_at = Carbon::now()->format('Y-m-d');
    }
}
