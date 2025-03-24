<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithPagination;

class AdminBookComp extends Component
{
    use WithPagination;
    public $search;
    public $cover, $title, $deskripsi, $author, $publisher, $category_id, $realese_date, $stock, $status, $type;
    public $editId;
    public $confirmDelete;
    public $zoomImage;


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
        return view('livewire.admin-book-comp', compact('data'))->extends('layouts.master-admin');
    }
    public function updatedSearch()
    {
        $this->resetPage();
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
        $this->editId = $id;
        $data = Book::find($id);
        $this->title = $data->title;
        $this->deskripsi = $data->deskripsi;
        $this->publisher = $data->publisher;
        $this->realese_date = $data->realese_date;
        $this->stock = $data->stock;
        $this->status = $data->status;
        $this->type = $data->type;
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
        $this->zoomImage = '';
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
