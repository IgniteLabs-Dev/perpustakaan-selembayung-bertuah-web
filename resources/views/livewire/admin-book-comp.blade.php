<div>
    @section('title', 'Manajemen Buku')
    <div class="flex justify-between mb-3 mt-5 flex-col sm:flex-row">
        <div class="w-full sm:w-auto flex items-center justify-between mb-2 sm:mb-0 sm:justify-start div   md:mb-0">
            <h1 class="text-2xl font-bold   text-gray-900">Data Buku</h1>
            <div class="w-1/2  justify-end sm:hidden flex ">

                <button @click="$dispatch('open-modal')" type="button" wire:click="create"
                    class="flex items-center justify-center cursor-pointer px-4 py-2 text-sm font-medium bg-[var(--primary)] border-2 text-white border-[var(--primary)] rounded-lg hover:brightness-95 hover:scale-105 hover:bg-[var(--primary)] hover:text-white hover:shadow-md transition duration-150 ease-in-out">
                    <i class="fa-solid fa-plus me-2"></i>
                    Tambah Buku
                </button>
            </div>
        </div>
        <div class="w-full sm:w-auto flex items-center  justify-end  gap-2">
            <div class="md:w-auto w-1/2 sm:w-auto flex justify-end sm:whitespace-nowrap">
                <select wire:model.change="tipeFilter"
                    class="  py-2.5 px-2.5   text-sm w-full bg-white border border-gray-300  rounded-lg focus:outline-gray-300  ">
                    <option value="">Semua Tipe</option>
                    <option value="literasi">Literasi</option>
                    <option value="paketan">Paketan</option>
                </select>
            </div>
            <div class="md:w-auto w-1/2 sm:w-auto flex justify-end sm:whitespace-nowrap">

                <input wire:model.live="search" type="text"
                    class="bg-white w-full  p-2 placeholder:italic  border-1  border-slate-300  rounded-lg focus:outline-slate-300 focus:ring-0 focus:ring-slate-500 "
                    placeholder="Judul, Penulis, Penerbit, Kategori, Deskripsi" />
            </div>
            <div class="md:w-auto w-1/2 sm:w-auto hidden justify-end sm:flex ">

                <button @click="$dispatch('open-modal')" type="button" wire:click="create"
                    class="flex items-center justify-center cursor-pointer px-4 py-2 text-sm font-medium bg-[var(--primary)] border-2 text-white border-[var(--primary)] rounded-lg hover:brightness-95 hover:scale-105 hover:bg-[var(--primary)] hover:text-white hover:shadow-md transition duration-150 ease-in-out">
                    <i class="fa-solid fa-plus me-2"></i>
                    Tambah Buku
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
                    <th scope="col" class="px-6 py-4 text-center">
                        Cover
                    </th>
                    <th scope="col" class="px-6 py-4 ">
                        Judul
                    </th>
                    <th scope="col" class="px-6 py-4 ">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Penulis
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Publisher
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Rilis
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Stok
                    </th>

                    <th scope="col" class="px-6 py-4 text-center">
                        Tipe
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>

                @forelse ($data as  $item)
                    <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200 ">
                        <td scope="row" class="px-6 py-3 align-top text-center font-normal text-gray-900 ">
                            {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                        </td>

                        <td class="px-6 py-3 align-top    text-gray-900 font-normal ">
                            <div
                                class="relative cursor-pointer group w-[80px] "@click="$dispatch('open-modal2', { image: '{{ asset('images/books/') }}/{{ $item->cover }}' })">
                                <img class="rounded-md w-full h-full object-cover"
                                    src="{{ asset('images/books/' . $item->cover) }}" alt="{{ $item->title }}">
                                <div
                                    class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-md">

                                    <i class="fa-solid fa-magnifying-glass-plus text-white text-2xl"></i>
                                </div>
                            </div>

                        </td>
                        <td class="px-6 py-3 align-top   text-gray-900 font-normal ">
                            {{ $item->title }}
                        </td>
                        <td class="px-6 py-3 align-top   text-xs text-gray-900 font-normal ">
                            {{ Str::limit($item->deskripsi, 150, '...') }}
                        </td>
                        <td class="px-6 py-3 align-top  text-center text-gray-900 font-normal ">
                            {{ $item->authors }}
                        </td>
                        <td class="px-6 py-3 align-top  text-center text-gray-900 font-normal ">
                            {{ $item->publisher }}
                        </td>
                        <td class="px-6 py-3 align-top  text-center text-gray-900 font-normal ">
                            {{ $item->categories }}
                        </td>
                        <td class="px-6 py-3 align-top  text-center text-gray-900 font-normal ">
                            {{ \Carbon\Carbon::parse($item->realese_date)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-3 align-top  text-center text-gray-900 font-normal ">
                            {{ $item->stock }}
                        </td>

                        <td class="px-6 py-3 align-top  text-center text-gray-900 font-normal ">
                            {{ ucfirst($item->type) }}
                        </td>
                        <td class="px-6 flex py-3 text-center text-gray-900 font-normal gap-1 ">

                            @if ($confirmDelete != null && $confirmDelete == $item->id)
                                <div class="flex flex-col">

                                    <small class="text-[13px] flex">Apa anda yakin?</small>
                                    <div class="flex gap-1">
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
                                <div class="flex flex-col gap-1">
                                    <button wire:click="show({{ $item->id }})" @click="$dispatch('open-modal')"
                                        type="button"
                                        class=" border-1 bg-[var(--primary)]  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120    transition duration-100 ease-in-out">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button wire:click="edit({{ $item->id }})" @click="$dispatch('open-modal')"
                                        type="button"
                                        class=" border-1 bg-blue-500  text-white cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120    transition duration-100 ease-in-out">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button wire:click="$set('confirmDelete', {{ $item->id }})" type="button"
                                        class=" border-1   bg-red-500 text-white  cursor-pointer rounded-md p-1.5  hover:brightness-95 hover:scale-120  transition duration-100 ease-in-out">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center py-4 text-gray-900">Data Tidak Ditemukan</td>
                    </tr>
                @endforelse



            </tbody>
        </table>
    </div>

    <div class="mt-3 ">
        {{ $data->links('vendor.livewire.tailwind') }}
    </div>


    <div x-data="{ open: false }" x-on:open-modal.window="open = true" x-on:close-modal.window="open = false"
        x-show="open" class="relative z-50 " x-cloak>

        <div @click.self="open = false" x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-50"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-50"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black opacity-50">
        </div>

        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden ">
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                class="relative p-4 w-full max-w-4xl max-h-full mx-auto">
                <div class="relative bg-white rounded-xl shadow-sm">

                    <div
                        class="flex items-center justify-between px-4 py-2 border-b rounded-t-xl bg-primary border-gray-200">
                        <h3 class="text-lg font-semibold text-white">
                            <div class="block" wire:loading.class="hidden">

                                @if ($editId != null)
                                    Edit Buku {{ $title }}
                                @elseif($showId != null)
                                    Detail Buku {{ $title }}
                                @else
                                    Tambah Buku
                                @endif
                            </div>
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
                                <div class="w-full sm:w-1/3 ps-3 flex flex-col h-full">
                                    @if ($image_baru != null)
                                        <img class=" rounded-xl h-full" src="{{ $image_baru->temporaryUrl() }}">
                                    @elseif($editId != null || $showId != null)
                                        <img class=" rounded-xl h-full" src="{{ asset('images/books/' . $cover) }}"
                                            alt="">
                                    @endif
                                    @if ($showId == null)
                                        <div class="div">

                                            <label class="text-sm text-gray-500 ">Cover<span
                                                    class="text-gray-40 text-[10px]"> (PNG, JPG or JPEG (MAX.
                                                    1MB))</span><span class="text-red-500 text-lg">*</span></label>
                                            <input type="file" wire:model.defer="image_baru"
                                                accept=".jpg,.jpeg,.png,.webp" id="imageInput"
                                                class="p-1 w-full cursor-pointer text-slate-500 text-sm rounded-lg leading-6 file:bg-[var(--primary)] file:text-white file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:cursor-pointer file:rounded-sm hover:file:brightness-90 border border-gray-300">

                                            <p id="errorMsg" class="text-red-500 text-sm mt-2 hidden"></p>


                                            <div class="text-red-500 font-italic text-sm" wire:loading
                                                wire:target="image_baru">
                                                Uploading...
                                            </div>

                                            @error('image_baru')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    @endif

                                </div>
                                <div class="w-full sm:w-2/3 flex flex-col justify-between  h-full">
                                    <div class="div">

                                        <div class="flex ">
                                            <div class="w-1/2 ps-3">
                                                <div class=" w-full mt-1   items-start">
                                                    <x-input :attribute="$showId ? 'readonly' : ''" symbol="*" typeWire="defer"
                                                        inputId="title" label="Judul" type="text"
                                                        wireModel="title" placeholder="Judul" />
                                                </div>
                                                <div class="w-full flex">
                                                    <div class=" w-1/2 mt-1 pe-2  items-start">
                                                        <x-input :attribute="$showId ? 'readonly' : ''" symbol="*" typeWire="defer"
                                                            inputId="stock" label="Stok" type="text"
                                                            wireModel="stock" placeholder="Stok" />
                                                    </div>
                                                    <div class=" w-1/2 mt-1   items-start">
                                                        <x-select :attribute="$showId ? 'disabled' : ''" symbol="*" selectId="type"
                                                            label="Tipe" wireModel="type" typeWire="defer"
                                                            placeholder="Tipe" :options="[
                                                                'literasi' => 'Literasi',
                                                                'paketan' => 'Paketan',
                                                            ]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-1/2 ps-2 items-end flex  flex-col justify-between">
                                                <div class=" w-full mt-1   items-start">
                                                    <x-input :attribute="$showId ? 'readonly' : ''" symbol="*" typeWire="defer"
                                                        inputId="publisher" label="Penerbit" type="text"
                                                        wireModel="publisher" placeholder="Penerbit" />
                                                </div>
                                                <div class="w-full flex">

                                                    <div class=" w-1/2 mt-1   items-start">
                                                        <x-input :attribute="$showId ? 'readonly' : ''" symbol="‎" typeWire="defer"
                                                            inputId="realese_date" label="Tanggal Rilis"
                                                            type="date" wireModel="realese_date"
                                                            placeholder="Tanggal Rilis" />
                                                    </div>
                                                    <div class=" w-1/2 mt-1  ps-2 items-start">
                                                        <x-select :attribute="$showId ? 'disabled' : ''" symbol="*" selectId="status"
                                                            label="Status" wireModel="status" typeWire="defer"
                                                            placeholder="Status" :options="[
                                                                'available' => 'Tersedia',
                                                                'borrowed' => 'Tidak Tersedia',
                                                            ]" />
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="flex flex-wrap ps-3 w-full flex-col">
                                            <label class="text-sm text-gray-500">Kategori<span
                                                    class="text-red-500 text-lg">‎</span></label>
                                            <div class="flex flex-wrap w-full gap-1 items-center">
                                                @if ($categoriesShow != null)

                                                    @forelse ($categoriesShow as $category)
                                                        <div
                                                            class="px-2 flex items-center border-gray-500 text-gray-800 text-xs rounded-full
                                                    @if (in_array($category->category->id, $categoriesDelete)) bg-red-200 text-red-500 @else bg-gray-200 @endif">
                                                            {{ $category->category->name }}
                                                            @if ($showId == null)
                                                                @if (in_array($category->category->id, $categoriesDelete))
                                                                    <i wire:click="removeToDeleteCategory({{ $category->category->id }})"
                                                                        class="fa-solid fa-plus text-gray-800 ms-1 cursor-pointer"></i>
                                                                @else
                                                                    <i wire:click="addToDeleteCategory({{ $category->category->id }})"
                                                                        class="fa-solid fa-xmark text-red-500 ms-1 cursor-pointer"></i>
                                                                @endif
                                                            @endif

                                                        </div>
                                                    @empty
                                                    @endforelse
                                                @endif
                                                @if ($showId == null && $categoriesData != null)

                                                    <div
                                                        class="border-1 min-h-[20px]  min-w-[130px]  px-2 flex items-center border-gray-500 text-gray-800 text-xs rounded-full">

                                                        <div wire:ignore class=" flex items-center"
                                                            x-data="selectComponent">
                                                            <select name="categoriesAdd[]" multiple
                                                                wire:model.defer="categoriesAdd"
                                                                class="p-0   min-w-[130px] border-0 outlin-0"
                                                                id="select-categories">
                                                                <option value="">Pilih Penulis</option>
                                                                @forelse ($categoriesData as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}</option>
                                                                @empty
                                                                    <option disabled>Kategori Tidak Ada
                                                                    <option>
                                                                @endforelse

                                                            </select>

                                                        </div>
                                                    </div>
                                                @endif


                                            </div>
                                        </div>
                                        <div class="flex flex-wrap ps-3 mt-0 w-full flex-col">
                                            <label class="text-sm text-gray-500">Penulis<span
                                                    class="text-red-500 text-lg">‎</span></label>
                                            <div class="flex flex-wrap w-full gap-1 items-center">

                                                @if ($authorsShow != null)

                                                    @forelse ($authorsShow as $author)
                                                        <div
                                                            class="px-2 flex items-center border-gray-500 text-gray-800 text-xs rounded-full
                                                    @if (in_array($author->author->id, $authorsDelete)) bg-red-200 text-red-500 @else bg-gray-200 @endif">
                                                            {{ $author->author->name }}

                                                            @if ($showId == null)
                                                                @if (in_array($author->author->id, $authorsDelete))
                                                                    <i data-tooltip-target="tooltip-cancel-remove-author"
                                                                        wire:click="removeToDeleteAuthor({{ $author->author->id }})"
                                                                        class="fa-solid fa-plus text-gray-800 ms-1 cursor-pointer"></i>
                                                                @else
                                                                    <i wire:click="addToDeleteAuthor({{ $author->author->id }})"
                                                                        class="fa-solid fa-xmark text-red-500 ms-1 cursor-pointer"></i>
                                                                @endif
                                                            @endif
                                                        </div>

                                                    @empty
                                                    @endforelse

                                                @endif
                                                @if ($showId == null && $authorsData != null)

                                                    <div
                                                        class="border-1 min-h-[20px]  min-w-[130px]  px-2 flex items-center border-gray-500 text-gray-800 text-xs rounded-full">

                                                        <div wire:ignore class=" flex items-center"
                                                            x-data="selectComponent">
                                                            <select name="authorsAdd[]" multiple
                                                                wire:model.defer="authorsAdd"
                                                                class="p-0   min-w-[130px] border-0 outlin-0"
                                                                id="select-authors">
                                                                <option value="">Pilih Penulis</option>
                                                                @forelse ($authorsData as $author)
                                                                    <option value="{{ $author->id }}">
                                                                        {{ $author->name }}</option>
                                                                @empty

                                                                    <option disabled>Author Tidak Ada
                                                                    <option>
                                                                @endforelse

                                                            </select>

                                                        </div>
                                                    </div>
                                                @endif


                                            </div>
                                        </div>
                                        <div class=" w-full mt-0 ps-3 items-start">
                                            <label class="text-sm text-gray-500">Deskripsi<span
                                                    class="text-red-500 text-lg">‎</span></label>
                                            <textarea :attribute="$showId ? 'disabled' : ''" wire:model.defer="deskripsi"
                                                class="w-full rounded-lg focus:outline-gray-300 readonly:bg-gray-300 read-only:focus:outline-0 border-0 bg-gray-200 p-2 text-sm"
                                                name="" id="" cols="30" rows="5"></textarea>
                                            @error($deskripsi)
                                                <div class="text-red-500 text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                                @if ($showId == null)

                                    <div class="w-full  items-end justify-end mt-auto flex ">

                                        <div class="mt-2">

                                            @if ($editId == null)
                                                <button type="button" wire:click="storeCreate"
                                                    class="flex items-center  justify-center cursor-pointer px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:brightness-95 hover:scale-105 hover:shadow-md transition duration-150 ease-in-out">
                                                    Tambah Buku
                                                </button>
                                            @else
                                                <button type="button" wire:click="storeEdit"
                                                    class="flex items-center  justify-center cursor-pointer px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:brightness-95 hover:scale-105 hover:shadow-md transition duration-150 ease-in-out">
                                                    Simpan Perubahan
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
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
        class="fixed inset-0 z-20 flex items-center justify-center bg-black/50">

        <div class="justify-center flex p-5 shadow-lg" @click.away="openSecond = false">
            <img class="h-dvh " :src="zoomImage" alt="">
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('selectComponent', () => ({
                init() {
                    this.initTomSelect("#select-authors", 'Cari atau Tambah Penulis');
                    this.initTomSelect("#select-categories", 'Cari atau Tambah Kategori');
                },
                initTomSelect(selector, placeholder) {
                    new TomSelect(selector, {
                        create: true,
                        createOnBlur: true,
                        createFilter: input => input.length >= 1,
                        searchField: ['text'],
                        placeholder: placeholder,
                        maxOptions: 3,
                        plugins: ['dropdown_input', 'remove_button'],
                        onItemAdd: function() {
                            this.control_input.value =
                                '';
                        }
                    });
                }
            }));
        });
    </script>

    <style>
        .ts-control {
            padding: 0;
            border: 0;
        }

        .plugin-dropdown_input.focus.dropdown-active .ts-control {
            border: 0;
        }

        .plugin-dropdown_input.focus.dropdown-active .ts-control:focus {
            border: 0;
            outline: none;
        }

        .ts-control:not(.rtl) {
            padding-right: 0 !important;
        }
    </style>
    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const errorMsg = document.getElementById('errorMsg');

            if (file) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!allowedTypes.includes(file.type)) {
                    errorMsg.textContent = 'File harus berupa .jpg, .jpeg, .png, atau .webp';
                    errorMsg.classList.remove('hidden');
                    e.target.value = ''; 
                } else {
                    errorMsg.classList.add('hidden');
                    errorMsg.textContent = '';
                }
            }
        });
    </script>
</div>
