<div>
    <div class="flex justify-between items-end px-0 md:px-3 ">
        <h1 class="text-2xl font-bold  text-black  ">Buku Terbaru</h1>
        <a href="{{ route('jelajahi-buku') }}">
            <small class="text-black ">Lihat Lainya</small>
        </a>
    </div>
    <div
        class=" mx-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6  pb-10 mt-3 justify-start ">
        @forelse($books as $book)
            <div class="max-w-[220px] mb-3
 
        pe-1.5 ps-1.5">
                <x-card-book :id="$book->id" :myBookmark="$myBookmark" :cover="$book->cover" :stock="$book->available_stock" :title="$book->title"
                    :author="$book->authors" />
            </div>
        @empty
            <div class="flex justify-center items-center w-full h-[50vh]">
                <p class="text-2xl font-bold text-black">Buku tidak ditemukan</p>
            </div>
        @endforelse

    </div>
   
</div>
