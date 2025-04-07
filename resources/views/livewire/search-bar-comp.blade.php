<div>

    <div class="mx-auto z-30">
        <div
            class=" flex items-center py-0 text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 ">
            <div class=" inset-y-0 start-0 flex items-center ps-3 pe-2 pointer-events-none  ">
                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" wire:model.defer="search" id="default-search"
                class="focus:ring-0 focus:outline-0 block rounded-lg w-full h-full border-0 pe-4  py-3 bg-transparent me-2 text-sm  "
                placeholder="Masukkan Judul atau Penulis..." required />
            <button type="button" wire:click="searchBook"
                class="text-white me-2 cursor-pointer end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium  text-sm px-4 py-2 rounded-full">Search</button>
        </div>

    </div>
    <div class="flex mt-3 owl-carousel carousel-2 mb-0">
        @forelse($categories as $category)
            <a href="{{ route('jelajahi-buku', ['search' => $category->name]) }}" target="_blank">
                <button type="button"
                    class="text-black cursor-pointer my-1 rounded-full me-2 outline-1 outline-gray-300 bg-white hover:bg-gray-100 hover:text-black whitespace-nowrap hover:shadow-md focus:ring-0 focus:outline-1 focus:ring-gray-300 font-medium text-sm px-4 py-2 active:outline-0 active:outline-none">{{ $category->name }}</button>
            </a>
        @empty
        @endforelse
    </div>

</div>
