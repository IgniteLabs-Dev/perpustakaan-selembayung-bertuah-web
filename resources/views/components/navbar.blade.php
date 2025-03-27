@php
    use Tymon\JWTAuth\Facades\JWTAuth;

    try {
        $user = JWTAuth::parseToken()->authenticate();
        $name = $user->name;
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
                        <a href="/"
                            class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 500"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('jelajahi-buku') }}"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Jelajahi
                            Buku</a>
                    </li>
                    <li>
                        <a href="{{ route('bookmark') }}"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Bookmark</a>
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
                        class="flex items-center cursor-pointer justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto ">{{ $name }}
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <div id="dropdownNavbar"
                        class="z-10 hidden  font-normal bg-white divide-y  divide-gray-100 rounded-lg shadow-sm  ">
                        <ul class="py-2 px-3 rounded-lg text-sm text-gray-700 " aria-labelledby="dropdownLargeButton">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button href="{{ route('logout') }}"
                                        class="block cursor-pointer px-4 rounded-lg py-2 hover:bg-gray-100 hover:text-red-700">
                                        Log out
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
