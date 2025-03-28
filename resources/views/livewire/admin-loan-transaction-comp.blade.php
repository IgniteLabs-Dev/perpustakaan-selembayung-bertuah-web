<div>
    <div class="flex justify-between mb-3 mt-5">
        <div class="div items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Data Peminjaman</h1>
        </div>
        <div class="flex justify-end items-center gap-2">
            <div class="div">
                <button wire:click="resetFilter"
                    class="text-xs cursor-pointer hover:scale-105 hover:shadow-md hover:brightness-95 bg-[var(--primary)] text-white  px-2 py-1 rounded-full">
                    Reset Filter
                </button>
            </div>
            <div class="div">
                <select wire:model.change="statusFilter"
                    class="  py-2.5    text-sm w-full bg-white border border-gray-300  rounded-lg focus:outline-gray-300  ">
                    <option value="">Semua Status</option>
                    <option value="az">Dikembalikan</option>
                    <option value="za">Belum Dikembalikan</option>
                </select>
            </div>
            <div class="div">
                <select wire:model.change="conditionFilter"
                    class="  py-2.5    text-sm w-full bg-white border border-gray-300  rounded-lg focus:outline-gray-300  ">
                    <option value="">Semua Kondisi</option>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>
            <div class="div">
                <input wire:model.live="search" type="text"
                    class="bg-white w-full  p-2 placeholder:italic  border-1  border-slate-300  rounded-lg focus:outline-slate-300"
                    placeholder="Masukkan Nama Siswa atau Judul Buku" />
            </div>
            <div class="div">

                <button @click="$dispatch('open-modal')" type="button"
                    class="flex items-center justify-center cursor-pointer px-4 py-2 text-sm font-medium bg-[var(--primary)] border-2 text-white border-[var(--primary)] rounded-lg hover:brightness-95 hover:scale-105 hover:bg-[var(--primary)] hover:text-white hover:shadow-md transition duration-150 ease-in-out">
                    <i class="fa-solid fa-plus me-2"></i>
                    Tambah Peminjaman
                </button>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-[#164f81]  ">
                <tr>
                    <th scope="col" class="px-6 py-4  whitespace-nowrap">
                        No
                    </th>
                    <th scope="col" class="px-6 py-4  whitespace-nowrap">
                        Siswa
                    </th>
                    <th scope="col" class="px-6 py-4  whitespace-nowrap">
                        Buku
                    </th>
                    <th scope="col" class="px-6 py-4 text-center whitespace-nowrap">
                        Tanggal Peminjaman
                    </th>
                    <th scope="col" class="px-6 py-4 text-center whitespace-nowrap">
                        Batas Pengembalian
                    </th>
                    <th scope="col" class="px-6 py-4 text-center whitespace-nowrap">
                        Tanggal Pengembalian
                    </th>
                    <th scope="col" class="px-6 py-4 text-center whitespace-nowrap">
                        Kondisi
                    </th>
                    <th scope="col" class="px-6 py-4 text-center whitespace-nowrap">
                        Poin
                    </th>
                    <th scope="col" class="px-6 py-4 text-center whitespace-nowrap">
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
                        <td class="px-6 py-3  font-normal text-gray-900 whitespace-nowrap">
                            {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-3  text-gray-900 font-normal whitespace-nowrap">
                            {{ $item->user->name }}
                        </td>
                        <td class="px-6 py-3 flex text-gray-900 font-normal whitespace-normal">
                            {{ $item->book->title }}
                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->borrowed_at)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->due_date)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            {{ $item->returned_at ? \Carbon\Carbon::parse($item->returned_at)->translatedFormat('d F Y') : '-' }}
                            <span
                                class="text-xs {{ $item->returned_at
                                    ? (\Carbon\Carbon::parse($item->returned_at)->lessThanOrEqualTo($item->due_date)
                                        ? 'text-green-600'
                                        : 'text-red-600')
                                    : '' }}">
                                {{ $item->returned_at
                                    ? (\Carbon\Carbon::parse($item->returned_at)->lessThanOrEqualTo($item->due_date)
                                        ? '(Tepat Waktu)'
                                        : '(' . \Carbon\Carbon::parse($item->returned_at)->diffInDays($item->due_date) . ' Hari Terlambat)')
                                    : '' }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            <span
                                class="{{ $item->condition === 'hilang' ? 'text-red-500' : ($item->condition === 'rusak' ? 'text-orange-500' : 'text-[var(--primary)]') }}">
                                {{ Str::title($item->condition) ? Str::title($item->condition) : '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                            @if ($item->fine > 0 && $item->point == 0)
                                <div
                                    class=" text-xs px-1 text-red-600 bg-red-100 outline-1 outline-red-600 rounded-full">
                                    -{{ $item->fine }}
                                </div>
                            @elseif ($item->point > 0 && $item->fine == 0)
                                <div
                                    class=" text-xs px-1 text-green-600 bg-green-100 outline-1 outline-green-600 rounded-full">
                                    +{{ $item->point }}
                                </div>
                            @else
                                -
                            @endif

                        </td>
                        <td class="px-6 py-3 text-center text-gray-900 font-normal ">
                            <div class="flex justify-center">

                                @if ($item->status == 'borrowed')
                                    <div
                                        class=" text-xs px-3 text-orange-500 bg-red-100 outline-1 outline-orange-500 rounded-full">
                                        Dipinjam</div>
                                @else
                                    <div
                                        class="text-xs px-3 text-green-600 bg-green-100 outline-1 outline-green-600 rounded-full">
                                        Dikembalikan</div>
                                @endif
                            </div>
                        </td>

                        <td
                            class="px-6 flex py-3 text-center justify-end items-center text-gray-900 font-normal gap-1 ">

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
                                <div class="flex gap-1 justify-end items-end">
                                    @if ($item->status == 'borrowed')
                                        <button wire:click="show({{ $item->id }})"
                                            @click="$dispatch('open-modal2')" type="button"
                                            class="border-1 bg-[var(--primary)]  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  aspect-square  transition duration-100 ease-in-out">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    @endif
                                    <button wire:click="$set('confirmDelete', {{ $item->id }})" type="button"
                                        class="border-1 bg-red-500  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  aspect-square  transition duration-100 ease-in-out">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>


                                    <button wire:click="edit({{ $item->id }})" @click="$dispatch('open-modal')"
                                        type="button"
                                        class="border-1 bg-blue-500  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  aspect-square  transition duration-100 ease-in-out">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
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
                                Edit Peminjaman
                            @else
                                Tambah Peminjaman
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

                        {{-- <span wire:loading class="loader scale-50  my-5"></span> --}}

                        <div class="block">
                            <div class="flex flex-wrap items-start">


                                <div class=" w-1/2 even:ps-2   items-start">
                                    <label class="text-sm text-gray-500">Siswa<span
                                            class="text-red-500 text-lg">*</span></label>
                                    <div wire:ignore class=" flex items-center" x-data="selectComponent">
                                        <select wire:model.defer="user_id" class="tom-select   w-full"
                                            id="select-users">
                                            <option value="">Pilih Siswa</option>
                                            @forelse ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}</option>
                                            @empty
                                            @endforelse

                                        </select>

                                    </div>
                                    @error('user_id')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" w-1/2 even:ps-2   items-start">
                                    <label class="text-sm text-gray-500">Buku<span
                                            class="text-red-500 text-lg">*</span></label>
                                    <div wire:ignore class=" flex items-center" x-data="selectComponent">
                                        <select wire:model.defer="book_id" class="tom-select   w-full"
                                            id="select-book">
                                            <option value="">Pilih Buku</option>
                                            @forelse ($books as $book)
                                                <option value="{{ $book->id }}">
                                                    {{ $book->title }}</option>
                                            @empty
                                                <option disabled>Buku Tidak Ada
                                                <option>
                                            @endforelse

                                        </select>

                                    </div>
                                    @error('book_id')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class=" w-1/2 even:ps-2   items-start">
                                    <x-input symbol="*" typeWire="change" inputId="borrowed_at"
                                        label="Tanggal Peminjaman" type="date" wireModel="borrowed_at"
                                        placeholder="Masukkan Tanggal Peminjaman" />
                                </div>
                                <div class=" w-1/2 even:ps-2   items-start">
                                    <x-input symbol="*" typeWire="change" inputId="due_date"
                                        label="Tenggat waktu pengembalian" type="date" wireModel="due_date"
                                        placeholder="Masukkan Tenggah Pengembalian" />
                                </div>
                                @if ($editId != null)
                                    <div class=" w-1/2 even:ps-2   items-start">
                                        <x-input symbol="*" typeWire="change" inputId="returned_at"
                                            label="Tanggal Pengembalian" type="date" wireModel="returned_at"
                                            placeholder="Masukkan Tanggal Pengembalian" />
                                    </div>
                                    <div class=" w-1/2 even:ps-2   items-start">
                                        <x-select typeWire="change" symbol="*" selectId="status" label="Status"
                                            wireModel="status" placeholder="Pilih Status" :options="[
                                                'borrowed' => 'Dipinjam',
                                                'returned' => 'Dikembalikan',
                                            ]" />
                                    </div>
                                    <div class=" w-1/2 even:ps-2   items-start">
                                        <x-select typeWire="change" symbol="*" selectId="condition"
                                            label="Kondisi" wireModel="condition" placeholder="Pilih Kondisi"
                                            :options="[
                                                'baik' => 'Baik',
                                                'rusak' => 'Rusak',
                                                'hilang' => 'Hilang',
                                            ]" />
                                    </div>

                                    <div class=" w-1/2 even:ps-2   mt-auto">
                                        <label class="text-sm text-gray-500">Point :<span
                                                class="text-red-500 text-lg">‎</span></label> <br>
                                        <input type="text" class="border-0   outline-0 p-0" disabled
                                            wire:model.defer="finePoint">
                                    </div>
                                @endif


                                <div class=" w-full mt-3  items-end justify-center flex">
                                    @if ($editId == null)
                                        <button type="button" wire:click="storeCreate"
                                            class="flex items-center  justify-center cursor-pointer px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:brightness-95 hover:scale-105 hover:shadow-md transition duration-150 ease-in-out">
                                            Tambah Peminjaman
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

        <div class="relative bg-white rounded-xl shadow-sm max-w-xl max-h-full">

            <div class="flex items-center justify-between px-4 py-2 border-b rounded-t-xl bg-primary border-gray-200">
                <h3 class="text-lg font-semibold text-white">
                    @if ($editId != null)
                        Edit Peminjaman
                    @else
                        Detail Peminjaman
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
                @if ($showId != null)
                    {{-- <span wire:loading class="loader scale-50  my-5"></span> --}}
                    <div class="block flex">
                        <div class="flex w-1/2">
                            <img class="rounded-lg object-cover"
                                src="{{ asset('images/books/' . $dataShow->book->cover) }}" alt="">
                        </div>
                        <div class="w-1/2 flex flex-col ps-2 justify-between" x-data="{ returned: false }">

                            <!-- if -->
                            <div class="mb-2">
                                <label class="text-xs text-gray-500">Nama Peminjam</label>
                                <p>{{ $dataShow->user->name }}</p>
                            </div>
                            <div class="mb-2">
                                <label class="text-xs text-gray-500">Judul Buku</label>
                                <p>{{ $dataShow->book->title }}</p>
                            </div>
                            <div class="mb-2">
                                <label class="text-xs text-gray-500">Tanggal Peminjaman</label>
                                <p>{{ \Carbon\Carbon::parse($dataShow->borrowed_at)->translatedFormat('d F Y') }} -
                                    {{ \Carbon\Carbon::parse($dataShow->due_date)->translatedFormat('d F Y') }}</p>
                            </div>
                            <div x-show="!returned">
                            </div>

                            <!-- else -->
                            <div x-show="returned">
                                <div class="mb-1">
                                    <x-input symbol="*" typeWire="change" inputId="returned_at"
                                        label="Tanggal Pengembalian" type="date" wireModel="returned_at"
                                        placeholder="Masukkan Tanggal Pengembalian" />
                                </div>

                                <div class="mb-1">
                                    <x-select typeWire="change" symbol="*" selectId="condition" label="Kondisi"
                                        wireModel="condition" placeholder="Pilih Kondisi" :options="[
                                            'baik' => 'Baik',
                                            'rusak' => 'Rusak',
                                            'hilang' => 'Hilang',
                                        ]" />
                                </div>
                                <div class="w-1/2 even:ps-2 mt-auto">
                                    <label class="text-sm text-gray-500">Point :<span
                                            class="text-red-500 text-lg">‎</span></label>
                                    <input type="text" class="border-0 outline-0 p-0" disabled
                                        wire:model.defer="finePoint">
                                </div>
                            </div>

                            <!-- tombol -->
                            <div class="mt-auto ">
                                <template x-if="returned">
                                    <div class="flex">
                                        <div class="pe-1 w-1/2">

                                            <button @click="returned = false"
                                                class="bg-red-500 w-full  cursor-pointer text-white p-2 rounded-lg">
                                                Batal
                                            </button>
                                        </div>
                                        <div class="ps-1 w-1/2">

                                            <button @click="returned = true" wire:click="storeReturn"
                                                class="bg-[var(--primary)] w-full cursor-pointer text-white p-2 rounded-lg">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="!returned">
                                    <button @click="returned = true"
                                        class="bg-[var(--primary)] cursor-pointer text-white p-2 w-full rounded-lg">
                                        Selesaikan Peminjaman
                                    </button>
                                </template>
                            </div>
                        </div>

                    </div>
                @endif


            </div>
        </div>
    </div>
    <style>
        .ts-control,
        .ts-wrapper.single.input-active .ts-control,
        .ts-dropdown {
            background: #e5e7eb;
            width: 100%;
            border: 1 solid #e5e7eb;
            border-radius: 0.5rem;
            outline: none;
        }
    </style>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('selectComponent', () => ({
                init() {
                    this.initTomSelect("#select-users", 'Tambah Penulis');
                    this.initTomSelect("#select-book", 'Tambah Buku');
                },
                initTomSelect(selector, placeholder) {
                    new TomSelect(selector, {
                        create: false,
                        searchField: ['text'],
                        placeholder: placeholder,
                        maxOptions: 5,
                        persist: false,
                        plugins: ['dropdown_input']
                    });
                }
            }));
        });
    </script>
</div>
