<div x-data="{ open: true }" class="hidden xl:flex">
    <!-- Sidebar -->
    <div :class="open ? 'w-64' : 'w-16'" class="hidden md:flex z-20 flex-col  bg-gray-50 transition-all duration-300">
        <div class="flex items-center justify-center h-16 bg-gray-50">
            <div class="flex items-start flex-col">
                <a href="/">
                    <!-- Gambar atas (muncul saat open = true) -->
                    <img class="h-12 w-auto" :class="open ? 'block' : 'hidden'"
                        src="{{ asset('images/Perpustakaan Icon.png') }}" alt="">

                    <!-- Gambar bawah (muncul saat open = false) -->
                    <img class="h-12 w-auto" :class="open ? 'hidden' : 'block'" src="{{ asset('images/Icon.png') }}"
                        alt="">

                </a>
            </div>
        </div>
        <div class="flex flex-col flex-1 overflow-y-auto mt-2">
            <nav class="flex-1 bg-gray-50">
                <div class="px-2 py-[1px]">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('dashboard') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-home"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Dashboard</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-user') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-user') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-user"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Kelola User</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-buku') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-buku') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-book"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Kelola Buku</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-penulis') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-penulis') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-feather-pointed"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Kelola Penulis</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-kategori') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-kategori') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-tags"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Kelola Kategori</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-peminjaman') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-peminjaman') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-address-book"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Kelola Peminjaman</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-point') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-point') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-medal"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Kelola Point</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-pengunjung') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-pengunjung') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-user-secret   "></i>
                        <span class="ms-2" :class="!open && 'hidden'">Kelola Pengunjung</span>
                    </a>
                </div>
            </nav>
            <div class="mt-auto">

                @livewire('send-email')

                <div class="flex w-full " :class="open ? 'justify-start' : 'justify-center'">
                    <div class="px-2 py-[1px] w-full  mb-5 mt-3">
                        <button @click="open = !open"
                            class="bg-gray-200 p-3 rounded-lg cursor-pointer flex justify-between items-center hover:bg-gray-300 transition-all duration-300"
                            :class="open ? '  w-full' : 'ms-0'">
                            <i class="transition-transform duration-300"
                                :class="open ? 'fa-solid fa-angles-left rotate-0' : 'fa-solid fa-angles-left rotate-180'"></i>
                            <span x-show="open">Collapse Sidebar</span>
                            <div class="div"></div>
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>


</div>
