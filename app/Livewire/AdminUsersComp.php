<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\WithPagination;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminUsersComp extends Component
{
    use WithPagination;
    public $name, $email, $password, $kelas, $role, $semester, $tanggal_lahir, $editId, $nis;
    public $search;
    public $roleFilter;
    public $confirmDelete;

    public function render()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $yourRole = $user->role;

        $data = User::when($yourRole == 'superadmin', function ($query) {
            return $query->whereIn('role', ['siswa', 'guru', 'admin']);
        })
            ->when($this->roleFilter, function ($query) {
                return $query->where('role', $this->roleFilter);
            })
            ->when($yourRole == 'admin', function ($query) {
                return $query->whereIn('role', ['siswa', 'guru']);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('kelas', 'like', '%' . $this->search . '%')
                        ->orWhereRaw("DATE_FORMAT(tanggal_lahir, '%d') = ?", [$this->search])
                        ->orWhereRaw("DATE_FORMAT(tanggal_lahir, '%M') like ?", ['%' . $this->search . '%'])
                        ->orWhereRaw("DATE_FORMAT(tanggal_lahir, '%Y') = ?", [$this->search])
                        ->orWhere('role', 'like', '%' . $this->search . '%')
                        ->orWhere('nis', 'like', '%' . $this->search . '%')
                        ->orWhere('semester', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('livewire.admin-users-comp', compact('data', 'user', 'yourRole'))->extends('layouts.master-admin');
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedRoleFilter()
    {
        $this->resetPage();
    }
    public function updatedRole()
    {

        if ($this->role == 'guru') {
            $this->kelas = '';
            $this->semester = '';
        } else if ($this->role == 'admin') {
            $this->kelas = '';
            $this->semester = '';
            $this->nis = '';
            $this->tanggal_lahir = '';
        }
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'tanggal_lahir' => 'date|required',
            'role' => 'required',
            'semester' => 'numeric|nullable',
            'kelas' => 'numeric|nullable',
            'password' => 'required',
            'nis' => 'unique:users,nis|nullable',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'tanggal_lahir.date' => 'Tanggal lahir wajib tanggal.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'role.required' => 'Role wajib diisi.',
            'semester.numeric' => 'Semester harus berupa angka.',
            'kelas.numeric' => 'Kelas harus berupa angka.',
            'password.required' => 'Password wajib diisi.',
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',

        ]);



        $data = new User();
        $data->name = $this->name;
        $data->nis = $this->nis;
        $data->email = $this->email;
        $data->tanggal_lahir = $this->tanggal_lahir;
        $data->kelas = $this->kelas ? $this->kelas : null;
        $data->password = bcrypt($this->password);
        $data->role = $this->role;
        $data->point = 0;
        $data->status = 'active';
        $data->semester = $this->semester ? $this->semester : null;
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
    public function changeStatus($id)
    {
        $data = User::find($id);
        if ($data->status == 'active') {
            $data->status = 'nonactive';
        } else {
            $data->status = 'active';
        }
        if ($data->save()) {
            LivewireAlert::title('Status Berhasil Diubah!')
                ->position('top-end')
                ->toast()
                ->success()
                ->show();
        } else {
            LivewireAlert::title('Status Gagal Diubah!')
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
        $this->nis = $data->nis;
        $this->semester = $data->semester;
        $this->tanggal_lahir = $data->tanggal_lahir;
    }
    public function storeEdit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->editId,
            'tanggal_lahir' => 'date',

            'role' => 'required',
            'semester' => 'numeric||nullable',
            'nis' => 'unique:users,nis,' . $this->editId,
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'tanggal_lahir.date' => 'Tanggal lahir wajib tanggal.',
            'role.required' => 'Role wajib diisi.',
            'semester.numeric' => 'Semester harus berupa angka.',
            'nis.unique' => 'NIS sudah terdaftar.',
        ]);


        $id = $this->editId;
        $data = User::find($id);
        $data->name = $this->name;
        $data->email = $this->email;
        $data->tanggal_lahir = $this->tanggal_lahir;
        $data->kelas = $this->kelas;
        $data->role = $this->role;
        $data->nis = $this->nis;
        $data->semester = $this->semester;
        if ($this->password) {
            $data->password = bcrypt($this->password);
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

        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->nis = '';
        $this->kelas = '';
        $this->role = '';
        $this->semester = '';
        $this->tanggal_lahir = '';
        $this->editId = '';
        $this->resetValidation();
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
