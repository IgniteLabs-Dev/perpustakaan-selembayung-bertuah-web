<div>
    <div class="w-full bg-stripes">
        <div class="max-w-screen-xl mx-auto">
            <h1 class="text-2xl font-bold text-center text-black pt-20 ">Rekomendasi Buku</h1>
            <div class="flex justify-center items-end space-x-6 pt-5 pb-25">
                @forelse ($books as $index => $book)
                    <img class="{{ $heights[$index % count($heights)] }} rounded-md"
                        src="{{ asset('images/books/' . $book->cover) }}" alt="">
                @empty
                @endforelse

            </div>
        </div>
    </div>
</div>
