<div>
    @section('title', 'Manajmen User')
    <div class="flex justify-between mb-3 mt-5 flex-col sm:flex-row">
        <div class="w-full sm:w-auto flex items-center justify-center sm:justify-start div  mb-3  md:mb-0">
            <h1 class="text-2xl font-bold   text-gray-900">Data Pengguna</h1>
        </div>
        <div class="w-full sm:w-auto flex items-center  justify-end  gap-2">
            <div class="md:w-auto w-1/2 sm:w-auto flex justify-end sm:whitespace-nowrap">
                <select wire:model.change="roleFilter"
                    class="  py-2.5 px-2.5   text-sm w-full bg-white border border-gray-300  rounded-lg focus:outline-gray-300  ">
                    <option value="">Semua Role</option>
                    <option value="siswa">Siswa</option>
                    <option value="guru">Guru</option>
                    @if ($yourRole == 'superadmin')
                        <option value="admin">Admin</option>
                    @endif
                </select>
            </div>
            <div class="md:w-auto w-1/2 sm:w-auto flex justify-end sm:whitespace-nowrap">
                <input wire:model.live="search" type="text"
                    class="bg-white w-full  p-2 placeholder:italic  border-1  border-slate-300   rounded-lg focus:border-1  "
                    placeholder="Nama Siswa">
            </div>
            <div class="md:w-auto w-1/2 sm:w-auto flex justify-end sm:whitespace-nowrap">

                <button @click="$dispatch('open-modal')" type="button"
                    class="flex items-center justify-center cursor-pointer px-4 py-2 text-sm font-medium bg-[var(--primary)] border-2 text-white border-[var(--primary)] w-full rounded-lg hover:brightness-95 hover:scale-105 hover:bg-[var(--primary)] hover:text-white hover:shadow-md transition duration-150 ease-in-out">
                    <i class="fa-solid fa-plus me-2"></i>
                    Tambah Pengguna
                </button>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-[#164f81]  ">
                <tr>
                    <th scope="col" class="px-6 py-4 text-center">
                        No
                    </th>
                    <th scope="col" class="px-6 py-4 ">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Tanggal Lahir
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Kelas
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        NIS/NIP
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Role
                    </th>
                    {{-- <th scope="col" class="px-6 py-4 text-center">
                        Point
                    </th> --}}
                    <th scope="col" class="px-6 py-4 text-center">
                        Penjurusan
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>

                @forelse ($data as  $item)
                    <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200">
                        <td scope="row" class="px-6 py-3 text-center font-normal text-gray-900 whitespace-nowrap">
                            {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-3  text-gray-900 font-normal whitespace-nowrap">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-3  text-gray-900 font-normal whitespace-nowrap">
                            {{ $item->email }}
                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            @if ($item->tanggal_lahir != null)
                                {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}
                            @endif
                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            {{ $item->kelas }}
                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            {{ $item->nis }}
                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            {{ ucfirst($item->role) }}
                        </td>
                        {{-- <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            {{ $item->point }}
                        </td> --}}
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            {{ $item->penjurusan }}
                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            @if ($item->status == 'active')
                                <span
                                    class="text-white rounded-full text-sm px-2 bg-green-500 font-semibold">Aktif</span>
                            @else
                                <span class="text-white rounded-full text-sm px-2 bg-red-500 font-semibold">Tidak
                                    Aktif</span>
                            @endif
                        </td>
                        <td class="px-6 flex py-3 justify-end text-center text-gray-900 font-normal gap-1 ">

                            @if ($confirmDelete != null && $confirmDelete == $item->id)
                                <div class="flex flex-col">

                                    <small class="text-[13px]">Apa anda yakin?</small>
                                    <div class="div">
                                        <button wire:click="$set('confirmDelete', null)"
                                            class=" px-2 text-[10px] text-white  cursor-pointer bg-blue-500 hover:text-white-500 hover:bg-blue-600 rounded-full p-1">
                                            Batal
                                        </button>
                                        <button wire:click="delete({{ $item->id }})"
                                            class=" px-2 text-[10px] text-white cursor-pointer bg-red-500 hover:text-white-500 hover:bg-red-600 rounded-full p-1">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="flex justify-center">
                                    <div class="div">
                                        <button wire:click="edit({{ $item->id }})" @click="$dispatch('open-modal')"
                                            type="button"
                                            class="border-1 bg-blue-500  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  aspect-square  transition duration-100 ease-in-out">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    </div>
                                    @if ($user->id != $item->id)
                                        <div class="ms-1">
                                            <button wire:click="$set('confirmDelete', {{ $item->id }})"
                                                type="button"
                                                class="border-1 bg-red-500  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  aspect-square  transition duration-100 ease-in-out">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="ms-1">
                                        @if ($user->id != $item->id)
                                            @if ($item->status == 'active')
                                                <button wire:click="changeStatus({{ $item->id }})" type="button"
                                                    class="border-1 bg-orange-500  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  aspect-square  transition duration-100 ease-in-out">
                                                    <i class="fa-solid fa-lock"></i>
                                                </button>
                                            @else
                                                <button wire:click="changeStatus({{ $item->id }})" type="button"
                                                    class="border-1 bg-green-800  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  aspect-square  transition duration-100 ease-in-out">
                                                    <i class="fa-solid fa-lock-open"></i>
                                                </button>
                                            @endif
                                        @endif
                                    </div>

                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-900">Data Tidak Ditemukan</td>
                    </tr>
                @endforelse



            </tbody>
        </table>
    </div>

    <div class="mt-3 ">
        {{ $data->links('vendor.livewire.tailwind') }}
    </div>


    <div x-data="{ open: false }" x-on:open-modal.window="open = true" x-on:close-modal.window="open = false"
        x-show="open" class="relative z-50" x-cloak>

        <div @click.self="open = false" x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-50"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-50"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black opacity-50">
        </div>

        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden">
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                class="relative p-4 w-full max-w-xl max-h-full mx-auto">
                <div class="relative bg-white rounded-xl shadow-sm">

                    <div
                        class="flex items-center justify-between px-4 py-2 border-b rounded-t-xl bg-primary border-gray-200">
                        <h3 class="text-lg font-semibold text-white">
                            @if ($editId != null)
                                Edit Data {{ $name }}
                            @else
                                Tambah Pengguna
                            @endif
                        </h3>
                        <button wire:click="resetInput" type="button" @click="open = false"
                            class="text-white flex cursor-pointer bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-xl text-sm w-8 h-8 ms-auto justify-center items-center active:scale-110 transition duration-150 ease-in-out">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 md:p-5 space-y-4 " wire:loading.class="relative flex justify-center items-center">

                        <span wire:loading class="loader scale-50  my-5"></span>

                        <div class="block" wire:loading.class="hidden">
                            <div class="flex flex-wrap">
                                <div class=" w-1/2  odd:pe-2 items-start">
                                    <x-input symbol="*" typeWire="defer" inputId="name" label="Name"
                                        type="text" wireModel="name" placeholder="Name" />
                                </div>
                                <div class=" w-1/2  odd:pe-2 items-start">
                                    <x-input symbol="*" typeWire="defer" inputId="email" label="Email"
                                        type="email" wireModel="email" placeholder="Email" />
                                </div>

                                <div class=" w-1/2 mt-3 odd:pe-2 items-start">
                                    @if ($yourRole == 'superadmin')
                                        <x-select typeWire="change" symbol="*" selectId="role" label="Role"
                                            wireModel="role" placeholder="Role" :options="[
                                                'admin' => 'Admin',
                                                'guru' => 'Guru',
                                                'siswa' => 'Siswa',
                                            ]" />
                                    @else
                                        <x-select typeWire="change" symbol="*" selectId="role" label="Role"
                                            wireModel="role" placeholder="Role" :options="[
                                                'guru' => 'Guru',
                                                'siswa' => 'Siswa',
                                            ]" />
                                    @endif
                                </div>
                                @if ($role != 'admin')
                                    <div class=" w-1/2 mt-3 odd:pe-2 items-start">
                                        <x-input symbol="‎" typeWire="defer" inputId="tanggal_lahir"
                                            label="Tanggal Lahir" type="date" wireModel="tanggal_lahir"
                                            placeholder="Tanggal Lahir" />
                                    </div>
                                @endif
                                @if ($role != 'guru' && $role != 'admin')
                                    <div class=" w-1/2 odd:pe-2 items-start  pe-2">
                                        <x-input symbol="‎" typeWire="defer" inputId="kelas" label="Kelas"
                                            type="text" wireModel="kelas" placeholder="Kelas" />
                                    </div>
                                    <div class=" w-1/2 odd:pe-2 items-start  ">
                                        <x-input symbol="‎" typeWire="defer" inputId="penjurusan"
                                            label="Penjurusan" type="text" wireModel="penjurusan"
                                            placeholder="Penjurusan" />
                                    </div>
                                @endif


                                <div class=" w-1/2 mt-3 odd:pe-2 items-start">
                                    <x-input symbol="{{ $editId ? '‎' : '*' }}" typeWire="defer" inputId="password"
                                        label="Password" type="password" wireModel="password"
                                        placeholder="Password" />
                                </div>

                                @if ($role != 'admin')
                                    <div class=" w-1/2 mt-3 odd:pe-2 items-start  ">
                                        <x-input symbol="*" typeWire="defer" inputId="nis" label="NIS/NIP"
                                            type="text" wireModel="nis" placeholder="NIS/NIP" />
                                    </div>
                                @endif
                                <div class=" w-full mt-3  items-center justify-center flex">
                                    @if ($editId == null)
                                        <button type="button" wire:click="store"
                                            class="flex items-center  justify-center cursor-pointer px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:brightness-95 hover:scale-105 hover:shadow-md transition duration-150 ease-in-out">
                                            Tambah Pengguna
                                        </button>
                                    @else
                                        <button type="button" wire:click="storeEdit"
                                            class="flex items-center  justify-center cursor-pointer px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:brightness-95 hover:scale-105 hover:shadow-md transition duration-150 ease-in-out">
                                            Simpan Perubahan
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
