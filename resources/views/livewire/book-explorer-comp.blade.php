<div>
    <div class="max-w-screen-xl mx-auto pt-25 flex flex-col">
        <div class="w-full ">
            <input wire:model.live="search" type="search" id="default-search"
                class="block border border-gray-300 rounded-xl w-full py-3 px-2 focus:outline-0 focus:outline-transparent text-sm  "
                placeholder="Masukkan Judul, Penulis atau Kategori" required />
        </div>
        <div class="w-full flex flex-wrap justify-between mt-2">
            <div class="flex w-full md:w-[60%] gap-2 items-center">
                <div wire:ignore class=" flex w-1/3 md:w-1/3 items-center " x-data="selectComponent">
                    <select wire:model.change="category" class="w-full  p-0 md:min-w-[140px]   border-0 outline-0"
                        id="select-categories">
                        <option value="">Pilih Kategori</option>
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                        @endforelse
                    </select>

                </div>
                <div wire:ignore class=" flex w-1/3 md:w-1/3 items-center" x-data="selectComponent">
                    <select wire:model.change="author" class="w-full h-full p-0 md:min-w-[140px] border-0 outline-0"
                        id="select-authors">
                        <option value="">Pilih Penulis</option>
                        @forelse ($authors as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="flex w-1/3 items-center md:hidden ">

                    <select wire:model.change="sortType"
                        class="  py-2 bg-transparent   text-sm w-full  border border-gray-300  rounded-lg focus:outline-gray-300  ">
                        <option value="new">Paling Terbaru</option>
                        <option value="az">Judul A - Z</option>
                        <option value="za">Judul Z - A</option>
                    </select>
                </div>
                <button wire:click="resetFilter"
                    class="text-xs hidden md:block cursor-pointer hover:scale-105 hover:shadow-md whitespace-nowrap hover:brightness-95 bg-[var(--primary)] text-white  px-2 py-1 rounded-full">
                    Reset Filter
                </button>
            </div>
            <div class="w-full md:w-[38%] items-center hidden md:flex  justify-end">
                <div class="div me-2">

                    <p class=" text-md">Urutkan :</p>
                </div>
                <div class="div">

                    <select wire:model.change="sortType"
                        class="  py-2.5 bg-transparent  px-2.5 text-sm w-full  border border-gray-300  rounded-lg focus:outline-gray-300  ">
                        <option value="new">Paling Terbaru</option>
                        <option value="az">Judul A - Z</option>
                        <option value="za">Judul Z - A</option>
                    </select>
                </div>
            </div>
        </div>
        <div class=" mx-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6  mt-3 justify-start ">
            @forelse($books as $book)
                <div class="max-w-[220px] mb-3
         
                pe-1.5 ps-1.5">
                    <x-card-book :id="$book->id" :myBookmark="$myBookmark" :cover="$book->cover" :stock="$book->available_stock"
                        :title="$book->title" :author="$book->authors" />
                </div>
            @empty
                <div class="flex justify-center items-center w-full h-[50vh]">
                    <p class="text-2xl font-bold text-black">Buku tidak ditemukan</p>
                </div>
            @endforelse

        </div>
    </div>


    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('selectComponent', () => ({
                init() {
                    this.initTomSelect("#select-authors", 'Cari Penulis');
                    this.initTomSelect("#select-categories", 'Cari Kategori');
                },
                initTomSelect(selector, placeholder) {
                    new TomSelect(selector, {
                        searchField: ['text'],
                        placeholder: placeholder,
                        maxOptions: 3,
                        persist: false,
                        plugins: ['dropdown_input', 'remove_button'],
                    });
                }
            }));
        });
        document.addEventListener("resetSelect", () => {
            let selects = ["#select-authors", "#select-categories"];
            selects.forEach(selector => {
                let element = document.querySelector(selector);
                if (element && element.tomselect) {
                    element.tomselect.clear(); // Kosongkan select
                }
            });
        });
    </script>
    <style>
        .ts-control {
            border-radius: 8px;
        }
    </style>
</div>
