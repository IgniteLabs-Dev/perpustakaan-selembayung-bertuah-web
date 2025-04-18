<div>
    <div class="flex justify-between mb-3 mt-5 flex-col sm:flex-row">
        <div class="w-full sm:w-auto flex items-center justify-center sm:justify-start div mb-2  md:mb-0">
            <h1 class="text-2xl font-bold   text-gray-900">Data Pengunjung</h1>
        </div>
        <div class="w-full sm:w-auto flex items-center  justify-end  gap-2">
            <div class="md:w-auto w-1/2 sm:w-auto flex justify-end sm:whitespace-nowrap">
                <input wire:model.live="search" type="text"
                    class="bg-white w-full  p-2 placeholder:italic  border-1  border-slate-300  rounded-lg focus:border-slate-300"
                    placeholder="Masukkan Nama Pengunjung">
            </div>
            <div class="md:w-auto w-1/2 sm:w-auto flex justify-end sm:whitespace-nowrap">

                <button @click="$dispatch('open-modal')" type="button"
                    class="flex items-center ms-2 justify-center w-full cursor-pointer px-4 py-2 text-sm font-medium bg-white border-2 text-[var(--primary)] border-[var(--primary)] rounded-lg hover:brightness-95 hover:scale-105 hover:bg-[var(--primary)] hover:text-white hover:shadow-md transition duration-150 ease-in-out"></i>
                    <i class="fa-solid fa-plus me-2"></i> Tambah Tamu
                </button>
                <button @click="$dispatch('open-modal2')" type="button"
                    class="flex items-center ms-2 justify-center w-full cursor-pointer px-4 py-2 text-sm font-medium bg-[var(--primary)] border-2 text-white border-[var(--primary)] rounded-lg hover:brightness-95 hover:scale-105 hover:bg-[var(--primary)] hover:text-white hover:shadow-md transition duration-150 ease-in-out">
                    <i class="fa-solid fa-plus me-2"></i>
                    Tambah Pengunjung Siswa
                </button>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-[#164f81]  ">
                <tr>
                    <th scope="col" class="px-6 py-4 whitespace-nowrap">
                        No
                    </th>
                    <th scope="col" class="px-6 py-4 whitespace-nowrap">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-4 whitespace-nowrap">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>

                @forelse ($data as  $item)
                    <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200">
                        <td scope="row" class="px-6 py-3  font-normal text-gray-900 whitespace-nowrap">
                            {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-3  text-gray-900 font-normal whitespace-nowrap">
                            {{ $item->name ? $item->name : $item->user?->name }}
                        </td>

                        <td class="px-6 py-3  text-gray-900 font-normal whitespace-nowrap">
                            {{ $item->created_at ? $item->created_at->translatedFormat('j F Y - H:i') : '-' }}
                        </td>

                        <td class="px-6 flex py-3 text-center justify-center text-gray-900 font-normal gap-1 ">

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
                                <div class="div">

                                    <button wire:click="$set('confirmDelete', {{ $item->id }})" type="button"
                                        class="border-1 bg-red-500  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  aspect-square  transition duration-100 ease-in-out">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                <div class="div">
                                    @if ($item->name != null)
                                        <button wire:click="edit({{ $item->id }})" @click="$dispatch('open-modal')"
                                            type="button"
                                            class="border-1 bg-blue-500  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  aspect-square  transition duration-100 ease-in-out">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    @else
                                        <button wire:click="edit({{ $item->id }})" @click="$dispatch('open-modal2')"
                                            type="button"
                                            class="border-1 bg-blue-500  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  aspect-square  transition duration-100 ease-in-out">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    @endif
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
                                Tambah Tamu
                            @endif
                        </h3>
                        <button wire:click="resetInput" type="button" @click="open = false"
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

                        <span wire:loading class="loader scale-50  my-5"></span>

                        <div class="block" wire:loading.class="hidden">
                            <div class="flex flex-wrap">
                                <div class=" w-full   items-start">
                                    <x-input symbol="*" typeWire="defer" inputId="name" label="Name"
                                        type="text" wireModel="name" placeholder="Masukkan Nama" />
                                </div>

                                <div class=" w-full mt-3  items-end justify-center flex">
                                    @if ($editId == null)
                                        <button type="button" wire:click="store"
                                            class="flex items-center  justify-center cursor-pointer px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:brightness-95 hover:scale-105 hover:shadow-md transition duration-150 ease-in-out">
                                            Tambah Tamu
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
    <div x-data="{ openSecond: false, zoomImage: '' }" x-cloak x-show="openSecond"
        x-on:open-modal2.window="openSecond = true; zoomImage = $event.detail.image"
        x-on:close-modal2.window="openSecond = false"
        class="fixed inset-0 z-20 flex items-center justify-center bg-black/50 ">

        <div class="relative bg-white rounded-xl shadow-sm w-xl max-h-full">

            <div class="flex items-center justify-between px-4 py-2 border-b rounded-t-xl bg-primary border-gray-200">
                <h3 class="text-lg font-semibold text-white">
                    @if ($editId != null)
                        Edit {{ $nameSiswa }}
                    @else
                        Tambah Pengunjung
                    @endif
                </h3>
                <button wire:click="resetInput" type="button" @click="openSecond = false"
                    class="text-white flex cursor-pointer bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-xl text-sm w-8 h-8 ms-auto justify-center items-center active:scale-110 transition duration-150 ease-in-out">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5 space-y-4 " wire:loading.class="relative flex justify-center items-center">

                <span wire:loading class="loader scale-50  my-5"></span>
                <div class="block" wire:loading.class="hidden">

                    <div class=" w-full   items-start">
                        <label class="text-sm text-gray-500">Nama<span class="text-red-500 text-sm">*</span></label>
                        <div wire:ignore class=" flex items-center" x-data="selectComponent">
                            <select wire:model.defer="user_id" class="tom-select   w-full" id="select-users">
                                <option value="">Pilih Siswa</option>
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class=" w-full mt-3  items-end justify-center flex">
                        @if ($editId == null)
                            <button type="button" wire:click="storeSiswa"
                                class="flex items-center  justify-center cursor-pointer px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:brightness-95 hover:scale-105 hover:shadow-md transition duration-150 ease-in-out">
                                Tambah Pengunjung
                            </button>
                        @else
                            <button type="button" wire:click="storeEditSiswa"
                                class="flex items-center  justify-center cursor-pointer px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:brightness-95 hover:scale-105 hover:shadow-md transition duration-150 ease-in-out">
                                Simpan Perubahan
                            </button>
                        @endif
                    </div>
                </div>



            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('selectComponent', () => ({
                init() {
                    this.initTomSelect("#select-users", 'Masukkan Nama Siswa');



                    Livewire.on('resetTomSelect', () => {
                        this.resetTomSelect("#select-users");
                    });
                },
                initTomSelect(selector, placeholder) {
                    let element = document.querySelector(selector);
                    if (element) {
                        new TomSelect(element, {
                            create: false,
                            searchField: ['text'],
                            placeholder: placeholder,
                            maxOptions: 5,
                            persist: false,
                            plugins: ['dropdown_input']
                        });
                    }
                },
                resetTomSelect(selector) {
                    let element = document.querySelector(selector);
                    if (element && element.tomselect) {
                        element.tomselect.clear();
                    }
                }
            }));
        });
    </script>
</div>
