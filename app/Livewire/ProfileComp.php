<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileComp extends Component
{
    use WithFileUploads;
    public $user;
    public $image_baru;
    public $nis;
    public $editMode = '';
    public $name, $email, $password, $kelas, $role, $semester, $tanggal_lahir, $cover;

    public function mount()
    {
        $this->loadData();
    }
    public function loadData()
    {

        $this->user = User::find(JWTAuth::parseToken()->authenticate()->id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->kelas = $this->user->kelas;
        $this->semester = $this->user->semester;
        $this->tanggal_lahir = $this->user->tanggal_lahir;
        $this->cover = $this->user->cover;
        $this->nis = $this->user->nis;
    }
    public function render()
    {
        return view('livewire.profile-comp')->extends('layouts.master');;
    }


    public function updateProfile()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'kelas' => 'required',
            'semester' => 'required',
            'tanggal_lahir' => 'required|date',
            'nis' => 'required|unique:users,nis,' . $this->user->id,
            'image_baru' => 'nullable|mimes:jpeg,png,jpg|max:1024',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'kelas.required' => 'Kelas wajib diisi.',
            'semester.required' => 'Semester wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah digunakan oleh pengguna lain.',
        ]);


        $data = User::find(JWTAuth::parseToken()->authenticate()->id);
        $data->name = $this->name;
        $data->email = $this->email;
        $data->kelas = $this->kelas;
        $data->nis = $this->nis;
        $data->semester = $this->semester;
        $data->tanggal_lahir = $this->tanggal_lahir;
        if ($this->password) {
            $data->password = bcrypt($this->password);
        }

        $currentTimestamp = time();
        if ($this->image_baru != null) {
            $this->validate([
                'image_baru' => 'mimes:png,jpg,jpeg,webp|max:1096', // 1MB Max
            ]);

            $gambarLama = $data->cover;
            if ($gambarLama && Storage::disk('real_public')->exists('images/profile/' . $gambarLama)) {
                Storage::disk('real_public')->delete('images/profile/' . $gambarLama);
            }

            $fileNameimage = 'profile' . '_' . $currentTimestamp . '.' . $this->image_baru->getClientOriginalExtension();
            $filePath = $this->image_baru->storeAs(('images/profile/'), $fileNameimage, 'real_public');
            $data->cover = $fileNameimage;
        }

        if ($data->save()) {
            LivewireAlert::title('Data Berhasil Diubah!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();
            $this->resetInput();
            $this->dispatch('refreshNavbar');
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

        $this->image_baru = null;
        $this->password = '';
        $this->editMode = '';

        $this->loadData();
    }
}
