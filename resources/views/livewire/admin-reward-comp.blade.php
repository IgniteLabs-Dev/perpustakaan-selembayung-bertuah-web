<div>
    <div class="flex justify-between mb-3 mt-5">
        <div class="div items-center">
            <h1 class="text-2xl font-bold text-gray-900">Point</h1>
        </div>
        <div class="flex justify-end items-center ">
            <div class="div me-2 flex items-center ">
                <p class=" text-md me-1.5">Urutkan :</p>
                <div class="div">

                    <select wire:model.change="sort"
                        class=" bg-white py-2.5  cursor-pointer  text-sm w-full  border border-gray-300  rounded-lg focus:outline-gray-300  ">
                        <option value="desc">Point Terbanyak</option>
                        <option value="asc">Point Terendah</option>
                    </select>
                </div>

            </div>
            <div class="div">
                <input wire:model.live="search" type="text"
                    class="bg-white w-full  p-2 placeholder:italic  border-1  border-slate-300  rounded-lg focus:border-slate-300"
                    placeholder="Masukkan Nama Siswa">
            </div>

        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
