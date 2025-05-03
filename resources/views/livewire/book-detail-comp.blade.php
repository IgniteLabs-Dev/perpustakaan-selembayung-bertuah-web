<div>
    @section('title', $data->title)
    <div class="max-w-screen-xl mx-auto pt-25 flex  ">
        <div class="border-0  rounded-lg  bg-white  font-semibold w-full flex flex-col ">

            <div class="flex flex-col md:flex-row">
                <div class="md:w-[310px] lg:w-[380px] flex justify-between md:justify-start">
                    <div class="flex  justify-center items-start">
                        <a href="{{ url()->previous() ?: '/' }}">

                            <button
                                class="border shadow-sm border-gray-200 p-3 rounded-full cursor-pointer hover:bg-gray-200 hover:scale-110 transition-all">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                        </a>
                    </div>
                    <div class="md:flex-col md:justify-center md:ms-2">

                        <img class="rounded-lg h-[350px] " src="{{ asset('images/books/' . $data->cover) }}"
                            alt="cover">
                        <div class="hidden mt-3 w-full md:flex">
                            @if (in_array($id, $myBookmark))
                                <button wire:click="removeBookmark({{ $id }})"
                                    class="bg-red-500 w-full cursor-pointer text-white px-3 py-2.5 rounded-lg">
                                    <i class="fa-solid fa-trash me-1.5"></i>Hapus dari Favorit
                                </button>
                            @else
                                <button wire:click="addBookmark({{ $id }})"
                                    class="bg-[var(--primary)] w-full cursor-pointer text-white px-3 py-2.5 rounded-lg">
                                    <i class="fa-solid fa-bookmark me-1.5"></i>Tambah ke Favorit
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="flex md:hidden justify-center items-start">
                        @if (in_array($id, $myBookmark))
                            <button wire:click="removeBookmark({{ $id }})"
                                class="border shadow-sm border-gray-200 p-3 rounded-full cursor-pointer hover:bg-gray-200 hover:scale-110 transition-all ">
                                <i class="fa-solid fa-bookmark text-[var(--primary)]"> </i>
                            </button>
                        @else
                            <button wire:click="addBookmark({{ $id }})"
                                class="border shadow-sm border-gray-200 p-3 rounded-full cursor-pointer hover:bg-gray-300 hover:scale-110 transition-all ">
                                <i class="fa-regular fa-bookmark "> </i>
                            </button>
                        @endif

                    </div>
                </div>
                <div class="w-full md:w-4/6 lg:w-full  flex flex-col ps-3">
                    <h3 class="text-2xl md:text-3xl mt-3 md:mt-0  text-[var(--primary)] font-bold">{{ $data->title }}
                    </h3>

                    <div class="flex">

                        <table class="table-auto border-0 border-collapse   ">
                            <tr>
                                <td class="font-semibold pt-1">Stok</td>
                                <td class="ps-4 pt-1">:
                                    <span class="{{ $data->stock - $loaned == 0 ? 'text-red-500' : '' }}">
                                        {{ $data->stock - $loaned }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-semibold pt-1">Kategori</td>
                                <td class="ps-4 pt-1">: {{ $categories }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold pt-1">Tanggal Terbit</td>
                                <td class="ps-4 pt-1">:
                                    {{ \Carbon\Carbon::parse($data->realese_date)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold pt-1">Penerbit</td>
                                <td class="ps-4 pt-1">: {{ $data->publisher }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold pt-1">Penulis</td>
                                <td class="ps-4 pt-1">: {{ $authors }}</td>
                            </tr>

                        </table>
                    </div>
                    <div class="mt-1">
                        <p class="">Deskripsi :</p>
                        <p class="text-md text-gray-900 font-normal">{{ $data->deskripsi }}</p>
                    </div>
                    {{-- <div class="hidden mt-3 w-full lg:flex">
                        @if (in_array($id, $myBookmark))
                            <button wire:click="removeBookmark({{ $id }})"
                                class="bg-red-500 w-full cursor-pointer text-white px-3 py-2.5 rounded-lg">
                                <i class="fa-solid fa-trash me-1.5"></i>Hapus dari Favorit
                            </button>
                        @else
                            <button wire:click="addBookmark({{ $id }})"
                                class="bg-[var(--primary)] w-full cursor-pointer text-white px-3 py-2.5 rounded-lg">
                                <i class="fa-solid fa-bookmark me-1.5"></i>Tambah ke Bookmark
                            </button>
                        @endif
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
</div>
