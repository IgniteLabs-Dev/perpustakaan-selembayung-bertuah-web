<html>

<head>
    <x-style />
    <title>Perpustakan Selembayung Bertuah - Register</title>
</head>

<body
    style="background-image: url('{{ asset('images/bg-register.jpg') }}'); background-size: cover; background-position: center;">
    <div class="flex justify-end h-full  items-center min-h-screen">
        <div class="  max-w-2xl me-7 h-full w-full  p-6">
            <div class="bg-white h-full flex flex-col items-center rounded-2xl w-full shadow-md p-6">

                <div class="flex w-full justify-center">
                    <img class="h-12" src="{{ asset('images/Perpustakaan Icon.png') }}" alt="">
                </div>
                <div class="flex items-center h-full w-full">

                    <form action="{{ route('register.proses') }}" class="w-full" method="POST">
                        @csrf
                        <div class="flex flex-col gap-4 ">
                            <div class="w-full">
                                @if (session('error'))
                                    <div class="p-4 text-sm text-center text-red-800 rounded-lg bg-red-50 "
                                        role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <h2 class="text-center text-light text-4xl font-bold mb-3">Daftar Akun</h2>
                                <div class="w-full mb-2">
                                    <label class="text-sm text-gray-500">Nama<span
                                            class="text-red-500 text-lg">*</span></label>
                                    <input value="{{ old('name') }}" required
                                        class="border-1 border-gray-200 bg-gray-50  rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="name" type="text" placeholder="Masukkan Nama Lengkap">
                                    @error('name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full mb-2">
                                    <label class="text-sm text-gray-500">NIS/NIP<span
                                            class="text-red-500 text-lg">*</span></label>
                                    <input value="{{ old('nis') }}" required
                                        class="border-1 border-gray-200 bg-gray-50  rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="nis" type="text" placeholder="Masukkan NIS/NIP">
                                    @error('nis')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full mb-2">
                                    <label class="text-sm text-gray-500">Email<span
                                            class="text-red-500 text-lg">*</span></label>
                                    <input value="{{ old('email') }}" required
                                        class="border-1 border-gray-200 bg-gray-50  rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="email" type="email" placeholder="Masukkan  E-Mail">
                                    @error('email')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full mb-2">
                                    <label class="text-sm text-gray-500">Kata Sandi<span
                                            class="text-red-500 text-lg">*</span></label>
                                    <input required
                                        class="border-1 border-gray-200 bg-gray-50  rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="password" type="password" placeholder="Masukkan Kata Sandi">
                                    @error('password')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center mt-2">
                            <button type="submit"
                                class="bg-[var(--primary)] hover:scale-105 w-50 cursor-pointer text-white py-3 px-4 rounded-lg hover:brightness-90 transition-transform duration-300 ease-in-out  ">Daftar
                                Akun</button>
                        </div>
                    </form>
                </div>
                <div class="flex flex-col gap-2 mt-4">
                    <p class="text-sm text-gray-500">Sudah punya akun? <a href="{{ route('login') }}"
                            class="text-[var(--primary)] font-semibold">Masuk</a></p>


                </div>
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
