<div>
    <div class="flex justify-between items-end">
        <h1 class="text-2xl font-bold  text-black  ">Buku Terbaru</h1>
        <a href="#">
            <small class="text-black ">Lihat lainnya</small>
        </a>
    </div>
    <div class="flex justify-between items-start pt-2 flex-wrap">
        @forelse($books as $book)
            <div class="w-1/6  mb-3 pe-3 [&:nth-child(6n)]:pe-0">

                <x-card-book :id="$book->id" :myBookmark="$myBookmark" :cover="$book->cover" :stock="$book->available_stock" :title="$book->title"
                    :author="$book->authors" />
            </div>
        @empty
        @endforelse

    </div>
</div>
