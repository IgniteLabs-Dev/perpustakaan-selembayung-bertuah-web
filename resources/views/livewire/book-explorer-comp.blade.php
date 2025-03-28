<div>
    <div class="max-w-screen-xl mx-auto pt-25 flex flex-col">
        <div class="w-full ">
            <input wire:model.live="search" type="search" id="default-search"
                class="block border border-gray-300 rounded-xl w-full py-3 px-2 focus:outline-0 focus:outline-transparent text-sm  "
                placeholder="Masukkan Judul, Penulis atau Kategori" required />
        </div>
        <div class="w-full flex justify-between mt-2">
            <div class="flex w-[50%] gap-2 items-center">

                <div wire:ignore class=" flex items-center " x-data="selectComponent">
                    <select wire:model.change="category" class="  p-0 min-w-[140px]   border-0 outline-0"
                        id="select-categories">
                        <option value="">Pilih Kategori</option>
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                        @endforelse
                    </select>

                </div>
                <div wire:ignore class=" flex items-center" x-data="selectComponent">
                    <select wire:model.change="author" class=" h-full p-0 min-w-[140px] border-0 outline-0"
                        id="select-authors">
                        <option value="">Pilih Penulis</option>
                        @forelse ($authors as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                        @endforelse
                    </select>

                </div>
                <button wire:click="resetFilter"
                    class="text-xs cursor-pointer hover:scale-105 hover:shadow-md hover:brightness-95 bg-[var(--primary)] text-white  px-2 py-1 rounded-full">
                    Reset Filter
                </button>
            </div>
            <div class="flex w-[50%] items-center  justify-end">
                <div class="div me-2">

                    <p class=" text-md">Urutkan :</p>
                </div>
                <div class="div">

                    <select wire:model.change="sortType"
                        class="  py-2.5 bg-transparent   text-sm w-full  border border-gray-300  rounded-lg focus:outline-gray-300  ">
                        <option value="new">Paling Terbaru</option>
                        <option value="az">Judul A - Z</option>
                        <option value="za">Judul Z - A</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-screen-xl mx-auto flex flex-wrap mt-3 justify-start   ">
        @forelse($books as $book)
            <div class="w-1/6  mb-3 pe-3 [&:nth-child(6n)]:pe-0">

                <x-card-book :id="$book->id" :myBookmark="$myBookmark" :cover="$book->cover" :stock="$book->stock" :title="$book->title"
                    :author="$book->authors" />

            </div>
        @empty
            <div class="flex justify-center items-center w-full h-[50vh]">
                <p class="text-2xl font-bold text-black">Buku tidak ditemukan</p>
            </div>
        @endforelse
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
