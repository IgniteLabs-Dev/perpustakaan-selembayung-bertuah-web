<div class="hidden md:flex z-20 flex-col w-64 bg-gray-50">
    <div class="flex items-center justify-center h-16 bg-gray-50">
        <div class="flex items-start  flex-col">
            <p class="font-medium text-[11px]  mb-0">ADMIN PERPUSTAKAAN</p>
            <p class="self-center text-xl p-0 m-0 font-bold  whitespace-nowrap ">
                SELEMBAYUNG BERTUAH</p>
        </div>
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">

        <nav class="flex-1   bg-gray-50">
            <div class=" mt-3">

                <small class="ps-5 text-gray-500">ADMIN</small>
                <a href="{{ route('admin-manajemen-user') }}" class="mb-3">

                    <a href="{{ route('admin-manajemen-user') }}"
                        class="flex items-center ps-5 px-4 py-2   
                    {{ request()->routeIs('admin-manajemen-user') ? 'bg-[#26537b]  text-white 3' : 'bg-transparent text-gray-700 border-r-0' }}
                    hover:brightness-90">

                        <i class="fa-solid fa-user"></i>
                        <span class="ms-2">Manajemen User</span>
                    </a>
                </a>
            </div>
            <div class="">

                <a href="{{ route('admin-manajemen-buku') }}" class="mb-3">

                    <a href="{{ route('admin-manajemen-buku') }}"
                        class="flex items-center ps-5 px-4 py-2   
                    {{ request()->routeIs('admin-manajemen-buku') ? 'bg-[#26537b]  text-white 3' : 'bg-transparent text-gray-700 border-r-0' }}
                    hover:brightness-90 hover:bg-[#26537b] hover:text-white">

                        <i class="fa-solid fa-book"></i>
                        <span class="ms-2">Manajemen Buku</span>
                    </a>
                </a>
            </div>
            <div class="">

                <a href="{{ route('admin-manajemen-penulis') }}" class="mb-3">

                    <a href="{{ route('admin-manajemen-penulis') }}"
                        class="flex items-center ps-5 px-4 py-2   
                    {{ request()->routeIs('admin-manajemen-penulis') ? 'bg-[#26537b]  text-white 3' : 'bg-transparent text-gray-700 border-r-0' }}
                    hover:brightness-90 hover:bg-[#26537b] hover:text-white">

                        <i class="fa-solid fa-feather-pointed"></i>
                        <span class="ms-2">Manajemen Penulis</span>
                    </a>
                </a>
            </div>
            <div class="">

                <a href="{{ route('admin-manajemen-kategori') }}" class="mb-3">

                    <a href="{{ route('admin-manajemen-kategori') }}"
                        class="flex items-center ps-5 px-4 py-2   
                    {{ request()->routeIs('admin-manajemen-kategori') ? 'bg-[#26537b]  text-white 3' : 'bg-transparent text-gray-700 border-r-0' }}
                    hover:brightness-90 hover:bg-[#26537b] hover:text-white">

                        <i class="fa-solid fa-tags"></i>
                        <span class="ms-2">Manajemen Kategori</span>
                    </a>
                </a>
            </div>

        </nav>
    </div>
</div>
