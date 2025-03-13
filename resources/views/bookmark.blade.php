@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
    <div class="max-w-screen-xl mx-auto pt-25 flex">
        <div class="w-4/5 pe-2 flex">
            <div class="border-gray-300 border rounded-lg shadow-sm py-3 ps-3 font-semibold w-full flex flex-wrap">
                @for ($i = 0; $i < 3; $i++)
                    <div class="w-1/3 mb-3 pe-3">
                        <div class="border-gray-300 p-3 border rounded-lg">
                            <div class="flex">

                                <img class="w-35 hover:scale-102 transition-transform duration-300 ease-in-out object-cover rounded-lg  "
                                    src="{{ asset('images/books/animal_farm_new.jpg') }}" alt="">
                                <div class="ms-2 flex  flex-col">
                                    <div class="flex-grow">

                                        <p class="text-xs mb-0 mt-2 text-gray-700 ">George Orwell</p>
                                        <h1 class="text-md font-bold mb-1 mt-0 text-black leading-tight">Seni bersikap Bodo
                                            Amat
                                    </div>


                                    <button
                                        class=" cursor-pointer hover:scale-105 transition-transform duration-300 ease-in-out rounded-full outline-1  text-red-700 hover:bg-red-800  hover:text-white hover:shadow-sm focus:ring-0 focus:outline-1 focus:ring-gray-300 font-medium text-xs px-2 py-1 active:outline-0 active:outline-none">Hapus
                                        dari
                                        Bookmark</button>


                                </div>
                            </div>

                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <div class="w-1/5 ">
            <div class="border-gray-300 border rounded-lg shadow-sm py-3 px-3 font-semibold w-full">
                <p class="text-lg font-bold text-[#1274E3] !important">Proses Peminjaman</p>
                <hr class="text-gray-400 mt-1 mb-1">
                <p class="text-xs font-normal">Anda dapat meminjam buku dengan mengunjungi perpustakaan secara langsung
                    dan
                    memilih
                    koleksi yang tersedia.</p>
            </div>
        </div>
    </div>





@endsection
