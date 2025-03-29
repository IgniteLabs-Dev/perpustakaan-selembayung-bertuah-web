<div>
    <div class="max-w-screen-xl mx-auto pt-25 flex  ">
        <div class="border-1 border-gray-300 rounded-lg shadow-sm  py-3 px-3 font-semibold w-full flex flex-col ">

            <div class="flex ">
                <div class="w-1/4">
                    <img class="rounded-lg block " src="{{ asset('images/books/' . $data->cover) }}" alt="cover">
                </div>
                <div class="w-3/4 flex flex-col ps-3">
                    <h3 class="text-3xl  text-[var(--primary)] font-bold">{{ $data->title }}</h3>

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
                        <p class="text-sm text-gray-900 font-normal">{{ $data->deskripsi }}</p>
                    </div>
                    <div class="flex mt-auto">
                        @if (in_array($id, $myBookmark))
                            <button wire:click="removeBookmark({{ $id }})"
                                class="bg-red-500 cursor-pointer text-white px-3 py-2.5 rounded-lg">
                                <i class="fa-solid fa-trash me-1.5"></i>Hapus Dari Bookmark
                            </button>
                        @else
                            <button wire:click="addBookmark({{ $id }})"
                                class="bg-[var(--primary)] cursor-pointer text-white px-3 py-2.5 rounded-lg">
                                <i class="fa-solid fa-bookmark me-1.5"></i>Tambah ke Bookmark
                            </button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
