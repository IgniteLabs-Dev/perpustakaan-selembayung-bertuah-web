@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="relative">
        <div class="div">
            @livewire('home-recommended')
        </div>
        <div class="absolute inset-x-0 top-full -translate-y-1/2">
            <div class="max-w-screen-xl mx-auto">
                <div class="w-full  rounded-xl bg-white shadow-sm p-5">

                    @livewire('search-bar-comp')
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto mt-5 pt-20">

        @livewire('home-hot')
    </div>



@endsection
