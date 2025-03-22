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
            <div class="mb-3 mt-3">

                <small class="ps-5 text-gray-500">ADMIN</small>
                <a href="{{ route('admin-manajemen-user') }}" class="mb-3">

                    <a href="{{ route('admin-manajemen-user') }}"
                        class="flex items-center ps-5 px-4 py-2  border-blue-500 
                    {{ request()->routeIs('admin-manajemen-user') ? 'bg-blue-100 text-blue-500 border-r-3' : 'bg-transparent text-gray-700 border-r-0' }}
                    hover:bg-blue-200">

                        <i class='bx bx-layer'></i>
                        <span class="ms-2">Manajemen User</span>
                    </a>
                </a>
            </div>

        </nav>
    </div>
</div>
