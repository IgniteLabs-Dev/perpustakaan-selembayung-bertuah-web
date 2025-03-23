<div>
    <div class="flex justify-between mb-3 mt-5">
        <div class="div">
            <h1 class="text-2xl font-semibold text-gray-900">Data Pengguna</h1>
        </div>
        <div class="flex justify-end">
            <button @click="$dispatch('open-modal')" type="button"
                class="flex items-center justify-center cursor-pointer px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:brightness-95 hover:scale-105 hover:shadow-md transition duration-150 ease-in-out">
                <i class="fa-solid fa-plus me-2"></i>
                Tambah Pengguna
            </button>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-[#164f81]  ">
                <tr>
                    <th scope="col" class="px-6 py-4">
                        No
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Tanggal Lahir
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Kelas
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Point
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Semester
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>

                @forelse ($data as  $item)
                    <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200">
                        <td scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-3 text-gray-900 font-medium whitespace-nowrap">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-3 text-gray-900 font-medium whitespace-nowrap">
                            {{ $item->email }}
                        </td>
                        <td class="px-6 py-3 text-gray-900 font-medium whitespace-nowrap">
                            {{ $item->tanggal_lahir }}
                        </td>
                        <td class="px-6 py-3 text-gray-900 font-medium whitespace-nowrap">
                            {{ $item->kelas }}
                        </td>
                        <td class="px-6 py-3 text-gray-900 font-medium whitespace-nowrap">
                            {{ $item->role }}
                        </td>
                        <td class="px-6 py-3 text-gray-900 font-medium whitespace-nowrap">
                            {{ $item->point }}
                        </td>
                        <td class="px-6 py-3 text-gray-900 font-medium whitespace-nowrap">
                            {{ $item->semester }}
                        </td>
                        <td class="px-6 py-3 text-gray-900 font-medium whitespace-nowrap">
                            <button wire:click="edit({{ $item->id }})" @click="$dispatch('open-modal')"
                                type="button" class="cursor-pointer hover:text-blue-500 hover:scale-110 rounded-full">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                @endforelse



            </tbody>
        </table>
    </div>


    <div x-data="{ open: false }" x-on:open-modal.window="open = true" x-on:close-modal.window="open = false"
        x-show="open" class="relative z-50" x-cloak>

        <div @click.self="open = false" x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-50"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-50"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black opacity-50">
        </div>

        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden">
            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300"
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
                            Tambah Pengguna
                        </h3>
                        <button type="button" @click="open = false"
                            class="text-white flex cursor-pointer bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-xl text-sm w-8 h-8 ms-auto justify-center items-center active:scale-110 transition duration-150 ease-in-out">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 md:p-5 space-y-4 " wire:loading.class="relative flex justify-center items-center">

                        <span wire:loading class="loader scale-150 my-5"></span>

                        <div class="block">
                            <div class="flex flex-wrap">
                                <div class=" w-1/2  odd:pe-2 items-start">
                                    <x-input symbol="*" typeWire="defer" inputId="name" label="Name"
                                        type="text" wireModel="name" placeholder="Masukkan Name" />
                                </div>
                                <div class=" w-1/2  odd:pe-2 items-start">
                                    <x-input symbol="*" typeWire="defer" inputId="email" label="Email"
                                        type="email" wireModel="email" placeholder="Masukkan Email" />
                                </div>
                                <div class=" w-1/2 mt-3 odd:pe-2 items-start flex">
                                    <div class=" w-1/2  pe-2">
                                        <x-input symbol="*" typeWire="defer" inputId="kelas" label="Kelas"
                                            type="text" wireModel="kelas" placeholder="Masukkan Kelas" />
                                    </div>
                                    <div class=" w-1/2  ">
                                        <x-input symbol="*" typeWire="defer" inputId="semester" label="Semester"
                                            type="number" wireModel="semester" placeholder="Masukkan Semester" />
                                    </div>
                                </div>
                                <div class=" w-1/2 mt-3 odd:pe-2 items-start">
                                    <x-input symbol="" typeWire="defer" inputId="password" label="Password"
                                        type="password" wireModel="password" placeholder="Masukkan Password" />
                                </div>
                                <div class=" w-1/2 mt-3 odd:pe-2 items-start">
                                    <x-input symbol="*" typeWire="defer" inputId="tanggal_lahir"
                                        label="Tanggal Lahir" type="date" wireModel="tanggal_lahir"
                                        placeholder="Masukkan Tanggal Lahir" />
                                </div>

                                <div class=" w-1/2 mt-3 odd:pe-2 items-start">
                                    <x-select symbol="*" selectId="role" label="Role" wireModel="role"
                                        placeholder="Role" :options="[
                                            'admin' => 'Admin',
                                            'siswa' => 'Siswa',
                                        ]" />
                                </div>
                                <div class=" w-1/2 mt-3 odd:pe-2 items-end justify-start flex">
                                    <button type="button" wire:click="store"
                                        class="flex items-center  justify-center cursor-pointer px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:brightness-95 hover:scale-105 hover:shadow-md transition duration-150 ease-in-out">
                                        Tambah Pengguna
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
