<?php

namespace App\Livewire;

use App\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class AdminAuthorComp extends Component
{
    use WithPagination;
    public $search;
    public $confirmDelete;
    public $editId;
    public $name;

    public function render()
    {
        $data = Author::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
            ->orderby('created_at', 'desc')
            ->paginate('10');


        return view('livewire.admin-author-comp', compact('data'))->extends('layouts.master-admin');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $data = new Author();
        $data->name = $this->name;
        if ($data->save()) {
            LivewireAlert::title('Data Berhasil Disimpan!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();

            $this->dispatch('close-modal');
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
        $data = Author::find($id);
        $this->name = $data->name;
    }
    public function storeEdit()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $id = $this->editId;
        $data = Author::find($id);
        $data->name = $this->name;
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
    public function delete($id)
    {
        $data = Author::where('id', $id)->first();
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
    public function resetInput()
    {

        $this->name = '';
        $this->editId = '';
    }
}
