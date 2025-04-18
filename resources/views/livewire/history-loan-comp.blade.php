<div>
    @section('title', 'Riwayat Peminjaman')
    <div class="max-w-screen-xl mx-auto pt-25 flex flex-col">
        <div class="flex justify-between mb-3 mt-5">
            <div class="div items-center mb-2 md:mb-0">
                <h1 class="text-2xl font-bold text-gray-900">Riwayat Peminjaman</h1>
            </div>
            <div class="flex justify-between md:justify-end items-center gap-2">
                <div class="md:w-auto w-1/2">
                    <div class="items-start">
                        <select wire:model.change="type"
                            class="border-1 p-2 border-slate-300 bg-white cursor-pointer  text-sm w-full h-full  rounded-lg focus:outline-gray-300 disabled:bg-gray-300 ">
                            <option value="">Semua Tipe</option>
                            <option value="literasi">Literasi</option>
                            <option value="paketan">Paketan</option>
                        </select>
                    </div>
                </div>
                <div class="md:w-auto w-1/2">
                    <input wire:model.live="search" type="text"
                        class="bg-white w-full  p-2 placeholder:italic border-1  border-slate-300   rounded-lg focus:border-slate-300"
                        placeholder="Masukkan Judul Buku">
                </div>

            </div>
        </div>

        <div class="relative w-full overflow-x-auto p-2 md:p-0 shadow-md rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-white uppercase bg-[#164f81]  ">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-center">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4 text-center">
                            Cover
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Judul
                        </th>
                        <th scope="col" class="px-6 py-4 text-center">
                            Tanggal Peminjaman
                        </th>
                        <th scope="col" class="px-6 py-4 text-center">
                            Tenggat Pengembalian
                        </th>
                        <th scope="col" class="px-6 py-4 text-center">
                            Tanggal Pengembalian
                        </th>
                        <th scope="col" class="px-6 py-4 text-center">
                            Kondisi
                        </th>
                        <th scope="col" class="px-6 py-4 text-center">
                            Point
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($data as  $item)
                        <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200">
                            <td scope="row"
                                class="px-6 py-3 text-center font-normal text-gray-900 whitespace-nowrap">
                                {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-0 py-3 text-center flex justify-center text-gray-900 font-normal ">
                                <img class="rounded-md object-cover md:h-20 md:w-auto"
                                    src="{{ asset('images/books/' . $item->book->cover) }}" alt="">
                            </td>
                            <td class="px-6 py-3  text-gray-900 font-normal whitespace-nowrap">
                                {{ $item->book->title }}
                            </td>
                            <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->borrowed_at)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->due_date)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                                @if ($item->status == 'returned')
                                    {{ \Carbon\Carbon::parse($item->returned_at)->translatedFormat('d F Y') }}
                                @else
                                    <span class="text-red-500">Belum Dikembalikan</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-center text-gray-900 font-normal whitespace-nowrap">
                                <span
                                    class="font-bold {{ $item->condition === 'hilang' ? 'text-red-500' : ($item->condition === 'rusak' ? 'text-orange-500' : 'text-[var(--primary)]') }}">
                                    {{ Str::title($item->condition) ? Str::title($item->condition) : '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-center text-gray-900 font-normal ">
                                <div class="flex justify-center ">

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
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-900">Data Tidak Ditemukan</td>
                        </tr>
                    @endforelse



                </tbody>
            </table>
        </div>

        <div class="mt-3 ">
            {{ $data->links('vendor.livewire.tailwind') }}
        </div>
    </div>


</div>
