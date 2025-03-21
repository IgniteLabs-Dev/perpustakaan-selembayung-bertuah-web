<div class="flex items-center justify-between py-4 bg-white border-b border-gray-200 top-0 ">
    <div class="flex items-center px-4">
        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
            class="text-xl p-2 bg-gray-200 rounded-lg md:hidden active:bg-gray-300 active:scale-110">
            <i class='bx bx-menu text-xl'></i>
        </button>

    </div>
    <div class="flex items-center pr-6">

        <button class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
            <i class="fa-regular fa-bell me-3"></i>
        </button>
        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
            class="flex items-center cursor-pointer justify-between w-full py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto ">{{ session('username', 'User') }}
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>

        <div id="dropdownNavbar"
            class="z-10 hidden  font-normal bg-white divide-y  divide-gray-100 rounded-lg shadow-sm  ">
            <ul class="py-2 px-3 rounded-lg text-sm text-gray-700 " aria-labelledby="dropdownLargeButton">
                <li>
                    <a href="{{ route('logout') }}"
                        class="block px-4 rounded-lg py-2 hover:bg-gray-100 hover:text-red-700">
                        Log out
                    </a>
                </li>

            </ul>

        </div>
    </div>
</div>


<x-modal-admin />
