<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthors;
use App\Models\BookCategories;
use App\Models\Category;
use App\Models\LoanTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class AdminBookComp extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search;
    public $tipeFilter;
    public $category;
    public $cover, $title, $deskripsi, $author, $publisher, $category_id, $realese_date, $stock, $status, $type;
    public $editId;
    public $showId;
    public $confirmDelete;
    // public $zoomImage;

    public $authorsShow = null;
    public $authorsData = null;
    public $authorsAdd = [];
    public $authorsDelete = [];
    public $authorsNew = [];

    public $categoriesShow = null;
    public $categoriesData = null;
    public $categoriesAdd = [];
    public $categoriesDelete = [];
    public $categoriesNew = [];
    public $image_baru;


    public function render()
    {
        $data = Book::select('books.*')
            ->addSelect(DB::raw('(
        SELECT GROUP_CONCAT(authors.name SEPARATOR ", ") 
        FROM book_authors 
        JOIN authors ON authors.id = book_authors.author_id 
        WHERE book_authors.book_id = books.id
    ) as authors'))
            ->addSelect(DB::raw('(
        SELECT GROUP_CONCAT(categories.name SEPARATOR ", ") 
        FROM book_categories 
        JOIN categories ON categories.id = book_categories.category_id 
        WHERE book_categories.book_id = books.id
    ) as categories'))
            ->leftJoinSub(
                LoanTransaction::where('status', 'borrowed')
                    ->selectRaw('book_id, COUNT(*) as total')
                    ->groupBy('book_id'),
                'loaned',
                'books.id',
                '=',
                'loaned.book_id'
            )
            ->selectRaw('COALESCE(books.stock - loaned.total, books.stock) as available_stock') // Kurangi stok
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%$search%")
                        ->orWhere('publisher', 'like', "%$search%")
                        ->orWhereExists(function ($subquery) use ($search) {
                            $subquery->select(DB::raw(1))
                                ->from('book_authors')
                                ->join('authors', 'authors.id', '=', 'book_authors.author_id')
                                ->whereColumn('book_authors.book_id', 'books.id')
                                ->where('authors.name', 'like', "%$search%");
                        })
                        ->orWhereExists(function ($subquery) use ($search) {
                            $subquery->select(DB::raw(1))
                                ->from('book_categories')
                                ->join('categories', 'categories.id', '=', 'book_categories.category_id')
                                ->whereColumn('book_categories.book_id', 'books.id')
                                ->where('categories.name', 'like', "%$search%");
                        });
                });
            })
            ->when($this->author, function ($query) {
                $query->whereExists(function ($subquery) {
                    $subquery->select(DB::raw(1))
                        ->from('book_authors')
                        ->whereColumn('book_authors.book_id', 'books.id')
                        ->where('book_authors.author_id', $this->author);
                });
            })
            ->when($this->category, function ($query) {
                $query->whereExists(function ($subquery) {
                    $subquery->select(DB::raw(1))
                        ->from('book_categories')
                        ->whereColumn('book_categories.book_id', 'books.id')
                        ->where('book_categories.category_id', $this->category);
                });
            })
            ->when($this->tipeFilter, function ($query) {
                $query->where('type', $this->tipeFilter);
            })
            ->orderby('created_at', 'desc')
            ->paginate('10');



        return view('livewire.admin-book-comp', compact('data'))->extends('layouts.master-admin');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function addToDeleteAuthor($id)
    {
        if (!in_array($id, $this->authorsDelete)) {
            $this->authorsDelete[] = $id;
        }
    }
    public function removeToDeleteAuthor($id)
    {
        if (($key = array_search($id, $this->authorsDelete)) !== false) {
            unset($this->authorsDelete[$key]);
        }
    }

    public function addToDeleteCategory($id)
    {
        if (!in_array($id, $this->categoriesDelete)) {
            $this->categoriesDelete[] = $id;
        }
    }
    public function removeToDeleteCategory($id)
    {
        if (($key = array_search($id, $this->categoriesDelete)) !== false) {
            unset($this->categoriesDelete[$key]);
        }
    }

    public function create()
    {
        $this->categoriesData = Category::all();
        $this->authorsData = Author::all();
    }

    public function storeCreate()
    {
        $this->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'publisher' => 'required',
            'stock' => 'required|numeric',
            'status' => 'required',
            'type' => 'required',
        ], [
            'title.required' => 'Judul buku wajib diisi.',
            'deskripsi.required' => 'Deskripsi buku wajib diisi.',
            'publisher.required' => 'Penerbit buku wajib diisi.',
            'stock.required' => 'Stok buku wajib diisi.',
            'stock.numeric' => 'Stok buku harus berupa angka.',
            'status.required' => 'Status buku wajib diisi.',
            'type.required' => 'Tipe buku wajib diisi.',
        ]);

        $data = new Book();
        $data->title = $this->title;
        $data->deskripsi = $this->deskripsi;
        $data->publisher = $this->publisher;
        $data->realese_date = $this->realese_date;
        $data->stock = $this->stock;
        $data->status = $this->status;
        $data->type = $this->type;




        $currentTimestamp = time();
        if ($this->image_baru != null) {
            $this->validate([
                'image_baru' => 'mimes:png,jpg,jpeg,webp|max:1096', // 1MB Max
            ]);

            $gambarLama = $data->cover;
            if ($gambarLama && Storage::disk('real_public')->exists('images/books/' . $gambarLama)) {
                Storage::disk('real_public')->delete('images/books/' . $gambarLama);
            }

            $fileNameimage = 'cover' . '_' . $currentTimestamp . '.' . $this->image_baru->getClientOriginalExtension();
            $filePath = $this->image_baru->storeAs(('images/books/'), $fileNameimage, 'real_public');
            $data->cover = $fileNameimage;
        }



        if ($data->save()) {

            foreach ($this->authorsAdd as $authorIdNew) {
                if (ctype_digit($authorIdNew)) {

                    $authorsData = new BookAuthors();
                    $authorsData->book_id = $data->id;
                    $authorsData->author_id = $authorIdNew;
                    $authorsData->save();
                } else {
                    $authorsDataCreate = new Author();
                    $authorsDataCreate->name = $authorIdNew;
                    $authorsDataCreate->save();

                    $authorsData = new BookAuthors();
                    $authorsData->book_id = $data->id;
                    $authorsData->author_id = $authorsDataCreate->id;
                    $authorsData->save();
                }
            }
            foreach ($this->authorsDelete as $authorIdDelete) {
                $authorsDelete = BookAuthors::where('book_id', $data->id)->where('author_id', $authorIdDelete)->first();
                $authorsDelete->delete();
            }

            //kategori
            foreach ($this->categoriesAdd as $categoryIdNew) {
                if (ctype_digit($categoryIdNew)) {

                    $categoriesData = new BookCategories();
                    $categoriesData->book_id = $data->id;
                    $categoriesData->category_id = $categoryIdNew;
                    $categoriesData->save();
                } else {
                    $categoriesDataCreate = new Category();
                    $categoriesDataCreate->name = $categoryIdNew;
                    $categoriesDataCreate->save();

                    $categoriesData = new BookCategories();
                    $categoriesData->book_id = $data->id;
                    $categoriesData->category_id = $categoriesDataCreate->id;
                    $categoriesData->save();
                }
            }
            foreach ($this->categoriesDelete as $categoryIdDelete) {
                $categoriesDelete = BookCategories::where('book_id', $data->id)->where('category_id', $categoryIdDelete)->first();
                $categoriesDelete->delete();
            }


            $this->dispatch('close-modal');
            LivewireAlert::title('Data Berhasil Disimpan!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();
            $this->resetInput();
        } else {
            LivewireAlert::title('Data Gagal Disimpan!')
                ->position('top-end')
                ->toast()
                ->error()
                ->show();
        }
    }

    public function edit($id)
    {
        $this->showId = null;
        $this->editId = $id;
        $data = Book::find($id);
        $this->title = $data->title;
        $this->cover = $data->cover;
        $this->deskripsi = $data->deskripsi;
        $this->publisher = $data->publisher;
        $this->realese_date = $data->realese_date;
        $this->stock = $data->stock;
        $this->status = $data->status;
        $this->type = $data->type;

        $this->categoriesShow = BookCategories::where('book_id', $data->id)->get();
        $categoriesNotShow = $this->categoriesShow->pluck('category_id')->diff($this->categoriesDelete);
        $this->categoriesData = Category::whereNotIn('id', $categoriesNotShow)->get();


        $this->authorsShow = BookAuthors::where('book_id', $data->id)->get();
        $authorsNotShow = $this->authorsShow->pluck('author_id')->diff($this->authorsDelete);
        $this->authorsData = Author::whereNotIn('id', $authorsNotShow)->get();
    }
    public function show($id)
    {
        $this->editId = null;
        $this->showId = $id;
        $data = Book::find($id);
        $this->title = $data->title;
        $this->cover = $data->cover;
        $this->deskripsi = $data->deskripsi;
        $this->publisher = $data->publisher;
        $this->realese_date = $data->realese_date;
        $this->stock = $data->stock;
        $this->status = $data->status;
        $this->type = $data->type;

        $this->categoriesShow = BookCategories::where('book_id', $data->id)->get();
        $this->authorsShow = BookAuthors::where('book_id', $data->id)->get();
    }


    public function storeEdit()
    {
        $this->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'publisher' => 'required',
            'realese_date' => 'date',
            'stock' => 'required|numeric',
            'status' => 'required',
            'type' => 'required',
        ], [
            'title.required' => 'Judul buku wajib diisi.',
            'deskripsi.required' => 'Deskripsi buku wajib diisi.',
            'publisher.required' => 'Penerbit buku wajib diisi.',
            'realese_date.date' => 'Tanggal rilis harus berupa format tanggal yang valid.',
            'stock.required' => 'Stok buku wajib diisi.',
            'stock.numeric' => 'Stok buku harus berupa angka.',
            'status.required' => 'Status buku wajib diisi.',
            'type.required' => 'Tipe buku wajib diisi.',
        ]);

        $id = $this->editId;
        $data = Book::find($id);
        $data->title = $this->title;
        $data->deskripsi = $this->deskripsi;
        $data->publisher = $this->publisher;
        $data->realese_date = $this->realese_date;
        $data->stock = $this->stock;
        $data->status = $this->status;
        $data->type = $this->type;

        foreach ($this->authorsAdd as $authorIdNew) {
            if (ctype_digit($authorIdNew)) {

                $authorsData = new BookAuthors();
                $authorsData->book_id = $id;
                $authorsData->author_id = $authorIdNew;
                $authorsData->save();
            } else {
                $authorsDataCreate = new Author();
                $authorsDataCreate->name = $authorIdNew;
                $authorsDataCreate->save();

                $authorsData = new BookAuthors();
                $authorsData->book_id = $id;
                $authorsData->author_id = $authorsDataCreate->id;
                $authorsData->save();
            }
        }
        foreach ($this->authorsDelete as $authorIdDelete) {
            $authorsDelete = BookAuthors::where('book_id', $id)->where('author_id', $authorIdDelete)->first();
            $authorsDelete->delete();
        }

        //kategori
        foreach ($this->categoriesAdd as $categoryIdNew) {
            if (ctype_digit($categoryIdNew)) {

                $categoriesData = new BookCategories();
                $categoriesData->book_id = $id;
                $categoriesData->category_id = $categoryIdNew;
                $categoriesData->save();
            } else {
                $categoriesDataCreate = new Category();
                $categoriesDataCreate->name = $categoryIdNew;
                $categoriesDataCreate->save();

                $categoriesData = new BookCategories();
                $categoriesData->book_id = $id;
                $categoriesData->category_id = $categoriesDataCreate->id;
                $categoriesData->save();
            }
        }
        foreach ($this->categoriesDelete as $categoryIdDelete) {
            $categoriesDelete = BookCategories::where('book_id', $id)->where('category_id', $categoryIdDelete)->first();
            $categoriesDelete->delete();
        }


        $currentTimestamp = time();
        if ($this->image_baru != null) {
            $this->validate([
                'image_baru' => 'mimes:png,jpg,jpeg,webp|max:1096', // 1MB Max
            ]);

            $gambarLama = $data->cover;
            if ($gambarLama && Storage::disk('real_public')->exists('images/books/' . $gambarLama)) {
                Storage::disk('real_public')->delete('images/books/' . $gambarLama);
            }

            $fileNameimage = 'cover' . '_' . $currentTimestamp . '.' . $this->image_baru->getClientOriginalExtension();
            $filePath = $this->image_baru->storeAs(('images/books/'), $fileNameimage, 'real_public');
            $data->cover = $fileNameimage;
        }

        if ($data->save()) {
            $this->dispatch('close-modal');
            LivewireAlert::title('Data Berhasil Diubah!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();
            $this->resetInput();
        } else {
            LivewireAlert::title('Data Gagal Diubah!')
                ->position('top-end')
                ->toast()
                ->error()
                ->show();
        }
    }
    public function resetInput()
    {
        $this->title = '';
        $this->deskripsi = '';
        $this->publisher = '';
        $this->realese_date = '';
        $this->stock = '';
        $this->type = '';
        $this->status = '';
        $this->editId = '';
        $this->showId = '';
        // $this->zoomImage = '';
        $this->authorsShow = null;
        $this->authorsAdd = [];
        $this->authorsDelete = [];
        $this->authorsNew = [];
        $this->authorsData = null;
        $this->categoriesShow = null;
        $this->categoriesData = null;
        $this->categoriesAdd = [];
        $this->categoriesDelete = [];
        $this->categoriesNew = [];
        $this->image_baru = null;
        $this->resetValidation();
    }
    public function delete($id)
    {
        $data = Book::where('id', $id)->first();
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
}
