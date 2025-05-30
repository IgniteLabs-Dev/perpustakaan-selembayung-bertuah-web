<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm ">
            <!-- Modal header -->
            <div class="flex items-center justify-center px-1 py-2 md:p-5 border-b rounded-t  border-gray-200">
                <a href="/" class="cursor-pointer">

                    <img class="h-[80px]" src="{{ asset('images/Perpustakaan Icon.png') }}" alt="">
                </a>
            </div>
            <!-- Modal body -->
            <div class="px-4">
                <nav class="flex-1  py-2 ">
                    <div class="my-0 text-center">

                        <a href="{{ route('dashboard') }}" class="mb-3">

                            <a href="{{ route('dashboard') }}"
                                class="flex items-center ps-5 px-4 py-2 rounded-md   
                            {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                            hover:bg-blue-200">
                                <i class="fa-solid fa-home"></i>
                                <span class="ms-2">Dashboard</span>
                            </a>
                        </a>
                    </div>
                    <div class="my-0 text-center">

                        <a href="{{ route('admin-manajemen-user') }}" class="mb-3">

                            <a href="{{ route('admin-manajemen-user') }}"
                                class="flex items-center ps-5 px-4 py-2 rounded-md   
                            {{ request()->routeIs('admin-manajemen-user') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                            hover:bg-blue-200">
                                <i class="fa-solid fa-user"></i>
                                <span class="ms-2">Manajemen User</span>
                            </a>
                        </a>
                    </div>
                    <div class="my-0 text-center">

                        <a href="{{ route('admin-manajemen-buku') }}" class="mb-3">

                            <a href="{{ route('admin-manajemen-buku') }}"
                                class="flex items-center ps-5 px-4 py-2 rounded-md   
                            {{ request()->routeIs('admin-manajemen-buku') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                            hover:bg-blue-200">
                                <i class="fa-solid fa-book"></i>
                                <span class="ms-2">Manajemen Buku</span>
                            </a>
                        </a>
                    </div>
                    <div class="my-0 text-center">

                        <a href="{{ route('admin-manajemen-penulis') }}" class="mb-3">

                            <a href="{{ route('admin-manajemen-penulis') }}"
                                class="flex items-center ps-5 px-4 py-2 rounded-md   
                            {{ request()->routeIs('admin-manajemen-penulis') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                            hover:bg-blue-200">
                                <i class="fa-solid fa-feather-pointed"></i>
                                <span class="ms-2">Manajemen Penulis</span>
                            </a>
                        </a>
                    </div>
                    <div class="my-0 text-center">

                        <a href="{{ route('admin-manajemen-kategori') }}" class="mb-3">

                            <a href="{{ route('admin-manajemen-kategori') }}"
                                class="flex items-center ps-5 px-4 py-2 rounded-md   
                            {{ request()->routeIs('admin-manajemen-kategori') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                            hover:bg-blue-200">
                                <i class="fa-solid fa-tags"></i>
                                <span class="ms-2">Manajemen Kategori</span>
                            </a>
                        </a>
                    </div>
                    <div class="my-0 text-center">

                        <a href="{{ route('admin-manajemen-peminjaman') }}" class="mb-3">

                            <a href="{{ route('admin-manajemen-peminjaman') }}"
                                class="flex items-center ps-5 px-4 py-2 rounded-md   
                            {{ request()->routeIs('admin-manajemen-peminjaman') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                            hover:bg-blue-200">
                                <i class="fa-solid fa-address-book"></i>
                                <span class="ms-2">Manajemen Peminjaman</span>
                            </a>
                        </a>
                    </div>
                    {{-- <div class="my-0 text-center">

                        <a href="{{ route('admin-manajemen-point') }}" class="mb-3">

                            <a href="{{ route('admin-manajemen-point') }}"
                                class="flex items-center ps-5 px-4 py-2 rounded-md   
                            {{ request()->routeIs('admin-manajemen-point') ? 'bg-blue-100 text-blue-500 text-lg  ' : 'bg-transparent text-gray-700 border-r-0' }}
                            hover:bg-blue-200">
                                <i class="fa-solid fa-medal"></i>
                                <span class="ms-2">Manajemen Point</span>
                            </a>
                        </a>
                    </div> --}}
                    <div class="my-0 flex  ">
                        <a href="{{ route('admin-manajemen-pengunjung') }}"
                            class="mb-3 flex items-center ps-5 px-4  py-2 rounded-md w-full 
                            {{ request()->routeIs('admin-manajemen-pengunjung') ? 'bg-blue-100 text-blue-500 text-lg' : 'bg-transparent text-gray-700 border-r-0' }}
                            hover:bg-blue-200">
                            <i class="fa-solid fa-user-secret   "></i>
                            <span class="ms-2">Manajemen Pengunjung</span>
                        </a>
                    </div>


                </nav>
            </div>
        </div>
    </div>
</div>
