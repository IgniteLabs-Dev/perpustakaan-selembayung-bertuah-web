<div>
    @section('title', 'Manajemen Point')

    <div class="flex justify-between mb-3 mt-5 flex-col sm:flex-row">
        <div class="w-full sm:w-auto flex items-center justify-center sm:justify-start div mb-2  md:mb-0">
            <h1 class="text-2xl font-bold   text-gray-900">Point</h1>
        </div>
        <div class="w-full sm:w-auto flex items-center  justify-end  gap-2">
            <div class="md:w-auto w-1/2 sm:w-auto flex justify-end sm:whitespace-nowrap">
                <select wire:model.change="sort"
                    class=" bg-white p-2.5  cursor-pointer  text-sm w-full  border border-gray-300  rounded-lg focus:outline-gray-300  ">
                    <option value="desc">Point Terbanyak</option>
                    <option value="asc">Point Terendah</option>
                </select>
            </div>
            <div class="md:w-auto w-1/2 sm:w-auto flex justify-end sm:whitespace-nowrap">

                <input wire:model.live="search" type="text"
                    class="bg-white w-full  p-2 placeholder:italic  border-1  border-slate-300  rounded-lg focus:border-slate-300"
                    placeholder="Masukkan Nama Siswa">
            </div>
        </div>
    </div>



    <div class="relative overflow-x-auto shadow-md rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-[#164f81]  ">
                <tr>
                    <th scope="col" class="px-6 py-4 ">
                        No
                    </th>
                    <th scope="col" class="px-6 py-4 ">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Point
                    </th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($data->count() > 0)

                    @forelse ($data as  $item)
                        <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200">
                            <td scope="row" class="px-6 py-3  font-normal text-gray-900 whitespace-nowrap">
                                {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-3  text-gray-900 font-normal whitespace-nowrap">
                                {{ $item->user->name }}
                            </td>
                            <td class="px-6 py-3 justify-center text-center  text-gray-900 font-normal ">
                                <div class="flex justify-center">
                                    @if ($item->final_point > 0)
                                        <div
                                            class=" text-xs px-1 text-green-600 bg-green-100 outline-1 outline-green-600 rounded-full">
                                            {{ $item->final_point }}
                                        </div>
                                    @else
                                        <div
                                            class=" text-xs px-1 text-red-600 bg-red-100 outline-1 outline-red-600 rounded-full">
                                            {{ $item->final_point }}
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 flex py-3 justify-center text-center text-gray-900 font-normal gap-1 ">


                                <button @click="$dispatch('open-modal2')" type="button"
                                    wire:click="showHistory({{ $item->user->id }})"
                                    class="cursor-pointer hover:brightness:95 text-blue-500 hover:scale-120 rounded-full">
                                    <i class="fa-solid fa-eye"></i>
                                </button>


                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-900">Data Tidak Ditemukan</td>
                        </tr>
                    @endforelse
                @endif



            </tbody>
        </table>
    </div>

    <div class="mt-3 ">
        {{ $data->links('vendor.livewire.tailwind') }}
    </div>

    <div x-data="{ openSecond: false, zoomImage: '' }" x-cloak x-show="openSecond"
        x-on:open-modal2.window="openSecond = true; zoomImage = $event.detail.image"
        x-on:close-modal2.window="openSecond = false"
        class="fixed inset-0 z-20 flex items-center justify-center bg-black/50">

        <div class="justify-center flex shadow-lg" @click.away="openSecond = false">
            <div class="relative bg-white rounded-xl shadow-sm max-w-xl min-w-xl max-h-full">

                <div
                    class="flex items-center justify-between px-4 py-2 border-b rounded-t-xl bg-primary border-gray-200">
                    <h3 class="text-lg font-semibold text-white">
                        Riwayat Peminjaman {{ $username }}

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



                <div class="p-4 md:p-5  " wire:loading.class="relative flex flex-col justify-center items-center">
                    <span wire:loading class="loader scale-50  my-5"></span>
                    <div class="block" wire:loading.class="hidden">

                        <div class="relative w-full overflow-x-auto rounded-t-lg">

                            <table class="w-full text-xs  text-left rtl:text-right text-gray-500 ">
                                <thead class="text-xs text-white uppercase bg-[#164f81]  ">
                                    <tr>
                                        <th scope="col" class="px-2 py-2 text-center">
                                            No
                                        </th>

                                        <th scope="col" class="px-2 py-2">
                                            Buku
                                        </th>
                                        <th scope="col" class="px-2 py-2">
                                            Pengembalian
                                        </th>
                                        <th scope="col" class="px-2 py-2 text-center">
                                            Point
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($history)

                                        @forelse ($history as  $item)
                                            <tr class="odd:bg-white  even:bg-gray-100 border-b border-gray-200">
                                                <td scope="row"
                                                    class="px-2 border-1  border-slate-300 py-3 text-center font-normal text-gray-900 ">
                                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                                </td>
                                                <td
                                                    class="px-2 border-1 border-slate-300 py-3  text-gray-900 font-normal ">
                                                    {{ $item->book->title }}
                                                </td>
                                                <td
                                                    class="px-2 border-1 border-slate-300 py-3  text-gray-900 font-normal ">
                                                    {{ \Carbon\Carbon::parse($item->returned_at)->translatedFormat('d F Y') }}
                                                </td>
                                                <td
                                                    class="px-2 border-1 border-slate-300 py-3  text-gray-900 font-normal ">
                                                    <div class="flex justify-center">

                                                        @if ($item->point > 0)
                                                            <div
                                                                class=" text-xs px-1 text-green-600 bg-green-100 outline-1 outline-green-600 rounded-full">
                                                                +{{ $item->point }}
                                                            </div>
                                                        @else
                                                            <div
                                                                class=" text-xs px-1 text-red-600 bg-red-100 outline-1 outline-red-600 rounded-full">
                                                                -{{ $item->fine }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5"
                                                    class="text-center py-4 text-gray-900 border-1 border-slate-300">
                                                    Data Tidak
                                                    Ditemukan
                                                </td>
                                            </tr>
                                        @endforelse
                                    @endif



                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 ">

                            <div class="flex justify-center flex-wrap">
                                <button @if ($currentPageHistory == 1) disabled @endif
                                    class="cursor-pointer mb-2 rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-[var(--primary)] hover:border-slate-800 focus:text-white focus:bg-[var(--primary)] focus:border-slate-800 active:border-slate-800 active:text-white active:bg-[var(--primary)] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                                    Prev
                                </button>

                                @for ($i = 1; $i <= $totalPagesHistory; $i++)
                                    <button wire:click="$set('currentPageHistory', {{ $i }})"
                                        @if ($i == $currentPageHistory) disabled @endif
                                        class="cursor-pointer mb-2 min-w-9 rounded-md  @if ($i == $currentPageHistory) bg-[var(--primary)] text-white @else text-[var(--primary)] border border-slate-300 bg-white @endif py-2 px-3  text-center text-sm  transition-all shadow-md hover:shadow-lg focus:brightness-90 focus:shadow-none active:brightness-90 hover:bg-[var(--primary)] hover:text-white active:shadow-none disabled:pointer-events-none  ml-2">
                                        {{ $i }}
                                    </button>
                                @endfor


                                <button @if ($currentPageHistory == $totalPagesHistory) disabled @endif
                                    class="cursor-pointer mb-2 min-w-9 rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-[var(--primary)] hover:border-slate-800 focus:text-white focus:bg-[var(--primary)] focus:border-slate-800 active:border-slate-800 active:text-white active:bg-[var(--primary)] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                                    Next
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
