<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthors;
use App\Models\BookCategories;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithPagination;

class AdminBookComp extends Component
{
    use WithPagination;
    public $search;
    public $cover, $title, $deskripsi, $author, $publisher, $category_id, $realese_date, $stock, $status, $type;
    public $editId;
    public $showId;
    public $confirmDelete;
    public $zoomImage;
    public $categoriesShow = null;
    public $authorsShow = null;
    public $authorsData = null;
    public $authorsNew = [];
    public $authorsDelete = [];


    public function render()
    {
        $data = Book::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
                ->orWhere('author', 'like', '%' . $this->search . '%')
                ->orWhere('publisher', 'like', '%' . $this->search . '%');
        })
            ->orderby('created_at', 'desc')
            ->paginate('10');
        // if ($this->editId != null) {
        //     $this->authorsNotShow = $this->authorsShow->pluck('author_id')->diff($this->authorsDelete);
        //     $this->authorsData = Author::whereNotIn('id', $this->authorsNotShow)->get();
        // }

        return view('livewire.admin-book-comp', compact('data'))->extends('layouts.master-admin');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function addToDelete($id)
    {
        if (!in_array($id, $this->authorsDelete)) {
            $this->authorsDelete[] = $id;
        }
    }
    public function removeToDelete($id)
    {
        if (($key = array_search($id, $this->authorsDelete)) !== false) {
            unset($this->authorsDelete[$key]);
        }
    }


    public function store()
    {
        $this->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'publisher' => 'required',
            'realese_date' => 'date',
            'stock' => 'required|numeric',
            'status' => 'required',
            'type' => 'required',
        ]);

        $data = new Book();
        $data->title = $this->title;
        $data->deskripsi = $this->deskripsi;
        $data->publisher = $this->publisher;
        $data->realese_date = $this->realese_date;
        $data->stock = $this->stock;
        $data->status = $this->status;
        $data->type = $this->type;

        if ($data->save()) {
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
        $this->deskripsi = $data->deskripsi;
        $this->publisher = $data->publisher;
        $this->realese_date = $data->realese_date;
        $this->stock = $data->stock;
        $this->status = $data->status;
        $this->type = $data->type;
        $this->categoriesShow = BookCategories::where('book_id', $data->id)->get();

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
        
        if ($data->save()) {
            foreach ($this->authorsNew as $authorIdNew) {
                $authorsData = new BookAuthors();
                $authorsData->book_id = $id;
                $authorsData->author_id = $authorIdNew;
                $authorsData->save();
            }
            foreach ($this->authorsDelete as $authorIdDelete) {
                $authorsDelete = BookAuthors::where('book_id', $id)->where('author_id', $authorIdDelete)->first();
                $authorsDelete->delete();
                
            }
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
        $this->zoomImage = '';
        $this->categoriesShow = null;
        $this->authorsShow = null;
        $this->authorsNew = [];
        $this->authorsDelete = [];

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
