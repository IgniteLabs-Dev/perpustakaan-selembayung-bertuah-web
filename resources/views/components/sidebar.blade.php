<div x-data="{ open: true }" class="flex">
    <!-- Sidebar -->
    <div :class="open ? 'w-64' : 'w-16'" class="hidden md:flex z-20 flex-col bg-gray-50 transition-all duration-300">
        <div class="flex items-center justify-center h-16 bg-gray-50">
            <div class="flex items-start flex-col" :class="!open && 'hidden'">
                <p class="font-medium text-[11px] mb-0">ADMIN PERPUSTAKAAN</p>
                <p class="self-center text-xl p-0 m-0 font-bold whitespace-nowrap">SELEMBAYUNG BERTUAH</p>
            </div>
        </div>
        <div class="flex flex-col flex-1 overflow-y-auto">
            <nav class="flex-1 bg-gray-50">
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-user') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-user') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-user"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Manajemen User</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-buku') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-buku') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-book"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Manajemen Buku</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-penulis') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-penulis') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-feather-pointed"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Manajemen Penulis</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-kategori') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-kategori') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-tags"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Manajemen Kategori</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-peminjaman') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-peminjaman') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-address-book"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Manajemen Peminjaman</span>
                    </a>
                </div>
                <div class="px-2 py-[1px]">
                    <a href="{{ route('admin-manajemen-reward') }}"
                        class="flex items-center px-4 py-2 rounded-lg 
                        {{ request()->routeIs('admin-manajemen-reward') ? 'bg-[#26537b] text-white' : 'bg-transparent text-gray-700' }} 
                        hover:brightness-90 hover:bg-[#26537b] hover:text-white">
                        <i class="fa-solid fa-medal"></i>
                        <span class="ms-2" :class="!open && 'hidden'">Manajemen Reward</span>
                    </a>
                </div>
            </nav>

            <div class="flex " :class="open ? 'justify-end' : 'justify-center'">
                <div class="px-2 py-[1px] mt-auto mb-10">
                    <button @click="open = !open"
                        class="bg-gray-200 p-3 rounded-lg cursor-pointer hover:bg-gray-300 transition-all duration-300"
                        :class="open ? 'ms-5' : 'ms-0'">
                        <i class="transition-transform duration-300"
                            :class="open ? 'fa-solid fa-angles-left rotate-0' : 'fa-solid fa-angles-left rotate-180'"></i>
                    </button>
                </div>
            </div>


        </div>
    </div>
</div>
