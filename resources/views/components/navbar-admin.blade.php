@php
    use Tymon\JWTAuth\Facades\JWTAuth;

    try {
        $user = JWTAuth::parseToken()->authenticate();
    } catch (\Exception $e) {
        $name = null;
    }
@endphp


<div class="flex fixed w-full z-10 left-0 items-center justify-between py-2  bg-white border-b border-gray-200 top-0  ">
    <div class="flex items-center px-4">
        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
            class="text-xl p-2 bg-gray-200 rounded-lg xl:hidden active:bg-gray-300 active:scale-110">
            <i class='bx bx-menu text-xl'></i>
        </button>

    </div>
    <div class="flex items-center pr-6 ">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button href="{{ route('logout') }}"
                class="block cursor-pointer px-2 text-sm rounded-lg py-1.5 bg-red-600 text-white hover:scale-110 transition-all duration-200 ease-in-out">
                Log out
            </button>
        </form>
    </div>
</div>


<x-modal-admin />
