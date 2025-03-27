@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
    <div class="relative">
        <div class="div">
            @livewire('home-recommended')
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
        
        @livewire('home-hot')
    </div>
    <div class="max-w-screen-xl mx-auto mt-8 ">
        @livewire('home-new')
    </div>
    <div class="mb-20 pb-20">

    </div>

@endsection
