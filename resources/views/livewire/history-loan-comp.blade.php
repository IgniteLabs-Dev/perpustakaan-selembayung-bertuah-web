<div>
    <div class="max-w-screen-xl mx-auto pt-25 flex flex-col">
        <div class="flex w-full justify-between mb-3">
            <div class="div items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Riwayat Peminjaman</h1>
            </div>
            <div class="flex justify-end items-center gap-2">
                <div class="div">
                    <input wire:model.live="search" type="text"
                        class="bg-white w-full  p-2 placeholder:italic  outline-slate-300 outline-1  rounded-lg focus:outline-slate-300"
                        placeholder="Masukkan Pencarian">
                </div>
                <div class="div">

                </div>
            </div>
        </div>

        <div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg">
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
                            <td class="px-6 py-3  text-gray-900 font-normal whitespace-nowrap">
                                <img class="rounded-md h-30" src="{{ asset('images/books/' . $item->book->cover) }}"
                                    alt="">
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
                            <td colspan="9" class="text-center py-4 text-gray-900">Data Tidak Ditemukan</td>
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
