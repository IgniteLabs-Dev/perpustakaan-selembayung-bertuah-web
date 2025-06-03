<div>

    <nav class="bg-white  fixed w-full z-20 top-0 start-0 border-b border-gray-200 shadow-sm ">
        <div class="max-w-screen-xl flex flex-wrap py-2.5 justify-between mx-auto ">
            <div class="w-1/2 md:w-1/3 flex items-center">
                <div class="md:flex items-start  flex-col hidden">
                    <a href="/">

                        <img class="h-12 w-auto" src="{{ asset('images/Perpustakaan Icon.png') }}" alt="">
                    </a>
                </div>
                <div class="bg-gray-200 p-3 ms-3 md:hidden block rounded-lg cursor-pointer hover:bg-gray-300 ">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
            <div class="hidden md:w-1/3 justify-center md:flex">
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                    <ul
                        class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white ">
                        <li>
                            <a href="{{ route('index') }}"
                                class="block py-2 px-3  md:p-0 
                                {{ request()->routeIs('index') ? 'font-extrabold  border-b-3 text-white md:text-[var(--primary)]' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[var(--primary)]' }}"
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('jelajahi-buku') }}"
                                class="block py-2 px-3  md:p-0 
                                {{ request()->routeIs('jelajahi-buku') ? 'font-extrabold border-b-3  text-white md:text-[var(--primary)]' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[var(--primary)]' }}">
                                Jelajahi Buku
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('favorit') }}"
                                class="block py-2 px-3  md:p-0 
                                {{ request()->routeIs('favorit') ? 'font-extrabold border-b-3  text-white md:text-[var(--primary)]' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[var(--primary)]' }}">
                                Favorit
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
            <div class="w-1/2 md:w-1/3 flex justify-end text-end">
                <div class="flex md:order-2 pe-3 text-end  items-center">
                    @if ($user == null)
                        <a href="{{ route('login') }}">
                            <button type="button"
                                class="text-white cursor-pointer bg-[var(--primary)] hover:brightnes-90 focus:ring-4 focus:outline-none focus:ring-var-[(--primary)] font-medium rounded-lg text-sm px-4 py-2 text-center ">Login</button>
                        </a>
                    @else
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="flex items-center cursor-pointer justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[var(--primary)] hover:font-semibold font-medium md:p-0 md:w-auto pe-0">


                            <div class="flex flex-col justify-end text-end me-2 ">
                                <span class="text-sm font-bold">{{ $user->name }}</span>
                                {{-- <span class="text-xs">
                                    <i
                                        class="fa-solid fa-star text-orange-400 me-0.5"></i>{{ $point }}
                                    </span> --}}

                            </div>
                            @if ($user->cover == null)
                                <img class="rounded-lg h-9 w-9 aspect-square object-cover"
                                    src="{{ asset('images/profile/profile-blank.png') }}" alt="">
                            @else
                                <img class="rounded-lg h-9 w-9 aspect-square object-cover"
                                    src="{{ asset('images/profile/' . $user->cover) }}" alt="">
                            @endif
                        </button>

                        <div id="dropdownNavbar"
                            class="z-10 hidden  font-normal bg-white divide-y  divide-gray-100 rounded-lg shadow-sm  ">
                            <ul class="py-2 px-3 rounded-lg text-sm text-gray-700 "
                                aria-labelledby="dropdownLargeButton">
                                @if ($user->role == 'admin' || $user->role == 'superadmin')
                                    <li>
                                        <a href="{{ route('dashboard') }}">

                                            <button href="{{ route('dashboard') }}"
                                                class="block cursor-pointer px-3 w-full text-start rounded-lg py-2 hover:bg-[var(--primary)] hover:text-white">
                                                <i class="fa-solid fa-chart-simple me-2"></i>Dashboard Admin
                                            </button>
                                        </a>
                                    </li>
                                @endif
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

</div>
