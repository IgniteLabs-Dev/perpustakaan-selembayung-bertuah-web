<div>

    <div class="w-full bg-stripes">
        <div class="max-w-screen-xl mx-auto">
            <h1 class="text-4xl shadow-text font-bold text-center text-[var(--primary)] pt-20 ">Rekomendasi Buku</h1>
            <div class="flex justify-center items-end  pt-0 pb-20 z-10">
                <div class="owl-carousel carousel-1 ">

                    @forelse ($books as $index => $book)
                        <a href="{{ route('detail-buku', ['id' => $book->id]) }}" class="flex w-auto min-w-[122px] my-5 py-5">
    
                            <img class="{{ $heights[$index % count($heights)] }} w-150 hover:scale-110 hover:shadow-md object-cover transition-transform duration-200 ease-in-out   rounded-md "
                                src="{{ asset('images/books/' . $book->cover) }}" alt="">
                        </a>
                    @empty
                    @endforelse
                </div>

            </div>
        </div>
    </div>
 
</div>
