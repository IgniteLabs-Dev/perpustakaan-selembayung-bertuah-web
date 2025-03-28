<div>
    <div class="flex justify-between mb-3 mt-5">
        <div class="div items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Data Pengguna</h1>
        </div>
        <div class="flex justify-end items-center gap-2">
            <div class="div">
                <input wire:model.live="search" type="text"
                    class="bg-white w-full  p-2 placeholder:italic  outline-slate-300 outline-1  rounded-lg focus:outline-slate-300"
                    placeholder="Masukkan Pencarian">
            </div>
            <div class="div">

                <button @click="$dispatch('open-modal')" type="button"
                    class="flex items-center justify-center cursor-pointer px-4 py-2 text-sm font-medium bg-[var(--primary)] border-2 text-white border-[var(--primary)] rounded-lg hover:brightness-95 hover:scale-105 hover:bg-[var(--primary)] hover:text-white hover:shadow-md transition duration-150 ease-in-out">
                    <i class="fa-solid fa-plus me-2"></i>
                    Tambah Pengguna
                </button>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-[#164f81]  ">
                <tr>
                    <th scope="col" class="px-6 py-4 text-center">
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

                @forelse ($data as  $item)
                    <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200">
                        <td scope="row" class="px-6 py-3 text-center font-normal text-gray-900 whitespace-nowrap">
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


                            <button wire:click="edit({{ $item->id }})" @click="$dispatch('open-modal')"
                                type="button"
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



            </tbody>
        </table>
    </div>

    <div class="mt-3 ">
        {{ $data->links('vendor.livewire.tailwind') }}
    </div>
</div>
