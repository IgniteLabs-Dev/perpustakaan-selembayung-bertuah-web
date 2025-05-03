<div>
    <div x-data="{ open: true }" class="hidden xl:flex">
        <!-- Sidebar -->
        <div :class="open ? 'w-64' : 'w-16'"
            class="hidden md:flex z-20 flex-col  bg-gray-50 transition-all duration-300">
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
                <div class="px-2  " x-show="open">
                    <div class="px-3 p-4 bg-slate-200 rounded-xl">
                        <div class="flex justify-center">

                            <img src="{{ asset('images/email-icon.webp') }}" class="h-20" alt="">
                        </div>
                        <p class="text-sm  font-semibold text-center">Kirim Email Pengingat Deadline</p>
                        <p class="text-center text-xs mb-1">Kirim email pengingat kepada peminjam yang akan berakhir 1
                            hari
                            lagi.
                        </p>
                        <button data-modal-target="modal-confirmation-email"
                            data-modal-toggle="modal-confirmation-email"
                            class="w-full  bg-[var(--primary)]  text-white rounded-lg  cursor-pointer px-1.5 py-2">Kirim
                            Email
                            Peringatan</button>
                    </div>
                </div>

                <div class="flex w-full " :class="open ? 'justify-start' : 'justify-center'">
                    <div class="px-2 py-[1px] w-full  mb-5 mt-3">
                        <button @click="open = !open"
                            class="bg-gray-200 p-3 rounded-lg cursor-pointer hover:bg-gray-300 transition-all duration-300"
                            :class="open ? '  w-full' : 'ms-0'">
                            <i class="transition-transform duration-300"
                                :class="open ? 'fa-solid fa-angles-left rotate-0' : 'fa-solid fa-angles-left rotate-180'"></i>
                            <span x-show="open">Collapse Sidebar</span>
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!-- Main modal -->
    <div id="modal-confirmation-email" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 ">
                        Kirim Email Pengingat Deadline
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center  "
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-1">
                    <div class="flex justify-center">
                        <img src="{{ asset('images/email-icon.webp') }}" class="h-20" alt="">
                    </div>
                    <p class="text-base  text-center leading-relaxed text-gray-900 ">
                        Apakah Anda yakin ingin mengirimkan email pengingat kepada peminjam yang masa peminjamannya
                        tinggal 1 hari?
                    </p>

                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-center p-4 md:p-5 border-t border-gray-200 rounded-b ">
                    <button data-modal-hide="default-modal" type="button"
                        class="text-white cursor-pointer bg-[var(--primary)] hover:brightness-90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Kirim
                        Email</button>
                    <button data-modal-hide="default-modal" type="button"
                        class="py-2.5 px-5 ms-3 cursor-pointer text-sm font-medium  focus:outline-none bg-red-600 text-white rounded-lg border border-gray-200 hover:brightness-90  focus:z-10 focus:ring-4 focus:ring-gray-100    ">Batal</button>
                </div>
            </div>
        </div>
    </div>

</div>
