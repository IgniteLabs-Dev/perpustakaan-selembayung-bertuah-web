<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithPagination;

class AdminUsersComp extends Component
{
    use WithPagination;
    public $name, $email, $password, $kelas, $role, $semester, $tanggal_lahir, $editId;
    public $search;
    public $confirmDelete;

    public function render()
    {
        $data = User::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('kelas', 'like', '%' . $this->search . '%')
                ->orWhere('role', 'like', '%' . $this->search . '%')
                ->orWhere('semester', 'like', '%' . $this->search . '%');
        })
            ->orderby('created_at', 'desc')
            ->paginate('10');

        return view('livewire.admin-users-comp', compact('data'))->extends('layouts.master-admin');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
            'role' => 'required',
            'semester' => 'required|numeric',
            'password' => 'required',
        ]);

        $data = new User();
        $data->name = $this->name;
        $data->email = $this->email;
        $data->tanggal_lahir = $this->tanggal_lahir;
        $data->kelas = $this->kelas;
        $data->password = bcrypt($this->password);
        $data->role = $this->role;
        $data->point = 0;
        $data->semester = $this->semester;
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
        $data = User::find($id);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->kelas = $data->kelas;
        $this->role = $data->role;
        $this->semester = $data->semester;
        $this->tanggal_lahir = $data->tanggal_lahir;
    }
    public function storeEdit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
            'role' => 'required',
            'semester' => 'required|numeric',
        ]);

        $id = $this->editId;
        $data = User::find($id);
        $data->name = $this->name;
        $data->email = $this->email;
        $data->tanggal_lahir = $this->tanggal_lahir;
        $data->kelas = $this->kelas;
        $data->role = $this->role;
        $data->semester = $this->semester;
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
    public function resetInput()
    {

        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->kelas = '';
        $this->role = '';
        $this->semester = '';
        $this->tanggal_lahir = '';
        $this->editId = '';
    }
    public function delete($id)
    {
        $data = User::where('id', $id)->first();
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
