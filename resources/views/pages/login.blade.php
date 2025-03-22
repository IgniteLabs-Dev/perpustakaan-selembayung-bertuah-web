<html>

<head>
    <title>Perdin - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icon_ars.ico') }}">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    {{-- <script src="{{ asset('js/tailwind.js') }}"></script> --}}
    @vite(['resource/css/app.css', 'resource/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md mt-10 p-6">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4">
                        @if (session('error'))
                            <div class="bg-red-500 text-white p-3 rounded-lg text-center">
                                {{ session('error') }}
                            </div>
                        @endif
                        <h2 class="text-center text-2xl font-bold">Login</h2>
                  
                        <input required
                            class="border-1 border-gray-200 bg-gray-50 shadow-sm rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="email" type="email" placeholder="E-Mail">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <input required
                            class="border-1 border-gray-200 bg-gray-50 shadow-sm rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="password" type="password" placeholder="Password">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit"
                            class="bg-blue-500 cursor-pointer text-white py-2 px-4 rounded-lg hover:bg-blue-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
