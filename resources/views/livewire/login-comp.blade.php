<html>

<head>
    <title>Perdin - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icon_ars.ico') }}">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    {{-- <script src="{{ asset('js/tailwind.js') }}"></script> --}}
    {{-- @vite(['resource/css/app.css', 'resource/js/app.js']) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>

<body>
    <div class="flex h-screen justify-center items-center bg-gray-50">

        <div
            class="border w-[80%] sm:w-[60%] md:w-[35%] lg:w-[25%]  px-4 py-10 rounded-xl shadow-sm border-gray-300 border-1 bg-white ">
            <div class=" p-5 pb-0 flex justify-center text-3xl font-bold">
                LOGIN
            </div>
            <div class="flex justify-center p-5 pb-0">

                @if (session('error'))
                    <div class="bg-red-100 p-3 py-2 text-red-600 rounded-lg text-sm" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class=" flex-col p-5 flex justify-center pt-0">
                <label for="Email" class="text-sm text-gray-500 ">Email</label>
                <div class="mb-3 w-full">
                    <input @keyup.enter="$wire.login()" wire:model.defer="email" type="text"
                        class=" bg-gray-100 w-full p-2 mt-2 rounded-lg focus:outline-gray-300" placeholder="email">
                    @error('email')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">

                    <label for="passwordInput" class="text-sm text-gray-500 ">Password</label>
                    <div class="relative items-center flex ">
                        <input @keyup.enter="$wire.login()" wire:model.defer="password" type="password"
                            id="passwordInput" class=" bg-gray-100 p-2 rounded-lg focus:outline-gray-300 w-full pr-10"
                            placeholder="Password">
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <button wire:loading.attr="disabled" type="button" wire:click="login"
                    class="bg-blue-500 text-white p-2 py-3 cursor-pointer rounded-lg disabled:bg-gray-300">Login</button>
            </div>
        </div>
    </div>
    @livewireScripts
    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            let input = document.getElementById("passwordInput");
            let icon = this.querySelector("i");
            let isHidden = input.type === "password";

            input.type = isHidden ? "text" : "password";
            icon.classList.toggle("fa-eye", !isHidden);
            icon.classList.toggle("fa-eye-slash", isHidden);
        });
    </script>

</body>

</html>
