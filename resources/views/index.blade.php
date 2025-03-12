@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
    <div class="relative">
        <div class="w-full bg-stripes">
            <div class="max-w-screen-xl mx-auto">
                <h1 class="text-2xl font-bold text-center text-black pt-20 ">Rekomendasi Buku</h1>
                <div class="flex justify-center items-end space-x-4 pt-5 pb-25">
                    <img class="h-40 rounded-md" src="{{ asset('images/books/animal_farm_new.jpg') }}" alt="">
                    <img class="h-45 rounded-md" src="{{ asset('images/books/animal_farm_new.jpg') }}" alt="">
                    <img class="h-50 rounded-md" src="{{ asset('images/books/animal_farm_new.jpg') }}" alt="">
                    <img class="h-45 rounded-md" src="{{ asset('images/books/animal_farm_new.jpg') }}" alt="">
                    <img class="h-40 rounded-md" src="{{ asset('images/books/animal_farm_new.jpg') }}" alt="">
                </div>
            </div>
        </div>
        <div class="absolute inset-x-0 top-full -translate-y-1/2">
            <div class="max-w-screen-xl mx-auto">
                <div class="w-full  rounded-xl bg-white shadow-sm p-5">

                    <div class="mx-auto">
                        <div
                            class=" flex items-center text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 ">
                            <div class=" inset-y-0 start-0 flex items-center ps-3 pointer-events-none  ">
                                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="default-search"
                                class="block w-full p-4 focus:outline-0 focus:outline-transparent text-sm  "
                                placeholder="Search Mockups, Logos..." required />
                            <button type="button"
                                class="text-white me-2 cursor-pointer end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium  text-sm px-4 py-2 rounded-full">Search</button>
                        </div>

                    </div>
                    <div class="flex mt-3">
                        @for ($i = 0; $i < 14; $i++)
                            <a href="#" target="_blank">
                                <button type="button"
                                    class="text-black cursor-pointer rounded-full me-2 outline-1 outline-gray-300 bg-white hover:bg-gray-100 hover:text-black hover:shadow-md focus:ring-0 focus:outline-1 focus:ring-gray-300 font-medium text-sm px-4 py-2 active:outline-0 active:outline-none">Search</button>
                            </a>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto mt-5 pt-20">
        <div class="flex justify-between items-end">
            <h1 class="text-2xl font-bold  text-black  ">Buku Terbaru</h1>
            <a href="#">
                <small class="text-black ">Lihat lainnya</small>
            </a>
        </div>
        <div class="flex justify-between items-start pt-2">
            @for ($i = 0; $i < 6; $i++)
                <div class="w-1/6  mb-3 pe-3 [&:nth-child(6n)]:pe-0">

                    <x-card-book />
                </div>
            @endfor

        </div>
    </div>
    <div class="max-w-screen-xl mx-auto mt-8 ">
        <div class="flex justify-between items-end">
            <h1 class="text-2xl font-bold  text-black  ">Buku Terlaris</h1>
            <a href="#">
                <small class="text-black ">Lihat lainnya</small>
            </a>
        </div>
        <div class="flex justify-between items-start pt-2 ">
            @for ($i = 0; $i < 6; $i++)
                <div class="w-1/6  mb-3 pe-3 [&:nth-child(6n)]:pe-0">

                    <x-card-book />
                </div>
            @endfor

        </div>
    </div>
    <div class="mb-20 pb-20">

    </div>

@endsection
