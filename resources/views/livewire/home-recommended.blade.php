<div>
    <div class="w-full bg-stripes">
        <div class="max-w-screen-xl mx-auto">
            <h1 class="text-2xl font-bold text-center text-[var(--primary)] pt-20 ">Rekomendasi Buku</h1>
            <div class="flex justify-center items-end space-x-6 pt-5 pb-25">
                @forelse ($books as $index => $book)
                    <a href="{{ route('detail-buku', ['id' => $book->id]) }}">

                        <img class="{{ $heights[$index % count($heights)] }} hover:scale-110 hover:shadow-md transition-transform duration-200 ease-in-out   rounded-md"
                            src="{{ asset('images/books/' . $book->cover) }}" alt="">
                    </a>
                @empty
                @endforelse

            </div>
        </div>
    </div>
</div>
