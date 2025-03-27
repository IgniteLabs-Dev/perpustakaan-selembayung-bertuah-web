<div>
    <div class="max-w-screen-xl mx-auto pt-25 flex">
        <div class="w-4/5 pe-2 flex ">
            <div
                class="border-gray-300 min-h-120 border rounded-lg shadow-sm py-3 ps-3 font-semibold w-full flex flex-col flex-wrap">
                <div class="div pe-3">
                    <input wire:model.live="search" type="search" id="default-search"
                        class="block border border-gray-300 rounded-lg w-full py-3 px-2 focus:outline-0 focus:outline-transparent text-sm  "
                        placeholder="Masukkan judul atau penulis" required />
                </div>

                <div class="flex mt-2">
                    @forelse($data as $item)
                        <div class="w-1/3 mb-3 pe-3">
                            <div class="border-gray-300 p-3 border rounded-lg">
                                <div class="flex">

                                    <img class="w-35 hover:scale-102 transition-transform duration-300 ease-in-out object-cover rounded-lg  "
                                        src="{{ asset('images/books/' . $item->book->cover) }}" alt="">
                                    <div class="ms-2 flex  flex-col ">
                                        <div class="flex flex-col">

                                            <p
                                                class="text-xs mb-0 mt-2 text-gray-700 overflow-hidden text-ellipsis hover:whitespace-normal whitespace-nowrap max-w-[150px]">
                                                {{ $item->authors }}
                                            </p>

                                            <h1 class="text-md font-bold mb-1 mt-0 text-black leading-tight">
                                                {{ $item->book->title }} </h1>
                                            <p class="text-xs  text-black">Stok : {{ $item->book->stock ?? '' }}</p>
                                        </div>


                                        <button wire:click="removeBookmark({{ $item->book_id }})"
                                            class="mt-auto cursor-pointer hover:scale-105 transition-transform duration-300 ease-in-out rounded-full outline-1   bg-red-800  text-white hover:shadow-sm focus:ring-0 focus:outline-1 focus:ring-gray-300 font-medium text-xs px-2 py-1 active:outline-0 active:outline-none">Hapus
                                            dari
                                            Bookmark</button>


                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="w-full text-center justify-center flex items-center">
                            <p class="text-md font-semibold  text-gray-600"> Bookmark Kosong</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="w-1/5 ">
            <div class="border-gray-300 border rounded-lg shadow-sm py-3 px-3 font-semibold w-full">
                <p class="text-lg font-bold text-[var(--primary)] !important"><i
                        class="fa-solid fa-circle-info me-1"></i>Proses Peminjaman</p>
                <hr class="text-gray-400 mt-1 mb-1">
                <p class="text-xs font-normal">Anda dapat meminjam buku dengan mengunjungi perpustakaan secara langsung
                    dan
                    memilih
                    koleksi yang tersedia.</p>
            </div>
        </div>
    </div>
</div>
