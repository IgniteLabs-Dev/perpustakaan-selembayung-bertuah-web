<div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-[#164f81]  ">
                <tr>
                    <th scope="col" class="px-6 py-4">
                        Product name
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Color
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @for ($i = 1; $i <= 15; $i++)
                    <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200">
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                            Apple MacBook Pro 17" - {{ $i }}
                        </th>
                        <td class="px-6 py-3">
                            Silver
                        </td>
                        <td class="px-6 py-3">
                            Laptop
                        </td>
                        <td class="px-6 py-3">
                            $2999
                        </td>
                        <td class="px-6 py-3">
                            <button @click="$dispatch('open-modal')" type="button"
                                
                                class="cursor-pointer hover:text-blue-500 hover:scale-110 rounded-full">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                @endfor


            </tbody>
        </table>
    </div>
    <!-- Modal -->
    {{-- <div x-data="{ open: @entangle('isOpen') }" x-cloak>
        <div x-show="open" class="fixed inset-0 z-60 flex items-center justify-center bg-[#00000080]"
           >
            <div class="bg-white p-6 rounded shadow-lg" @click.away="open = false">
                <h2 class="text-lg font-bold">Modal Title</h2>
                <p class="mt-2">Isi modalnya di sini.</p>

                <button wire:click="closeModal" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">
                    Close
                </button>
            </div>
        </div>
    </div> --}}

    <div x-data="{ open: false }" x-on:open-modal.window="open = true" x-on:close-modal.window="open = false"
        x-show="open" class="relative z-50" x-cloak>

        <div @click="open = false" x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-50"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-50"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black opacity-50">
        </div>


        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden">
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                class="relative p-4 w-full max-w-xl max-h-full mx-auto">
                <div class="relative bg-white rounded-lg shadow-sm">

                    <div
                        class="flex items-center justify-between px-4 py-2 border-b rounded-t bg-blue-200 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-600">
                            Approval Pengajuan Perdin
                        </h3>
                        <button type="button" @click="open = false"
                            class="text-gray-600 flex  cursor-pointer bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto  justify-center items-center active:scale-110 transition duration-150 ease-in-out">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 md:p-5 space-y-4 " wire:loading.class="relative flex justify-center items-center">

                        <span wire:loading class="loader scale-150 my-5"></span>

                        <div wire:loading.class="hidden" class="block">

                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
