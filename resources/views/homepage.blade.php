@extends('home_base')
@section('title', 'homepage')
@section('content')


<div class="p-10">

    <div class="grid grid-cols-1 lg:grid-cols-2 mt-12 gap-8 items-center">
        <!-- Left Section -->
        <div class="flex flex-nowrap flex-col lg:text-left px-20">
            <h2 class="text-4xl lg:text-6xl font-bold text-green-800 drop-shadow-xl">SOUTH GATE INN</h2>
            <h2 class="text-sm lg:text-md mt-2 font-semibold text-green-900 drop-shadow-lg">
                "Effortless Booking, Seamless Stays: Manage Reservations, Check-ins, and Checkouts with Ease. Explore Calendar Views and Simplify Your Experience"
            </h2>
            <a href="{{ route('CheckInPage') }}" 
               class="bg-lime-600 hover:bg-lime-700 text-white px-6 py-2 rounded-md self-center lg:self-start mt-4 drop-shadow-lg">
                Check In
            </a>
        </div>
        <!-- Right Section -->
        <div class="flex justify-center">
            <img src="{{ asset('images/southgate2.svg') }}" class="rounded-xl drop-shadow-xl max-w-full h-auto">
        </div>

    </div>

</div>









@endsection


