@php
    use Tymon\JWTAuth\Facades\JWTAuth;

    try {
        $user = JWTAuth::parseToken()->authenticate();
        $name = $user->name;
        $profile = $user->cover;
    } catch (\Exception $e) {
        $name = null;
    }
@endphp
<nav class="bg-white  fixed w-full z-20 top-0 start-0 border-b border-gray-200  ">
    <div class="max-w-screen-xl flex flex-wrap  justify-between mx-auto pt-3 pb-3">
        <div class="w-1/3 flex items-start">
            <div class="flex items-start  flex-col">
                <p class="font-medium text-[11px]  mb-0">PERPUSTAKAAN</p>
                <p class="self-center text-xl p-0 m-0 font-bold  whitespace-nowrap ">
                    SELEMBAYUNG BERTUAH</p>
            </div>
        </div>
        <div class="w-1/3 justify-center flex">
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white ">
                    <li>
                        <a href="{{ route('index') }}"
                            class="block py-2 px-3  md:p-0 
                                {{ request()->routeIs('index') ? 'font-bold   text-white md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }}"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('jelajahi-buku') }}"
                            class="block py-2 px-3  md:p-0 
                                {{ request()->routeIs('jelajahi-buku') ? 'font-bold   text-white md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }}">
                            Jelajahi Buku
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bookmark') }}"
                            class="block py-2 px-3  md:p-0 
                                {{ request()->routeIs('bookmark') ? 'font-bold   text-white md:text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700' }}">
                            Bookmark
                        </a>
                    </li>


                </ul>
            </div>
        </div>
        <div class="w-1/3 flex justify-end text-end">
            <div class="flex md:order-2 space-x-3 text-end ">
                @if ($name == null)
                    <a href="{{ route('login') }}">
                        <button type="button"
                            class="text-white cursor-pointer bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center ">Login</button>
                    </a>
                @else
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                        class="flex items-center cursor-pointer justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[var(--primary)] hover:font-semibold font-medium md:p-0 md:w-auto ">


                        <div class="flex flex-col justify-end text-end me-2 ">
                            <span class="text-sm font-bold">{{ $name }}</span>
                            <span class="text-xs"><i class="fa-solid fa-star text-orange-400"></i> 29</span>

                        </div>
                        <img class="rounded-lg h-9 w-9 aspect-square" src="{{ asset('images/profile/' . $profile) }}"
                            alt="">
                    </button>

                    <div id="dropdownNavbar"
                        class="z-10 hidden  font-normal bg-white divide-y  divide-gray-100 rounded-lg shadow-sm  ">
                        <ul class="py-2 px-3 rounded-lg text-sm text-gray-700 " aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="{{ route('admin-manajemen-peminjaman') }}">

                                    <button href="{{ route('admin-manajemen-peminjaman') }}"
                                        class="block cursor-pointer px-3 w-full text-start rounded-lg py-2 hover:bg-[var(--primary)] hover:text-white">
                                        <i class="fa-solid fa-user me-2"></i>Admin
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile') }}">

                                    <button href="{{ route('profile') }}"
                                        class="block cursor-pointer px-3 w-full text-start rounded-lg py-2 hover:bg-[var(--primary)] hover:text-white">
                                        <i class="fa-solid fa-user me-2"></i>Profile
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('riwayat-peminjaman') }}">
                                    <button href="{{ route('riwayat-peminjaman') }}"
                                        class="block cursor-pointer px-3 w-full text-start rounded-lg py-2 hover:bg-[var(--primary)] hover:text-white">
                                        <i class="fa-solid fa-clock-rotate-left me-2"></i>Riwayat Peminjaman
                                    </button>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button href="{{ route('logout') }}"
                                        class="block cursor-pointer w-full text-start px-3 rounded-lg py-2 hover:bg-red-500 hover:text-white">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i> Log out
                                    </button>
                                </form>
                            </li>

                        </ul>

                    </div>
                @endif
            </div>
        </div>


    </div>
</nav>
