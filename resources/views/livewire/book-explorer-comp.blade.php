<div>
    <div class="max-w-screen-xl mx-auto pt-25 flex">
        <div class="w-5/6 pe-2">
            <input wire:model.live="search" type="search" id="default-search"
                class="block border border-gray-300 rounded-xl w-full py-3 px-2 focus:outline-0 focus:outline-transparent text-sm  "
                placeholder="Masukkan judul atau penulis" required />
        </div>
        <div class="w-1/6 flex">
            <div class="w-[50%] pe-1">

                <select id="countries"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option selected>Kategori</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            <div class="w-[50%] ps-1">
                <select id="countries"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option selected>Penulis</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
        </div>
    </div>
    <div class="max-w-screen-xl mx-auto flex flex-wrap mt-3 justify-start   ">
        @forelse($books as $book)
            <div class="w-1/6  mb-3 pe-3 [&:nth-child(6n)]:pe-0">

                <x-card-book :id="$book->id" :myBookmark="$myBookmark" :cover="$book->cover" :stock="$book->stock" :title="$book->title"
                    :author="$book->authors" />

            </div>
        @empty
            <div class="flex justify-center items-center w-full h-[50vh]">
                <p class="text-2xl font-bold text-black">Buku tidak ditemukan</p>
            </div>
        @endforelse
    </div>
</div>
