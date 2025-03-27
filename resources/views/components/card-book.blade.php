<div class="p-4 w-full border-2 border-gray-200 rounded-xl ">
    <a href="#" class="block">
        <img class="h-65 w-full object-cover rounded-lg hover:scale-102 transition-transform duration-300 ease-in-out"
            src="{{ asset('images/books/' . ($cover ?? '')) }}" alt="">

        <p class="text-xs mb-0 mt-2 text-gray-700 "> {{ $author ?? '' }}</p>
        <h1 class="text-lg font-bold mb-1 mt-0 text-black leading-tight text-ellipsis whitespace-nowrap overflow-hidden">
            {{ Str::limit($title ?? '', 50, '...') }}
        </h1>
        <hr class="text-gray-400">
    </a>
    <div class="flex items-center justify-between pt-2 mt-[1px]">
        <p class="text-xs  text-black">Stok : {{ $stock ?? '' }}</p>
        <button
            class=" cursor-pointer hover:scale-110 transition-transform duration-300 ease-in-out rounded-full outline-1  text-blue-700 hover:bg-blue-800  hover:text-white hover:shadow-sm focus:ring-0 focus:outline-1 focus:ring-gray-300 font-medium text-xs px-2 py-1 active:outline-0 active:outline-none">+
            Bookmark</button>
    </div>
</div>
