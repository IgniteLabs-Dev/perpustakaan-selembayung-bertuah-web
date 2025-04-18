<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Visitor;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class AdminVisitorComp extends Component
{
    use WithPagination;
    public $search;
    public $confirmDelete;
    public $user_id;
    public $editId;
    public $name;
    public $nameSiswa;

    public function render()
    {
        $data = Visitor::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
            ->orderby('created_at', 'desc')
            ->paginate('10');
        $users = User::all();


        return view('livewire.admin-visitor-comp', compact('data', 'users'))->extends('layouts.master-admin');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function store()
    {
        $this->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Nama penulis wajib diisi.'
        ]);


        $data = new Visitor();
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
    public function storeSiswa()
    {
        $this->validate([
            'user_id' => 'required'
        ], [
            'user_id.required' => 'Nama penulis wajib diisi.'
        ]);


        $data = new Visitor();
        $data->user_id = $this->user_id;
        if ($data->save()) {
            LivewireAlert::title('Data Berhasil Disimpan!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();
            $this->dispatch('resetTomSelect');
            $this->dispatch('close-modal2');
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
        $data = Visitor::find($id);

        $this->name = $data->name ?? null;
        $this->nameSiswa = $data->user->name ?? null;
    }
    public function storeEdit()
    {
        $this->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Nama penulis wajib diisi.'
        ]);

        $id = $this->editId;
        $data = Visitor::find($id);
        $data->name = $this->name;
        $data->user_id = null;
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
    public function storeEditSiswa()
    {
        $this->validate([
            'user_id' => 'required'
        ], [
            'user_id.required' => 'Nama penulis wajib diisi.'
        ]);

        $id = $this->editId;
        $data = Visitor::find($id);
        $data->name = null;
        $data->user_id = $this->user_id;
        if ($data->save()) {
            LivewireAlert::title('Data Berhasil Diubah!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();

            $this->dispatch('close-modal2');
            $this->dispatch('resetTomSelect');
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
        $data = Visitor::where('id', $id)->first();
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
        $this->nameSiswa = '';
        $this->editId = '';
        $this->user_id = '';
    }
}
