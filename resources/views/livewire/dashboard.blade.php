<div>


    {{-- <div class="w-full bg-white border border-gray-200 rounded-lg shadow-sm  ">
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select tab</label>
            <select id="tabs"
                class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <option>Statistics</option>
                <option>Services</option>
                <option>FAQ</option>
            </select>
        </div>

        <div id="fullWidthTabContent" class="border-t border-gray-200 ">
            <div class="flex justify-center p-4 bg-white rounded-lg md:p-8 " id="stats" role="tabpanel"
                aria-labelledby="stats-tab">
                <dl
                    class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-4  sm:p-8">
                    <div class="flex flex-col items-center justify-center">
                        <dt class="mb-2 text-3xl font-extrabold">73M+</dt>
                        <dd class="text-gray-500 ">Pengunjung</dd>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <dt class="mb-2 text-3xl font-extrabold">100M+</dt>
                        <dd class="text-gray-500 ">Judul Buku</dd>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <dt class="mb-2 text-3xl font-extrabold">1000s</dt>
                        <dd class="text-gray-500 ">Stok Buku Tersedia</dd>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <dt class="mb-2 text-3xl font-extrabold">1B+</dt>
                        <dd class="text-gray-500 ">Buku Dipinjam</dd>
                    </div>

                </dl>
            </div>


        </div>
    </div> --}}
    <div class="grid  grid-cols-3 gap-4 p-4  text-gray-900 3 ">

        <div class="flex flex-col h-36 py-5 items-center justify-center   rounded-lg shadow-sm bg-white p-4">
            <dt class="mb-2 text-3xl font-extrabold">{{ $visitor }}</dt>
            <dd class="text-gray-500 ">Pengunjung</dd>
        </div>
        <div class="flex flex-col h-36 py-5 items-center justify-center   rounded-lg shadow-sm bg-white p-4">
            <dt class="mb-2 text-3xl font-extrabold">{{ $book }}</dt>
            <dd class="text-gray-500 ">Judul Buku</dd>
        </div>
        <div class="flex flex-col h-36 py-5 items-center justify-center   rounded-lg shadow-sm bg-white p-4">
            <dt class="mb-2 text-3xl font-extrabold">{{ $bookStock }}</dt>
            <dd class="text-gray-500 ">Stok Buku Tersedia</dd>
        </div>
        <div class="flex flex-col h-36 py-5 items-center justify-center   rounded-lg shadow-sm bg-white p-4">
            <dt class="mb-2 text-3xl font-extrabold">{{ $author }}</dt>
            <dd class="text-gray-500 ">Penulis</dd>
        </div>
        <div class="flex flex-col h-36 py-5 items-center justify-center   rounded-lg shadow-sm bg-white p-4">
            <dt class="mb-2 text-3xl font-extrabold">{{ $category }}</dt>
            <dd class="text-gray-500 ">Kategori</dd>
        </div>
        <div class="flex flex-col h-36 py-5 items-center justify-center   rounded-lg shadow-sm bg-white p-4">
            <dt class="mb-2 text-3xl font-extrabold">{{ $loan }}</dt>
            <dd class="text-gray-500 ">Buku Dipinjam</dd>
        </div>
    </div>

</div>
