<html>


<head>
    <x-style />
</head>

<body
    style="background-image: url('{{ asset('images/bg-login.jpg') }}'); background-size: cover; background-position: center;">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md mt-10 p-6">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4">
                        <div class="flex justify-center">

                            <img class="h-20" src="{{ asset('images/Perpustakaan Icon.png') }}" alt="">
                        </div>
                        @if (session('error'))
                            <div class="p-4 text-sm text-center text-red-800 rounded-lg bg-red-50 " role="alert">
                                {{ session('error') }}
                            </div>
                        @elseif(session('success'))
                            <div class="p-4 text-sm text-center text-green-800 rounded-lg bg-green-50 " role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h2 class="text-center text-2xl font-bold">Selamat Datang!</h2>
                        <div class="div">
                            <label class="text-sm text-gray-500">Email<span
                                    class="text-red-500 text-lg">*</span></label>
                            <input value="{{ old('email') }}" required
                                class="border-1 border-gray-200 bg-gray-50  rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="email" type="email" placeholder="E-Mail">
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="div">
                            <label class="text-sm text-gray-500">Password<span
                                    class="text-red-500 text-lg">*</span></label>
                            <input required
                                class="border-1 border-gray-200 bg-gray-50  rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                name="password" type="password" placeholder="Password">
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit"
                            class="bg-[var(--primary)]  cursor-pointer text-white py-2 px-8 hover:scale-105 rounded-lg hover:brightness-90 transition-transform duration-300 ease-in-out">Login</button>
                    </div>
                    <div class="flex flex-col gap-2 mt-2 justify-center">
                        <p class="text-sm text-center text-gray-500">Belum punya akun? <a href="{{ route('register') }}"
                                class="text-[var(--primary)] font-semibold">Daftar</a></p>


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
