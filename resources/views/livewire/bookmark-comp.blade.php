<div>
    <div class="max-w-screen-xl mx-auto pt-25 flex  flex-col">
        <div class=" w-full mb-3 ">
            <div class="border-gray-300 bg-white border rounded-lg shadow-sm py-3 px-3 font-semibold w-full">
                <p class="text-lg font-bold text-[var(--primary)] !important"><i
                        class="fa-solid fa-circle-info me-1"></i>Proses Peminjaman</p>
                <hr class="text-gray-400 mt-1 mb-1">
                <p class="text-xs font-normal">Anda dapat meminjam buku dengan mengunjungi perpustakaan secara langsung
                    dan
                    memilih
                    koleksi yang tersedia.</p>
            </div>
        </div>
        <div class=" w-full  flex  flex-wrap">
            <div class="border-gray-300 bg-white  border rounded-lg shadow-sm p-3 font-semibold w-full    flex-col flex-wrap">
                <div class="w-full">

                    <div class="div  mb-3">
                        <input wire:model.live="search" type="search" id="default-search"
                            class="block border border-gray-300 ring-[var(--primary)] bg-gray-100 rounded-lg w-full py-3 px-2 focus:outline-0 focus:outline-transparent text-sm  "
                            placeholder="Masukkan judul atau penulis" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 sm:grid-cols-2  gap-2">
                        @forelse($data as $item)
                            <div class="w-full mb-0 h-full">

                                <div class="border-gray-300 p-3 border flex rounded-lg justify-start">
                                    <div class="flex  ">
                                        <div class="w-3/7">

                                            <a class="h-full"
                                                href="{{ route('detail-buku', ['id' => $item->book->id]) }}">
                                                <img class="w-36  hover:scale-102 transition-transform duration-300 ease-in-out object-cover rounded-lg  "
                                                    src="{{ asset('images/books/' . $item->book->cover) }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="ms-2 flex w-4/7 flex-col ">
                                            <a href="{{ route('detail-buku', ['id' => $item->book->id]) }}">
                                                <div class="flex flex-col flex-wrap">

                                                    <p
                                                        class="text-xs mb-0  text-gray-700 overflow-hidden text-ellipsis hover:whitespace-normal whitespace-nowrap max-w-[150px]">
                                                        {{ $item->authors }}
                                                    </p>

                                                    <h1
                                                        class="text-md font-bold mb-1 mt-0 whitespace- text-black leading-tight">
                                                        {{ $item->book->title }} </h1>
                                                    <p class="text-xs  text-black">Stok :
                                                        {{ $item->book->stock ?? '' }}</p>
                                                </div>
                                            </a>

                                            <button wire:click="removeBookmark({{ $item->book_id }})"
                                                class=" cursor-pointer mt-auto hover:scale-105 transition-transform duration-300 ease-in-out rounded-full outline-1 outline-red-700 text-red-700  hover:bg-red-700  hover:text-white hover:shadow-sm focus:ring-0 focus:outline-1 focus:ring-gray-300 font-medium text-xs px-2 py-1 active:outline-0 active:outline-none">Hapus
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
        </div>

    </div>

</div>
