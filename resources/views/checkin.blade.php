@extends('base')
@section('title', 'Room Page')
@section('content')


@push('styles')
<link rel="stylesheet" href="{{asset('css/pagination.css')}}">
@endpush





<div class="p-10 overflow-y-auto">

    <div class="flex justify-between">

        <button type="button"
            class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none mb-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            onclick="showModal('checkIn-modal')">
            CHECK IN
        </button>

        <div class="relative">
            <button id="dropdownNavbarLink2" class="flex items-center justify-between w-full py-2.5 px-4 bg-green-800 hover:bg-green-900 rounded-lg text-white font-medium text-sm">
                RECORDS
                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="dropdownNavbar2" class="mt-2 absolute right-5 z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400 text-left" aria-labelledby="dropdownNavbarLink">
                    <li>
                        <button type="button"
                                class="text-center hover:bg-gray-100 px-4 py-2 block w-full"
                                onclick="openSidebar('reservation-sideBar'); closeDropdown();">
                            RESERVATION
                        </button>
                    </li>
                    <li>
                        <button type="button"
                                class="text-center hover:bg-gray-100 px-4 py-2 block w-full"
                                onclick="openSidebar('CheckoutList-sideBar'); closeDropdown();">
                            CHECK OUT
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>
    
    
    <div class="relative overflow-x-auto shadow-xl bg-white sm:rounded-lg px-8 pt-8">
        <div class="relative flex items-center mb-8">
            <input name="searchButton" class="mySearch bg-gray-100 border border-gray-400 shadow-xl rounded-md py-1 px-5 pl-10 focus:border-green-900 focus:outline-none" type="text" placeholder="Search...">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute top-2 left-3 w-4 h-4 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>
        
          
        <table class="w-full text-md text-left rtl:text-right text-gray-600 dark:text-gray-400 shadow-md default_datatable_roomList">
            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                 
                    <th scope="col" class="px-6 py-3">
                        FOLIO NUMBER
                    </th>

                    <th scope="col" class="px-6 py-3">
                        FIRST NAME
                    </th>

                    <th scope="col" class="px-6 py-3">
                        LAST NAME   
                    </th>


                    <th scope="col" class="px-6 py-3">
                        ROOM NUMBER   
                    </th>
                    
                    
                    <th scope="col" class="px-6 py-3">
                        DATE IN   
                    </th>
                  

                    <th scope="col" class="px-6 py-3">
                        BUSINESS SOURCE 
                    </th>
                  
                  
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
               
                
                
            </tbody>
       
        </table>
    
            <div class="mt-5">
                <div id="pagination" class="text-center"></div>
            </div>
    </div>
    
    </div>










{{-- SIDEBAR ------------------------------------------- --}}
<x-sidebarRight id="reservation-sideBar" title="Reservation List">

    <div>

        <table id="reservationList" class="w-full text-sm text-center rtl:text-right text-gray-600 dark:text-gray-50 shadow-md">
            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-50">
                <tr>
                    <th scope="col" class="px-2 py-3">
                     FOLIO NUMBER
                    </th>
                    <th scope="col" class="px-2 py-3">
                        <span class="invisible">******</span>FIRSTNAME
                    </th>
                    <th scope="col" class="px-2 py-3">
                        <span class="invisible">******</span>LASTNAME
                    </th>
                    <th scope="col" class="px-2 py-3">
                        <span class="invisible">*</span>DATE IN
                    </th>
                    <th scope="col" class="px-2 py-3">
                        <span class="invisible">*</span>ROOM
                    </th>
                    <th scope="col" class="px-2 py-3">
                        <span class="invisible">***</span> ACTION
                    </th>
                </tr>
            </thead>
  
        

        <tbody>
           
            
            
        </tbody>
   
    </table>

    </div>
    
</x-sidebarRight>





{{-- START OF SIDEBAR CHECKOUT LIST --}}

<x-sidebarRight id="CheckoutList-sideBar" title="Checkout List">

    <div>

        <table id="checkoutList_datatable" class="w-full text-xs text-left rtl:text-right text-gray-600 dark:text-gray-50 shadow-md">
            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-50">
                <tr>
                    <th scope="col" class="py-1">
                     FOLIO NUMBER
                    </th>
                    <th scope="col" class="py-1">
                      FIRSTNAME
                    </th>
                    <th scope="col" class="py-1">
                       LASTNAME
                    </th>
                    <th scope="col" class="py-1">
                       DATE IN
                    </th>
                    <th scope="col" class="py-1">
                       DATE OUT
                    </th>
                    <th scope="col" class="py-1">
                       ROOM
                    </th>
                 
                    <th scope="col" class="py-1">
                        ACTION
                     </th>
                </tr>
            </thead>
  
        

        <tbody class="text-left text-gray-700 dark:text-white">
           
            
            
        </tbody>
   
    </table>

    </div>
    
</x-sidebarRight>

{{-- END OF CHECKOUT LIST --}}


{{-- END OF SIDEBAR   -------------------------------------}}





{{-- MODAL CHECKIN FROM RESERVE --}}

<x-modalLarge 

    id="checkInFromReserve-modal" 
    title="CHECK IN RESERVE"
    primaryButtonText="Check In" 
    primaryButtonAction="document.getElementById('checkInFromReserve-form').submit()"
    secondaryButtonAction="document.getElementById('checkInFromReserve-modal').classList.add('hidden'); document.getElementById('checkInFromReserve-modal').classList.remove('flex');"
    secondaryButtonText="Cancel"
    secondaryButtonClass="bg-slate-500 hover:bg-slate-700 px-4 py-2 rounded text-white"
    primaryButtonClass="text-white bg-green-700 hover:bg-green-600 hover:shadow-xl focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">


    <form id="checkInFromReserve-form" action="{{ route('storeCheckInFromReservation')}}" method="POST">
        @csrf
        <h2>Are you sure you want to Check In?</h2>
        <div class="mt-4">
            <input type="hidden" name="checkinFromReserve_folio_number_input" id="checkinFromReserve_folio_number_input">
            <input type="hidden" name="checkinFromReserve_room_number_input" id="checkinFromReserve_room_number_input">


            <h4 class="font-bold">Folio Number: <span class="checkinFromReserve_folio_number font-light mx-1"></span></h4>
            <h4 class="font-bold">Name: <span class="checkinFromReserve_name font-light mx-1"></span></h4>
            {{-- <h4 class="font-bold">Room ID: <span class="checkinFromReserve_room_number font-light mx-1"></span></h4> --}}
        </div>
    </form>

</x-modalLarge>


{{-- END MODAL CHECKIN FROM RESERVE --}}






{{-- START OF CHECKOUT MODAL --}}

<x-modalLarge 
    id="checkOut-modal" 
    title="CHECK OUT"
    primaryButtonText="Check Out" 
    primaryButtonAction="document.getElementById('checkOut-form').submit()"
    secondaryButtonAction="document.getElementById('checkOut-modal').classList.add('hidden'); document.getElementById('checkOut-modal').classList.remove('flex');"
    secondaryButtonText="Cancel"
    secondaryButtonClass="bg-slate-500 hover:bg-slate-700 px-4 py-2 rounded text-white"
    primaryButtonClass="text-white bg-blue-700 hover:bg-blue-500 hover:shadow-xl focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">

    <form id="checkOut-form" action="{{route('storeCheckout')}}" method="POST">
        @csrf
        <div class="grid grid-cols-4 gap-x-3 p-2">
     
            <div class="relative z-0">
                <input type="text" id="checkout_view_folio_number" readonly name="checkout_view_folio_number" class="checkout_view_folio_number block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_folio_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">FOLIO NUMBER</label>
            </div>

            <div class="relative z-0">
                <input type="text" id="checkout_view_firstname" readonly name="checkout_view_firstname" class="checkout_view_firstname block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_firstname" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">FIRST NAME</label>
            </div>

            <div class="relative z-0">
                <input type="text" id="checkout_view_lastname" readonly name="checkout_view_lastname" class="checkout_view_lastname block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_lastname" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">LAST NAME</label>
            </div>

            <div class="relative z-0">
                <input type="text" id="checkout_view_no_of_days" readonly name="checkout_view_no_of_days" class="checkout_view_no_of_days block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_no_of_days" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NO OF DAYS</label>
            </div>

            
            <div class="relative z-0 mt-6">
                <input type="text" id="checkout_view_rate_period" readonly name="checkout_view_rate_period" class="checkout_view_rate_period block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_rate_period" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">RATE PERIOD</label>
            </div>

            <div class="relative z-0 mt-6">
                <input type="text" id="checkout_view_total_charges" readonly name="checkout_view_total_charges" class="checkout_view_total_charges block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_total_charges" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">TOTAL CHARGES</label>
            </div>

            <div class="relative z-0 mt-6">
                <input type="text" id="checkout_view_other_charges" readonly name="checkout_view_other_charges" class="checkout_view_other_charges block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_other_charges" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">OTHER CHARGES</label>
            </div>

            <div class="relative z-0 mt-6">
                <input type="text" id="checkout_view_sub_total" readonly name="checkout_view_sub_total" class="checkout_view_sub_total block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_sub_total" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">SUB TOTAL</label>
            </div>

            <div class="relative z-0 mt-6">
                <input type="text" id="checkout_view_discount" readonly name="checkout_view_discount" class="checkout_view_discount block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_discount" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">DISCOUNT</label>
            </div>

            <div class="relative z-0 mt-6">
                <input type="text" id="checkout_view_total" readonly name="checkout_view_total" class="checkout_view_total block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_total" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">TOTAL</label>
            </div>

            <div class="relative z-0 mt-6">
                <input type="text" id="checkout_view_amount_paid" readonly name="checkout_view_amount_paid" class="checkout_view_amount_paid block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_amount_paid" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">AMOUNT PAID</label>
            </div>

            <div class="relative z-0 mt-6">
                <input type="text" id="checkout_view_balance" readonly name="checkout_view_balance" class="checkout_view_balance block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_balance" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">BALANCE</label>
            </div>

            <div class="relative z-0 mt-6 hidden">
                <input type="text" id="checkout_view_room" readonly name="checkout_view_room" class="checkout_view_room block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="checkout_view_room" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM ID</label>
            </div>



        </div>

    </form>

</x-modalLarge>
{{-- END OF CHECKOUT MODAL --}}







    {{-- ADD CHECKIN --}}
    <x-modalXL id="checkIn-modal" title="CHECK IN"
    primaryButtonText="Check In" primaryButtonAction="document.getElementById('checkIn-form').submit()"
    secondaryButtonAction="document.getElementById('checkIn-modal').classList.add('hidden'); document.getElementById('checkIn-modal').classList.remove('flex');"
    secondaryButtonText="Cancel"
    secondaryButtonClass="bg-slate-500 hover:bg-slate-600 text-white py-1 px-4 rounded"
    primaryButtonClass="bg-blue-700 hover:bg-blue-800 text-white rounded py-1 px-4">

    <form id="checkIn-form" method="post" class="p-5" action="{{ route('storeTransaction')}}">
        @csrf

        <div class="grid grid-cols-2 gap-x-8 md:grid-cols-7">

            <div class="relative z-2 mt-6 w-full group">
                <input type="text" id="searchCustomer" name="searchCustomer" 
                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                       autocomplete="off" />
                
                <label for="searchCustomer" 
                       class="absolute text-md text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 peer-focus:scale-75 peer-focus:-translate-y-6">SEARCH</label>
                
                <div id="customerSearchResults" 
                     class="absolute bg-gray-100 border border-gray-300 shadow-lg w-full hidden z-50"></div>
            </div>
            
            <div class="relative z-0 mt-6 w-full group">
                <input type="text" id="transac_firstname" name="transac_firstname" class="transac_firstname block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="transac_firstname" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">FIRST NAME</label>
            </div>
            
            <div class="relative z-0 mt-6 w-full group">
                <input type="text" id="transac_lastname" name="transac_lastname" class="transac_lastname block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_lastname" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">LAST NAME</label>
            </div>

            <div class="relative z-0 mt-6 w-full group">
                <input type="text" id="transac_address" name="transac_address" class="transac_address block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_address" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ADDRESS</label>
            </div>

            <div class="relative z-0 mt-6 w-full group">
                <input type="date" id="transac_date_in" name="transac_date_in" class="transac_date_in block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="transac_date_in" class="peer-focus:font-medium absolute text-md text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">DATE IN</label>
            </div>

            <div class="relative z-0 mt-6 w-full group">
                <input type="date" id="transac_date_out" name="transac_date_out" class="transac_date_out block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_date_out" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">DATE OUT</label>
            </div>

            <div class="relative z-0 w-full group">
                <label for="transac_country" class="transac_country block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Country</label>
                <div class="relative">
                    <select name="transac_country" id="transac_country" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-60 overflow-y-auto"
                        required>
                        <option value="" disabled>Choose a country</option>
                        @foreach($country_list as $country)
                            <option value="{{ $country->country_id }}" {{ $country->country == 'Philippines' ? 'selected' : '' }}>{{ $country->country }}</option>
                        @endforeach
                    </select>
                    <!-- Custom Icon -->
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="relative z-0 w-full group mt-4">
                <label for="transac_company" class="transac_company block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Company</label>
                <div class="relative">
                    <select name="transac_company" id="transac_company" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-60 overflow-y-auto"
                        >
                        <option value="" disabled selected>Choose a company</option>
                        @foreach($company_list as $company)
                            <option value="{{ $company->company_id }}">{{ $company->company }}</option>
                        @endforeach
                        <option value="none">None</option> <!-- Added None option -->
                    </select>
                    <!-- Custom Icon -->
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>





            <!-- second row -->
      
    

            <div class="relative z-0 w-full group mt-4">
                <label for="transac_room_number" class="transac_room_number block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Room Number</label>
                <div class="relative">
                    <select name="transac_room_number" id="transac_room_number" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-60 overflow-y-auto">
                        <option value="" disabled selected>Choose a room number</option>
                        @foreach($room_num as $room_nums)
                            <option value="{{ $room_nums->id }}" 
                                    data-room-rate="{{ $room_nums->room_rate }}" 
                                    data-adult-rate="{{ $room_nums->adult_rate }}" 
                                    data-children-rate="{{ $room_nums->children_rate }}"
                                    data-no-of-person="{{ $room_nums->no_of_person}}"
                                    >
                                Room {{ $room_nums->room_number }} -  {{ str_replace('_', ' ', $room_nums->rate_type) }} {{ $room_nums->no_of_person}}
                            </option>
                        @endforeach
                    </select>
                    <!-- Custom Icon -->
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
            
            

            <div class="relative z-0 w-full group mt-4">
                <label for="transac_business_source" class="transac_business_source block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Business</label>
                <div class="relative">
                    <select name="transac_business_source" id="transac_business_source" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-60 overflow-y-auto"
                        >
                        <option value="" disabled selected>Choose a business</option>
                        @foreach($business_source_list as $business_source_lists)
                            <option value="{{ $business_source_lists->business_source_id }}">{{ $business_source_lists->business_source }}</option>
                        @endforeach
                      
                    </select>
                    <!-- Custom Icon -->
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>


            <div class="relative z-0 w-full group mt-4">
                <label for="transac_id_type" class="transac_id_type block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Select ID TYPE
                </label>
                <div class="relative">
                    <select name="transac_id_type" id="transac_id_type" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-60 overflow-y-auto">
                        <option value="" disabled selected>Choose a ID TYPE</option>
                        <option value="National_ID">NATIONAL ID</option>
                        <option value="Voter ID">VOTER ID</option>
                        <option value="TIN ID">TIN ID</option>
                        <option value="PhilHealth ID">PHILHEALTH ID</option>
                        <option value="Passport ID">PASSPORT ID</option>
                        <option value="School ID">SCHOOL ID</option>
                        <option value="Postal ID">POSTAL ID</option>
                        <option value="DRIVER LICENSE">DRIVER LICENSE</option>
                        <option value="PRC ID">PRC ID</option>
                        <option value="Others">Others</option>
                    </select>
                    <!-- Custom Icon -->
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

     

            




            <div class="relative z-0 mt-10 w-full group">
                <input type="number" id="transac_no_of_days" name="transac_no_of_days" class="transac_no_of_days block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_no_of_days" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NO OF DAYS</label>
            </div>

            <div class="relative z-0 mt-10 w-full group">
                <input type="number" id="transac_no_of_adults" name="transac_no_of_adults" class="transac_no_of_adults block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_no_of_adults" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NO OF ADULTS</label>
            </div>

            <div class="relative z-0 mt-10 w-full group">
                <input type="number" id="transac_no_of_children" name="transac_no_of_children" class="transac_no_of_children block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_no_of_children" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NO OF CHILDREN</label>
            </div>

            
            

            <div class="relative z-0 mt-6 w-full group">
                <input type="text" id="transac_id_number" name="transac_id_number" class="transac_id_number block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_id_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ID NUMBER</label>
            </div>


        








            <!-- end of second row -->

            <div class="relative z-0 mt-6 w-full group">
                <input type="text" id="transac_vec_model" name="transac_vec_model" class="transac_vec_model block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_vec_model" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">VEHICLE MODEL</label>
            </div>


 
        <!-- </div> -->





            <div class="relative z-0 mt-6 w-full group">
                <input type="text" id="transac_plate_no" name="transac_plate_no" class="transac_plate_no block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_plate_no" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">VEHICLE PLATE NO</label>
            </div>

      

            <div class="relative z-0 w-full mt-6 group">
                <label for="transac_rate_period" class="peer-focus:font-medium absolute text-md text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">RATE/PERIOD</label>
                <input type="text" id="transac_rate_period" name="transac_rate_period" 
                    class="transac_rate_period block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                    readonly>
            </div>
            

            <div class="relative z-0 mt-6 w-full group">
                <input type="number" id="transac_total_charges" name="transac_total_charges" readonly class="transac_total_charges block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_total_charges" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">TOTAL CHARGES</label>
            </div>



        <!-- Nested Modal -->
       

   
            <div class="relative z-0 w-full mt-4 group">
                <label for="transac_discount" class="transac_discount block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Select Discount
                </label>
                <div class="relative">
                    <select name="transac_discount" id="transac_discount" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-60 overflow-y-auto">
                        @foreach($discount_list as $discount_list_var)
                        <option value="{{ $discount_list_var->charge_discount_id }}" data-discount="{{ $discount_list_var->discount_num }}" data-discount-id="{{ $discount_list_var->charge_discount_id}}">
                            {{ $discount_list_var->discount_description }} ({{ $discount_list_var->discount_num }}%)
                        </option>
                        @endforeach
                    </select>
                    <!-- Custom Icon -->
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="relative z-0 mt-6 w-full group">
                <input type="number" id="transac_sub_total" name="transac_sub_total" class="transac_sub_total block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_sub_total" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">SUB TOTAL</label>
            </div>

            <div class="relative z-0 mt-6 w-full group flex justify-between gap-2">
                <input type="number" id="transac_other_charges" name="transac_other_charges" class="transac_other_charges block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_other_charges" class="peer-focus:font-medium absolute text-xs text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">OTHER CHARGES</label>
                <button type="button" data-modal-show="nested-modal-id" class="bg-blue-700 px-2 py-1 rounded-md shadow-lg hover:bg-blue-900">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                    </svg>
                </button>
                
            </div>


            <div class="relative z-0 mt-8 w-full group">
                <input type="number" id="transac_total"  name="transac_total" class="transac_total block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_total" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">TOTAL</label>
            </div>

            <div class="relative z-0 mt-8 w-full group">
                <input type="number" id="transac_amount_paid" name="transac_amount_paid" class="transac_amount_paid block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_amount_paid" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">AMOUNT PAID</label>
            </div>

            <div class="relative z-0 mt-8 w-full group">
                <input type="number" id="transac_balance"  name="transac_balance" class="transac_balance block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_balance" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">BALANCE</label>
            </div>




            <div class="relative z-0 mt-8 w-full group col-span-2">
                <input type="text" id="transac_reference_num_receipt" name="transac_reference_num_receipt" class="transac_reference_num_receipt block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_reference_num_receipt" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">REFERENCE NUM(RECEIPT)</label>
            </div>


            <div class="relative z-0 mt-4 w-full group hidden">
                <input type="text" id="transac_discount_amount" name="transac_discount_amount" class="transac_discount_amount block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_discount_amount" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">DISCOUNT AMNT</label>
            </div>

            <!-- <div class="relative z-0 mt-8 w-full group">
                <input type="text" id="transac_room_no_of_person" name="transac_room_no_of_person" class="transac_room_no_of_person block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_room_no_of_person" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">no of person</label>
            </div> -->

        


            </div>


            <!-- SWIPE TRANSACTION -->
        <div class="swipe_transaction_list w-6/12 flex gap-x-4 ml-12 hidden">

            <div class="relative z-0 mt-4 w-full group">
                <input type="text" id="transac_bank" name="transac_bank" class="transac_bank block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_bank" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">BANK</label>
            </div>

            <div class="relative z-0 w-full mt-6 group">
                <label for="transac_card_type" class="transac_card_type block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Select Card Type
                </label>
                <div class="relative">
                    <select name="transac_card_type" id="transac_card_type" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-60 overflow-y-auto">
                        <option value="" disabled selected>Choose a Card Type</option>
                        <option value="DEBIT">DEBIT</option>
                        <option value="CREDIT">CREDIT</option>
                       
                    </select>
                    <!-- Custom Icon -->
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

     

            <div class="relative z-0 mt-4 w-full group">
                <input type="text" id="transac_reference_num" name="transac_reference_num" class="transac_reference_num block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="transac_reference_num" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">REFERENCE #</label>
            </div>
        </div>

        <!-- SC/PWD -->
        <div class="sc_pwd_list w-2/12 flex gap-x-4 ml-12 hidden">

            <div class="relative z-0 mt-9 w-full group" id="main_transac_no_of_sc_pwd">
                <input type="text" id="transac_no_of_sc_pwd" name="transac_no_of_sc_pwd" class="transac_no_of_sc_pwd block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                <label for="transac_no_of_sc_pwd" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"> NO OF PWD/SC</label>
            </div>

        </div>

            <!-- BOD DISCOUNT -->
        <div class="bod_discount_list w-6/12 flex gap-x-4 ml-12 hidden">

            <div class="relative mt-6">
                <select name="transac_discount_bod_type" id="transac_discount_bod_type" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-60 overflow-y-auto">
                    <option value="" disabled selected>Choose a discount type</option>
                    <option value="10">Cash Transaction 10%</option>
                    <option value="5">Swipe Transaction 5%</option>
                    <option value="15">BOD 15%</option>
                </select>
                <!-- Custom Icon -->
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <div class="relative z-0 mt-6 ml-4 w-4/12 group" id="main_bod_transac_no_of_sc_pwd_bod">
                <input type="text" id="transac_no_of_sc_pwd_bod" name="transac_no_of_sc_pwd_bod" class="transac_no_of_sc_pwd_bod block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                <label for="transac_no_of_sc_pwd_bod" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"> NO OF PWD/SC</label>
            </div>

        </div>



    </form>







    <div id="nested-modal-id" class="z-0 fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white py-6 rounded-md shadow-lg w-2/5 overflow-y-auto max-h-[80vh]">
            <form name="checkinInnerModal">
                <div class="px-6 py-1 text-xs flex items-center justify-evenly">
                    <table class="w-8/12 border-collapse border border-gray-400 text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-400 py-1 px-2">Category</th>
                                <th class="border border-gray-400 py-1 px-2">Charge Description</th>
                                <th class="border border-gray-400 py-1 px-2">Quantity</th>
                                <th class="border border-gray-400 py-1 px-2">Price</th>
                            </tr>
                        </thead>
                        
                        <tbody id="charges-table-body">
                            @foreach($charges_list as $charges)
                                <tr>
                                    <td class="border border-gray-400">{{ $charges->category }}</td>
                                    <td class="border border-gray-400">{{ $charges->charge_description }} {{ $charges->rate_type }}</td>
                                    <td class="border border-gray-400 w-2/12">
                                        @if($charges->category === 'F&B')
                                            <input 
                                                type="number" 
                                                class="qty-input py-1 border rounded" 
                                                value="1" 
                                                min="1"
                                                readonly
                                                name="checkinInput"
                                            >
                                        @else
                                            <input 
                                                type="number" 
                                                class="qty-input py-1 border rounded" 
                                                data-price="{{ $charges->price }}" 
                                                min="0"
                                                name="checkinInput"
                                            >
                                        @endif
                                    </td>
                                    <td class="border border-gray-400">
                                        @if($charges->category === 'F&B')
                                            <input 
                                                type="number" 
                                                class="price-input py-1 border rounded" 
                                                data-price="{{ $charges->price }}" 
                                                min="0"
                                                name="checkinInput"
                                            >
                                        @else
                                            {{ $charges->price }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                    <div class="mb-1">
                        <p class="font-semibold">TOTAL: <span class="total-amountcharges">0</span></p>
                    </div>
                </div>
    
                <div class="flex justify-end border-t-2 gap-4 w-full">
                    <button type="button" data-modal-hide="nested-modal-id" class="mr-4 mt-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Close</button>
                </div>
            </form>
        </div>
    </div>
    
    

    </x-modalXL>



<!-- END OF ADD CHECKIN -->









    {{-- VIEW MODAL -------------------------------------  --}}

    <x-modalXL id="checkinView-modal" title="CHECKIN DETAILS">

    <form>

        <div class="grid grid-cols-2 gap-x-8 md:grid-cols-5">

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_folio_number" readonly name="checkin_view_folio_number" class="checkin_view_folio_number block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_folio_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">FOLIO NUMBER</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_firstname" readonly name="checkin_view_firstname" class="checkin_view_firstname block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_firstname" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">FIRST NAME</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_lastname" readonly name="checkin_view_lastname" class="checkin_view_lastname block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_lastname" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">LAST NAME</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_address" readonly name="checkin_view_address" class="checkin_view_address block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_address" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ADDRESS</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_country" readonly name="checkin_view_country" class="checkin_view_country block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_country" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">COUNTRY</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_company" readonly name="checkin_view_company" class="checkin_view_company block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">COMPANY</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_roomnum" readonly name="checkin_view_roomnum" class="checkin_view_roomnum block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_roomnum" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM NUMBER</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_datein" readonly name="checkin_view_datein" class="checkin_view_datein block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_datein" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">DATE IN</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_no_of_days" readonly name="checkin_view_no_of_days" class="checkin_view_no_of_days block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_no_of_days" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NO OF DAYS</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_no_of_adults" readonly name="checkin_view_no_of_adults" class="checkin_view_no_of_adults block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_no_of_adults" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NO OF ADULTS</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_no_of_children" readonly name="checkin_view_no_of_children" class="checkin_view_no_of_children block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_no_of_children" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NO OF CHILDREN</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_business_source" readonly name="checkin_view_business_source" class="checkin_view_business_source block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_business_source" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">BUSINESS SOURCE</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_date_out" readonly name="checkin_view_date_out" class="checkin_view_date_out block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_date_out" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">DATE OUT</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_rate_period" readonly name="checkin_view_rate_period" class="checkin_view_rate_period block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_rate_period" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">RATE PERIOD</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_total_charges" readonly name="checkin_view_total_charges" class="checkin_view_total_charges block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_total_charges" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">TOTAL CHARGES</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_other_charges" readonly name="checkin_view_other_charges" class="checkin_view_other_charges block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_other_charges" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">OTHER CHARGES</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_sub_total" readonly name="checkin_view_sub_total" class="checkin_view_sub_total block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_sub_total" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">SUB TOTAL</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_discount" readonly name="checkin_view_discount" class="checkin_view_discount block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_discount" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">DISCOUNT</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_total" readonly name="checkin_view_total" class="checkin_view_total block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_total" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">TOTAL</label>
        </div>


        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_amount_paid" readonly name="checkin_view_amount_paid" class="checkin_view_amount_paid block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_amount_paid" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">AMOUNT PAID</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_balance" readonly name="checkin_view_balance" class="checkin_view_balance block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_balance" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">BALANCE</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_id_type" readonly name="checkin_view_id_type" class="checkin_view_id_type block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_id_type" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ID TYPE</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_id_number" readonly name="checkin_view_id_number" class="checkin_view_id_number block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_id_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ID NUMBER</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_vehicle_model" readonly name="checkin_view_vehicle_model" class="checkin_view_vehicle_model block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_vehicle_model" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">VEHICLE MODEL</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_vehicle_plate_no" readonly name="checkin_view_vehicle_plate_no" class="checkin_view_vehicle_plate_no block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_vehicle_plate_no" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">VEHICLE PLATE NO</label>
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="text" id="checkin_view_reference_num_receipt" readonly name="checkin_view_reference_num_receipt" class="checkin_view_reference_num_receipt block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="checkin_view_reference_num_receipt" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">REFERENCE NUM</label>
        </div>




        </div>

    </form>


    </x-modalXL>













    {{-- EDIT CHECKIN MODAL --}}

    <x-modalXL id="editCheckIn-modal" title="EDIT CHECKIN"
    primaryButtonText="Update" primaryButtonAction="document.getElementById('editCheckIn-form').submit()"
    secondaryButtonAction="document.getElementById('editCheckIn-modal').classList.add('hidden'); document.getElementById('editCheckIn-modal').classList.remove('flex');"
    secondaryButtonText="Cancel"
    secondaryButtonClass="bg-slate-500 hover:bg-slate-600 text-white py-1 px-4 rounded"
    primaryButtonClass="bg-blue-700 hover:bg-blue-800 text-white rounded py-1 px-4">

    <form action="{{route('UpdateCheckIn')}}" id="editCheckIn-form" method="post">
        @csrf

        <div class="grid grid-cols-2 md:grid-cols-6">

        <div class="hidden">
            <label for="edit_checkin_folio_number" class="text-gray-500 text-sm">ID</label>
            <input name="edit_checkin_folio_number" type="text" id="edit_checkin_folio_number" class="edit_checkin_folio_number border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>


        <div class="mt-6">
            <label for="edit_checkin_firstname" class="text-gray-500 text-sm">FIRST NAME</label>
            <input name="edit_checkin_firstname" type="text" id="edit_checkin_firstname" class="edit_checkin_firstname w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="mt-6">
            <label for="edit_checkin_lastname" class="text-gray-500 text-sm">LAST NAME</label>
            <input name="edit_checkin_lastname" type="text" id="edit_checkin_lastname" class="edit_checkin_lastname w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="mt-6">
            <label for="edit_checkin_address" class="text-gray-500 text-sm">ADDRESS</label>
            <input name="edit_checkin_address" type="text" id="edit_checkin_address" class="edit_checkin_address w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="grid">
            <label for="edit_checkin_country" class="text-gray-500 text-sm mt-6">COUNTRY</label>
            <select id="edit_checkin_country" name="edit_checkin_country" class="edit_checkin_country px-1 rounded-lg w-10/12 mb-10" style="border:1px solid gray;"  required>
                <option value="" disabled selected>Select Country</option>
            </select>
        </div>

        <div class="grid">
            <label for="edit_checkin_company" class="text-gray-500 text-sm mt-6">COMPANY</label>
            <select id="edit_checkin_company" name="edit_checkin_company" class="edit_checkin_company px-1 rounded-lg w-10/12 mb-10" style="border:1px solid gray;" required>
                <option value="" disabled selected>Select Company</option>
            </select>
        </div>

        <div class="grid mt-5">
            <label for="edit_checkin_room" class="text-gray-500 text-sm mb-1">ROOM</label>
            <select id="edit_checkin_room" name="edit_checkin_room" class="edit_checkin_room px-1 py-2 rounded-lg w-10/12 mb-10" style="border:1px solid gray;" required>
                <option value="" disabled selected>Select Room</option>
            </select>
        </div>

        <div class="grid">
            <label for="edit_checkin_datein" class="text-gray-500 text-sm">DATE IN</label>
            <input name="edit_checkin_datein" type="date" id="edit_checkin_datein" class="edit_checkin_datein w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="grid">
            <label for="edit_checkin_no_of_days" class="text-gray-500 text-sm">NO OF DAYS</label>
            <input name="edit_checkin_no_of_days" type="number" id="edit_checkin_no_of_days" class="edit_checkin_no_of_days w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="grid">
            <label for="edit_checkin_no_of_adults" class="text-gray-500 text-sm">NO OF ADULTS</label>
            <input name="edit_checkin_no_of_adults" type="number" id="edit_checkin_no_of_adults" class="edit_checkin_no_of_adults w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="grid">
            <label for="edit_checkin_no_of_children" class="text-gray-500 text-sm">NO OF CHILDREN</label>
            <input name="edit_checkin_no_of_children" type="number" id="edit_checkin_no_of_children" class="edit_checkin_no_of_children w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="grid">
            <label for="edit_checkin_business_source_id" class="text-gray-500 text-sm mb-1">BUSINESS SOURCE</label>
            <select id="edit_checkin_business_source_id" name="edit_checkin_business_source_id" class="edit_checkin_business_source_id p-1 rounded-lg w-10/12" style="border:1px solid gray;" required>
                <option value="" disabled selected>Select Room</option>
            </select>
        </div>

        <div class="grid">
            <label for="edit_checkin_dateout" class="text-gray-500 text-sm">DATE OUT</label>
            <input name="edit_checkin_dateout" type="date" id="edit_checkin_dateout" class="edit_checkin_dateout w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="grid mt-5">
            <label for="edit_checkin_id_type" class="text-gray-500 text-sm mb-1">ID TYPE</label>
            <select id="edit_checkin_id_type" name="edit_checkin_id_type" class="edit_checkin_id_type p-1 rounded-lg w-10/12" style="border:1px solid gray;" required>
                <option value="" disabled selected>Choose a ID TYPE</option>
                <option value="National_ID">NATIONAL ID</option>
                <option value="Voter ID">VOTER ID</option>
                <option value="TIN ID">TIN ID</option>
                <option value="PhilHealth ID">PHILHEALTH ID</option>
                <option value="Passport ID">PASSPORT ID</option>
                <option value="School ID">SCHOOL ID</option>
                <option value="Postal ID">POSTAL ID</option>
                <option value="DRIVER LICENSE">DRIVER LICENSE</option>
                <option value="PRC ID">PRC ID</option>
                <option value="Others">Others</option>
            </select>
        </div>


        <div class="grid mt-5">
            <label for="edit_checkin_id_number" class="text-gray-500 text-sm">ID NUMBER</label>
            <input name="edit_checkin_id_number" type="text" id="edit_checkin_id_number" class="edit_checkin_id_number w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="grid mt-5">
            <label for="edit_checkin_vehicle_model" class="text-gray-500 text-sm">VEHICLE MODEL</label>
            <input name="edit_checkin_vehicle_model" type="text" id="edit_checkin_vehicle_model" class="edit_checkin_vehicle_model w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="grid mt-5">
            <label for="edit_checkin_vehicle_plate_no" class="text-gray-500 text-sm">VEHICLE PLATE NO</label>
            <input name="edit_checkin_vehicle_plate_no" type="text" id="edit_checkin_vehicle_plate_no" class="edit_checkin_vehicle_plate_no w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="grid mt-5">
            <label for="edit_checkin_rate_period" class="text-gray-500 text-sm">RATE PERIOD</label>
            <input name="edit_checkin_rate_period" readonly type="text" id="edit_checkin_rate_period" class="edit_checkin_rate_period w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

        <div class="grid mt-5">
            <label for="edit_checkin_total_charges" class="text-gray-500 text-sm">TOTAL CHARGES</label>
            <input name="edit_checkin_total_charges" readonly type="text" id="edit_checkin_total_charges" class="edit_checkin_total_charges w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>

      
        <div class="grid mt-5">
            <label for="edit_checkin_discount" class="text-gray-500 text-sm">DISCOUNT</label>
            <select id="edit_checkin_discount" name="edit_checkin_discount" class="edit_checkin_discount px-1 rounded-lg w-10/12" style="border:1px solid gray;" required>
                <option value="" disabled selected>Select Discount</option>
            </select>
            
        </div>

        <div class="grid mt-5">
            <label for="edit_checkin_sub_total" class="text-gray-500 text-sm">SUB TOTAL</label>
            <input name="edit_checkin_sub_total" readonly type="text" id="edit_checkin_sub_total" class="edit_checkin_sub_total w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>


        <div class="grid mt-5">
            <label for="edit_checkin_other_charges" class="text-gray-500 text-sm">OTHER CHARGES</label>
            <div class="flex gap-x-3">
                <input name="edit_checkin_other_charges" type="text" id="edit_checkin_other_charges" class="edit_checkin_other_charges w-7/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
                <button type="button" data-modal-show="nested-modal-id2" class="bg-blue-700 px-3 py-0 rounded-md shadow-lg hover:bg-blue-900">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-5">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="grid mt-5">
            <label for="edit_checkin_total" class="text-gray-500 text-sm">TOTAL</label>
            <input name="edit_checkin_total" readonly type="text" id="edit_checkin_total" class="edit_checkin_total w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>


        <div class="grid mt-5">
            <label for="edit_checkin_amount_paid" class="text-gray-500 text-sm">AMOUNT PAID</label>
            <input name="edit_checkin_amount_paid" type="text" id="edit_checkin_amount_paid" class="edit_checkin_amount_paid w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>


        <div class="grid mt-5">
            <label for="edit_checkin_balance" class="text-gray-500 text-sm">BALANCE</label>
            <input name="edit_checkin_balance" readonly type="text" id="edit_checkin_balance" class="edit_checkin_balance w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>


 

        <div class="grid mt-5">
            <label for="edit_checkin_reference_num_receipt" class="text-gray-500 text-sm">REFERENCE NUM(RECEIPT)</label>
            <input name="edit_checkin_reference_num_receipt" type="text" id="edit_checkin_reference_num_receipt" class="edit_checkin_reference_num_receipt w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
        </div>




        <div class="relative z-0 mt-5 hidden">
            <input type="text" id="edit_discount_amount" name="edit_discount_amount" class="edit_discount_amount block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="edit_discount_amount" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">DISCOUNT AMNT</label>
        </div>

        


        </div>




        <!-- SWIPE TRANSACTIONS FIELDS -->
        <div class="flex w-full hidden" id="swipe_transaction_editModal">


            <div class="grid mt-5">
                <label for="edit_checkin_bank" class="text-gray-500 text-sm">BANK</label>
                <input name="edit_checkin_bank" type="text" id="edit_checkin_bank" class="edit_checkin_bank w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

                    
            <div class="grid mt-5">
                <label for="edit_checkin_card_type" class="text-gray-500 text-sm mb-1">ID TYPE</label>
                <select id="edit_checkin_card_type" name="edit_checkin_card_type" class="edit_checkin_card_type p-1 mr-4 rounded-lg w-12/12" required>

                    <option value="DEBIT">DEBIT</option>
                    <option value="CREDIT">CREDIT</option>

                </select>
            </div>

            <div class="grid mt-5">
                <label for="edit_checkin_reference_num" class="text-gray-500 text-sm">REFERENCE NUM</label>
                <input name="edit_checkin_reference_num" type="text" id="edit_checkin_reference_num" class="edit_checkin_reference_num w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

        </div>

        <!-- SENIOR CITIZEN & PWD -->
        <div class="flex w-full hidden" id="sc_pwd_editModal">


            <div class="grid mt-5">
                <label for="edit_no_of_sc_pwd" class="text-gray-500 text-sm">NO OF SC&PWD</label>
                <input name="edit_no_of_sc_pwd" type="text" id="edit_no_of_sc_pwd" class="edit_no_of_sc_pwd w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>


        </div>


        <!-- BOD EDIT MODAL -->
        <div class="flex w-full ml-5 hidden" id="bod_editModal">


                 
            <div class="grid mt-4">
                <label for="edit_bod_discount_type" class="text-gray-500 text-sm mb-1">chose discount type</label>
                <select id="edit_bod_discount_type" name="edit_bod_discount_type" class="edit_bod_discount_type p-1 mr-4 rounded-lg w-12/12" required>

                    <option value="10">Cash Transaction</option>
                    <option value="5">Swipe Transaction</option>
                    <option value="15">BOD</option>
                    
                </select>
            </div>

            <div class="grid mt-4">
                <label for="edit_bod_no_of_sc_pwd" class="text-gray-500 text-sm">NO OF SC&PWD</label>
                <input name="edit_bod_no_of_sc_pwd" type="text" id="edit_bod_no_of_sc_pwd" class="edit_bod_no_of_sc_pwd w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>


        </div>



    </form>







    <div id="nested-modal-id2" class="z-0 fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white py-5 rounded shadow-lg w-2/5 overflow-y-auto max-h-[80vh]">
            <form name="editInnerModal" action="{{ route('storeOtherchargesEdit') }}" method="POST">
                <div class="px-6 py-1 text-xs flex items-center justify-evenly">
                    <table class="w-8/12 border-collapse border border-gray-400 text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-400 p-1">Category</th>
                                <th class="border border-gray-400 p-1">Charge Description</th>
                                <th class="border border-gray-400 p-1">Quantity</th>
                                <th class="border border-gray-400 p-1">Price</th>
                            </tr>
                        </thead>
                        <tbody id="charges-table-body2">
                            <!-- Rows will be dynamically populated here -->
                        </tbody>
                    </table>
    
                    <div class="mb-1">
                        <p class="font-semibold">TOTAL: <span class="total-amountchargesEdit">0</span></p>
                    </div>
                </div>
    
                <div class="flex justify-end border-t-2 gap-4 w-full">
                    <!-- Save Button -->
                    <button type="submit" id="save-charges-btn" class="mr-4 mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
                    <!-- Close Button -->
                    <button type="button" data-modal-hide="nested-modal-id2" class="mr-4 mt-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Close</button>
                </div>
            </form>
        </div>
    </div>
    

    </x-modalXL>













    {{-- EDIT CHECKOUT --}}


    <x-modalXL id="editCheckOut-modal" title="EDIT CHECKOUT"
    primaryButtonText="Update" primaryButtonAction="document.getElementById('editCheckOut-form').submit()"
    secondaryButtonAction="document.getElementById('editCheckOut-modal').classList.add('hidden'); document.getElementById('editCheckOut-modal').classList.remove('flex');"
    secondaryButtonText="Cancel"
    secondaryButtonClass="bg-slate-500 hover:bg-slate-600 text-white py-1 px-4 rounded"
    primaryButtonClass="bg-blue-700 hover:bg-blue-800 text-white rounded py-1 px-4">

    <form action="{{ route('UpdateCheckOut') }}" id="editCheckOut-form" method="post">
        @csrf

        <div class="grid grid-cols-2 md:grid-cols-6">
            <div class="hidden">
                <label for="edit_checkout_folio_number" class="text-gray-500 text-sm">ID</label>
                <input name="edit_checkout_folio_number" type="text" id="edit_checkout_folio_number" class="edit_checkout_folio_number border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_firstname" class="text-gray-500 text-sm dark:text-white">FIRST NAME</label>
                <input name="edit_checkout_firstname" type="text" id="edit_checkout_firstname" class="edit_checkout_firstname w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_lastname" class="text-gray-500 text-sm dark:text-white">LAST NAME</label>
                <input name="edit_checkout_lastname" type="text" id="edit_checkout_lastname" class="edit_checkout_lastname w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_address" class="text-gray-500 text-sm dark:text-white">ADDRESS</label>
                <input name="edit_checkout_address" type="text" id="edit_checkout_address" class="edit_checkout_address w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_datein" class="text-gray-500 text-sm dark:text-white">DATE IN</label> <!-- Fixed label typo -->
                <input name="edit_checkout_datein" type="date" id="edit_checkout_datein" class="edit_checkout_datein w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <!-- Add more fields as needed -->
            <div class="mt-2">
                <label for="edit_checkout_dateout" class="text-gray-500 text-sm dark:text-white">DATE OUT</label>
                <input name="edit_checkout_dateout" type="date" id="edit_checkout_dateout" class="edit_checkout_dateout w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_no_of_days" class="text-gray-500 text-sm dark:text-white">NO OF DAYS</label>
                <input name="edit_checkout_no_of_days" type="number" id="edit_checkout_no_of_days" class="edit_checkout_no_of_days w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_no_of_adults" class="text-gray-500 text-sm dark:text-white">NO ADULTS</label>
                <input name="edit_checkout_no_of_adults" type="number" id="edit_checkout_no_of_adults" class="edit_checkout_no_of_adults w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_no_of_children" class="text-gray-500 text-sm dark:text-white">NO CHILDREN</label>
                <input name="edit_checkout_no_of_children" type="number" id="edit_checkout_no_of_children" class="edit_checkout_no_of_children w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="grid">
                <label for="edit_checkout_country" class="text-gray-500 text-sm mt-6 dark:text-white">COUNTRY</label>
                <select id="edit_checkout_country" name="edit_checkout_country" class="edit_checkout_country px-1 rounded-lg w-10/12" style="border:1px solid gray;">
                    <option value="" disabled selected>Select Country</option>
                </select>
            </div>

            <div class="grid">
                <label for="edit_checkout_company" class="text-gray-500 text-sm mt-6 dark:text-white">COMPANY</label>
                <select id="edit_checkout_company" name="edit_checkout_company" class="edit_checkout_company px-1 rounded-lg w-10/12" style="border:1px solid gray;">
                    <option value="" disabled selected>Select Company</option>
                </select>
            </div>

            <div class="grid">
                <label for="edit_checkout_business_source" class="text-gray-500 text-sm mt-6 dark:text-white">BUSINESS SOURCE</label>
                <select id="edit_checkout_business_source" name="edit_checkout_business_source" class="edit_checkout_business_source px-1 rounded-lg w-10/12" style="border:1px solid gray;">
                    <option value="" disabled selected>Select Business Source</option>
                </select>
            </div>

            <div class="grid">
                <label for="edit_checkout_id_type" class="text-gray-500 text-sm mt-6 dark:text-white">ID TYPE</label>
                <select id="edit_checkout_id_type" name="edit_checkout_id_type" class="edit_checkout_id_type px-1 rounded-lg w-10/12" style="border:1px solid gray;">
                    <option value="" disabled selected>Choose a ID TYPE</option>
                    <option value="National_ID">NATIONAL ID</option>
                    <option value="Voter ID">VOTER ID</option>
                    <option value="TIN ID">TIN ID</option>
                    <option value="PhilHealth ID">PHILHEALTH ID</option>
                    <option value="Passport ID">PASSPORT ID</option>
                    <option value="School ID">SCHOOL ID</option>
                    <option value="Postal ID">POSTAL ID</option>
                    <option value="DRIVER LICENSE">DRIVER LICENSE</option>
                    <option value="PRC ID">PRC ID</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="mt-2">
                <label for="edit_checkout_rate_period" class="text-gray-500 text-sm dark:text-white">RATE PERIOD</label>
                <input name="edit_checkout_rate_period" type="number" id="edit_checkout_rate_period" class="edit_checkout_rate_period w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_total_charges" class="text-gray-500 text-sm dark:text-white">TOTAL CHARGES</label>
                <input name="edit_checkout_total_charges" type="number" id="edit_checkout_total_charges" class="edit_checkout_total_charges w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_other_charges" class="text-gray-500 text-sm dark:text-white">OTHER CHARGES</label>
                <input name="edit_checkout_other_charges" type="number" id="edit_checkout_other_charges" class="edit_checkout_other_charges w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_sub_total" class="text-gray-500 text-sm dark:text-white">SUB TOTAL</label>
                <input name="edit_checkout_sub_total" type="number" id="edit_checkout_sub_total" class="edit_checkout_sub_total w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_discount" class="text-gray-500 text-sm dark:text-white">DISCOUNT</label>
                <select id="edit_checkout_discount" name="edit_checkout_discount" class="edit_checkout_discount px-1 rounded-lg w-10/12" style="border:1px solid gray;" >
                    <option value="" disabled selected>Select Discount</option>
                </select>
            </div>

            <div class="mt-2">
                <label for="edit_checkout_total" class="text-gray-500 text-sm dark:text-white">TOTAL</label>
                <input name="edit_checkout_total" type="number" id="edit_checkout_total" class="edit_checkout_total w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>
            

            <div class="mt-2">
                <label for="edit_checkout_amount_paid" class="text-gray-500 text-sm dark:text-white">AMOUNT PAID</label>
                <input name="edit_checkout_amount_paid" type="number" id="edit_checkout_amount_paid" class="edit_checkout_amount_paid w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>

            <div class="mt-2">
                <label for="edit_checkout_balance" class="text-gray-500 text-sm dark:text-white">BALANCE</label>
                <input name="edit_checkout_balance" type="number" id="edit_checkout_balance" class="edit_checkout_balance w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>
            

            <div class="mt-2">
                <label for="edit_checkout_reference_num_receipt" class="text-gray-500 text-sm dark:text-white">REFERENCE NUM RECEIPT</label>
                <input name="edit_checkout_reference_num_receipt" type="text" id="edit_checkout_reference_num_receipt" class="edit_checkout_reference_num_receipt w-10/12 border border-gray-400 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-0 focus:border-blue-800">
            </div>
            
            

            

        </div>
    </form>
</x-modalXL>
    {{-- edit END MODALS --}}




 

@push('scripts')

<script src="{{ asset('js/search.js')}}"></script>
<script src="{{ asset('js/data_modal.js')}}"></script>


{{-- edit --}}




<script>
    $(document).ready(function() {
        var noTransactionTable = $('#reservationList').DataTable({
            searching: true,
            pageLength: 6,
            ajax: {
                url: '{{ route('get_reservationList') }}',
                method: 'GET',
                dataSrc: function(json) {
                    return json;
                }
            },
            columns: [
                { data: 'folio_number', type: 'num', visible: false }, 
                { data: 'first_name' },
                { data: 'last_name' },
                {
                    data: 'date_in',
                    render: function(data, type, row) {
                        if (!data) return ""; // Handle null values
                        return formatDate(data); // Use a function to format the date
                    }
                },
                { data: 'room_number' },
                {
                    data: null, 
                    visible: true, 
                    render: function(data, type, row) {
                        return `
                            <a class="border cursor-pointer bg-lime-700 hover:bg-lime-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_modal_view_checkin_reserved" data-id="${data.folio_number}">
                                <img src="/svg/input.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                            </a>

                            <a class="border cursor-pointer bg-red-700 hover:bg-red-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_modal_delete_checkin_reserved" data-id="${data.folio_number}">
                                <img src="/svg/delete.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                            </a>
                        `;
                    }
                },
            ],
            order: [[0, 'desc']],
        });

        // Function to properly format the date
        function formatDate(dateString) {
            let dateObj = new Date(dateString);
            let year = dateObj.getFullYear();
            let month = String(dateObj.getMonth() + 1).padStart(2, '0'); // Ensure 2 digits
            let day = String(dateObj.getDate()).padStart(2, '0'); // Ensure 2 digits
            return `${year}-${month}-${day}`; // Format YYYY-MM-DD
        }
    });
</script>





<script>

function formatDate(dateString) {
    const date = new Date(dateString);
    const formatter = new Intl.DateTimeFormat('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
        // hour: 'numeric',
        // minute: 'numeric',
        // hour12: true
    });
    
    return formatter.format(date); // Format the date
}

$(document).ready(function() {
    var noTransactionTable = $('#checkoutList_datatable').DataTable({
        searching: true,
        pageLength: 6,
        ajax: {
            url: '{{ route('get_CheckoutList') }}',
            method: 'GET',
            dataSrc: function(json) {
                return json;
            }
        },
        columns: [
            {   data: 'folio_number', type: 'num', visible: false },
            {   data: 'first_name' },
            {   data: 'last_name' },
            {
                data: 'date_in',
                render: function(data, type, row) {
                    if (data === null || data === '') {
                        return ''; 
                    }
                    if (type === 'display' || type === 'filter') {
                        return formatDate(data); 
                    }
                    return data; 
                }
            },


            {
                data: 'date_out',
                render: function(data, type, row) {
                    if (data === null || data === '') {
                        return ''; 
                    }
                    if (type === 'display' || type === 'filter') {
                        return formatDate(data); 
                    }
                    return data; 
                }
            },




            {   data: 'room_number' },

            {
                data: null, 
                visible: true, 
                render: function(data, type, row) {
                    return `
                        <a class="border cursor-pointer bg-blue-700 hover:bg-blue-500 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_modal_edit_checkout" data-id="${data.folio_number}">
                            <img src="/svg/edit.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                        </a>

                        <a class="border cursor-pointer bg-red-700 hover:bg-red-500 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_modal_delete_checkout" data-id="${data.folio_number}">
                            <img src="/svg/delete.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                        </a>

                        
                    `;
                }
            }
        ],
        order: [[0, 'desc']],
    });
});

</script>



  
<script>
    // Dropdown toggle
    document.getElementById('dropdownNavbarLink2').addEventListener('click', function(event) {
        event.stopPropagation();
        var dropdown = document.getElementById('dropdownNavbar2');
        dropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('dropdownNavbar2');
        if (!document.getElementById('dropdownNavbarLink2').contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Function to close the dropdown
    function closeDropdown() {
        var dropdown = document.getElementById('dropdownNavbar2');
        dropdown.classList.add('hidden');
    }
</script>

<script>
 document.getElementById('transac_room_number').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    let roomRate = selectedOption.getAttribute('data-room-rate');
    roomRate = roomRate ? parseFloat(roomRate).toFixed(2) : '';
    document.getElementById('transac_rate_period').value = roomRate;
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectElement = document.getElementById('transac_discount');
        if (selectElement) {
            selectElement.addEventListener('change', function() {
                var selectedValue = this.value;
                var swipeTransactionList = document.querySelector('.swipe_transaction_list');
                if (swipeTransactionList) {
                    if (selectedValue == '3') {
                        swipeTransactionList.classList.remove('hidden');
                    } else {
                        swipeTransactionList.classList.add('hidden');
                    }
                } else {
                    console.error('swipe_transaction_list element not found');
                }
            });
        } else {
            console.error('transac_discount element not found');
        }
    });
</script>

<!-- senior citizen -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectElement = document.getElementById('transac_discount');
        if (selectElement) {
            selectElement.addEventListener('change', function() {
                var selectedValue = this.value;
                var swipeTransactionList = document.querySelector('.sc_pwd_list');
                if (swipeTransactionList) {
                    if (selectedValue == '2') {
                        swipeTransactionList.classList.remove('hidden');
                    } else {
                        swipeTransactionList.classList.add('hidden');
                    }
                } else {
                    console.error('sc_pwd_list element not found');
                }
            });
        } else {
            console.error('transac_discount element not found');
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectElement = document.getElementById('transac_discount');
        if (selectElement) {
            selectElement.addEventListener('change', function() {
                var selectedValue = this.value;
                var swipeTransactionList = document.querySelector('.bod_discount_list');
                if (swipeTransactionList) {
                    if (selectedValue == '4') {
                        swipeTransactionList.classList.remove('hidden');
                    } else {
                        swipeTransactionList.classList.add('hidden');
                    }
                } else {
                    console.error('sc_pwd_list element not found');
                }
            });
        } else {
            console.error('transac_discount element not found');
        }
    });
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const qtyInputs = document.querySelectorAll('.qty-input');
    const totalAmountEl = document.querySelectorAll('.total-amountcharges');
    const transacOtherChargesInput = document.getElementById('transac_other_charges');
    const totalChargesInput = document.getElementById('transac_total_charges');
    const transacSubTotalInput = document.getElementById('transac_sub_total');
    const transacTotalInput = document.getElementById('transac_total');
    const transacDiscountDropdown = document.getElementById('transac_discount');
    const roomDropdown = document.getElementById('transac_room_number');
    const adultsInput = document.getElementById('transac_no_of_adults');
    const childrenInput = document.getElementById('transac_no_of_children');
    const ratePeriodInput = document.getElementById('transac_rate_period');
    const transacAmountPaidInput = document.getElementById('transac_amount_paid');
    const transacBalanceInput = document.getElementById('transac_balance');
    const noOfDaysInput = document.getElementById('transac_no_of_days');
    const discountedAmountInput = document.getElementById('transac_discount_amount');
    const priceInputs = document.querySelectorAll('.price-input');
    const no_of_person_room_Input = document.getElementById('transac_no_of_sc_pwd');
    const bod_discount_type = document.getElementById('transac_discount_bod_type');
    const bod_no_of_sc_pwd_Input = document.getElementById('transac_no_of_sc_pwd_bod');

    let adultRate = 0;
    let childrenRate = 0;
    let roomRate = 0;

    function calculateTotalCharges() {
        let otherChargesTotal = 0;

        qtyInputs.forEach(input => {
            const priceInput = input.closest('tr').querySelector('.price-input');
            const price = priceInput ? parseFloat(priceInput.value || 0) : parseFloat(input.dataset.price || 0);
            const qty = parseFloat(input.value || 0);
            otherChargesTotal += price * qty;
        });

        totalAmountEl.forEach(el => {
            el.textContent = otherChargesTotal.toFixed(2);
        });

        transacOtherChargesInput.value = otherChargesTotal.toFixed(2);

        updateSubTotal();
    }

    qtyInputs.forEach(input => input.addEventListener('input', calculateTotalCharges));
    priceInputs.forEach(input => input.addEventListener('input', calculateTotalCharges));

    noOfDaysInput.addEventListener('input', updateRatePeriod);

    function updateRatePeriod() {
        const noOfDays = parseInt(noOfDaysInput.value) || 1;
        const totalRoomRate = roomRate * noOfDays;
        ratePeriodInput.value = roomRate.toFixed(2);
        calculateRoomCharges();
    }

    function calculateRoomCharges() {
        const noOfAdults = parseInt(adultsInput.value) || 0;
        const noOfChildren = parseInt(childrenInput.value) || 0;
        const noOfDays = parseInt(noOfDaysInput.value) || 1;

        const totalRoomRate = roomRate * noOfDays;
        const roomCharges = noOfAdults * adultRate + noOfChildren * childrenRate + totalRoomRate;

        totalChargesInput.value = roomCharges.toFixed(2);
        updateSubTotal();
    }

    function updateSubTotal() {
        const totalCharges = parseFloat(totalChargesInput.value || 0); // Base room charges (before discount)
        const otherCharges = parseFloat(transacOtherChargesInput.value || 0);
        applyDiscount(totalCharges, otherCharges); // Pass totalCharges and otherCharges to applyDiscount
    }

    function applyDiscount(totalCharges, otherCharges) {
    const noOfSC_PWD = parseInt(no_of_person_room_Input.value) || 0;
    const noOfSC_PWD_BOD = parseInt(bod_no_of_sc_pwd_Input.value) || 0;
    const selectedOption = transacDiscountDropdown.options[transacDiscountDropdown.selectedIndex];
    const discount = parseFloat(selectedOption.getAttribute('data-discount')) || 0;
    const discountID = parseFloat(selectedOption.getAttribute('data-discount-id')) || 0;

    const selectedRoom = roomDropdown.options[roomDropdown.selectedIndex];
    const totalRoomRate = parseFloat(selectedRoom.getAttribute('data-room-rate')) || 0; // Single day's room rate
    const noOfPersons = parseInt(selectedRoom.getAttribute('data-no-of-person')) || 1;
    const noOfDays = parseInt(noOfDaysInput.value) || 1;

    let discountedTotal = 0;
    let discountAmount = 0;
    let final_total = 0;
    let discountAmount2 = 0;


    if (discountID === 2) {
        let var1 = totalRoomRate / noOfPersons;
       // console.log("var1",var1);
        const var2 = Math.ceil(var1 * noOfSC_PWD);
      //  console.log("var2",var2);
        const var3 = (var2 / 1.12);
   //     console.log("var3",var3);
        const var4 = (var3 * discount) / 100;
      //  console.log("var4",var4);
        const ext = var3 - var4;
    //    console.log('ext',ext);
        const var5 = noOfPersons - noOfSC_PWD;
     //   console.log('var5',var5);
        discountedTotal =  Math.ceil((var5 * var1) + ext) * noOfDays; 
       // console.log('discountedTotal',discountedTotal);
        final_total = Math.ceil(discountedTotal) + otherCharges
   
        discountAmount = totalCharges - discountedTotal;

    }

    //  else if (discountID === 9) { 
    //     const var1 = totalRoomRate / 1.12;
    //     const var2 = (var1 * discount) / 100;
    //     const var3 = totalRoomRate - var2;
    //     discountedTotal = var3 * noOfDays; 
    //     final_total = discountedTotal + otherCharges;
    //     discountAmount = var2 * noOfDays; 
    // } 

    
    else if (discountID === 9) { 
        const var1 = totalRoomRate / 1.12;
        const var2 = (var1 * discount) / 100;
        const var3 = Number((totalRoomRate - var2).toFixed(2));
        discountedTotal = var3 * noOfDays; 
        final_total = (discountedTotal) + otherCharges;

        discountAmount = totalCharges - discountedTotal;
    } 
    
    
    
    else if (discountID === 4 && noOfSC_PWD_BOD === 0) { 
        const selectedTransactionType = parseFloat(bod_discount_type.value) || 0;

        if (selectedTransactionType === 10) {
            discountAmount2 = ((totalRoomRate * 10) / 100); 
            discountAmount = ((totalRoomRate * 10) / 100) * noOfDays; 
        } else if (selectedTransactionType === 5) {
            discountAmount2 = ((totalRoomRate * 5) / 100); 
            discountAmount = ((totalRoomRate * 5) / 100) * noOfDays; 
        } else if (selectedTransactionType === 15) {
            discountAmount2 = ((totalRoomRate * 15) / 100); 
            discountAmount = ((totalRoomRate * 15) / 100) * noOfDays; 
        } else {
            discountAmount2 = 0;
        }


        discountedTotal_pre = (totalRoomRate - discountAmount2) * noOfDays;
        discountedTotal = Math.round(discountedTotal_pre);
        final_total = discountedTotal + otherCharges;
    }

    //discountedTotal = ((var2 * var5) + (var3 - var4)) * noOfDays; 
    else if (discountID === 4 && noOfSC_PWD_BOD !== 0) { 
        const selectedTransactionType = parseFloat(bod_discount_type.value) || 0;
        const var1 = (totalRoomRate * selectedTransactionType) / 100;
        const ext = totalRoomRate - var1;
        const var2 = ext / noOfPersons;
        const var3 = var2 / 1.12;
        const var4 = (var3 * 20) / 100;
        const var5 = noOfPersons - noOfSC_PWD_BOD;

        discountedTotal_pre = (var5 === 0 ? (var3 - var4) * 2 : ((var2 * var5) + (var3 - var4))) * noOfDays;
        discountedTotal = Math.round(discountedTotal_pre);
        final_total = discountedTotal + otherCharges;
        discountAmount = totalCharges - discountedTotal;
  

    } 
    
    
    
    else { 

        discountAmount2 = ((totalRoomRate  * discount) / 100);
        discountedTotal = (totalRoomRate  - discountAmount2) * noOfDays; 
        final_total = discountedTotal + otherCharges;
        discountAmount = totalCharges - discountedTotal;

        }
        
    transacSubTotalInput.value = (discountedTotal).toFixed(2); 
    transacTotalInput.value = final_total.toFixed(2); // Discounted room rate * noOfDays + otherCharges
    discountedAmountInput.value = Number(discountAmount).toFixed(2);
    updateBalance();
}

    document.getElementById('transac_no_of_sc_pwd').addEventListener('input', () => updateSubTotal());
    document.getElementById('transac_discount_bod_type').addEventListener('change', () => updateSubTotal());
    document.getElementById('transac_no_of_sc_pwd_bod').addEventListener('input', () => updateSubTotal());

    transacDiscountDropdown.addEventListener('change', () => updateSubTotal());
    roomDropdown.addEventListener('change', function () {
        const selectedOption = roomDropdown.options[roomDropdown.selectedIndex];
        adultRate = parseFloat(selectedOption.getAttribute('data-adult-rate')) || 0;
        childrenRate = parseFloat(selectedOption.getAttribute('data-children-rate')) || 0;
        roomRate = parseFloat(selectedOption.getAttribute('data-room-rate')) || 0;
        updateRatePeriod();
    });

    adultsInput.addEventListener('input', calculateRoomCharges);
    childrenInput.addEventListener('input', calculateRoomCharges);

    transacAmountPaidInput.addEventListener('input', updateBalance);

    function updateBalance() {
        const transacTotal = parseFloat(transacTotalInput.value || 0);
        const amountPaid = parseFloat(transacAmountPaidInput.value || 0);
        let pre_balance = transacTotal - amountPaid;
        let balance = Math.round(pre_balance);
        transacBalanceInput.value = (amountPaid ?(balance === 0 ? 0 : balance) : transacTotal).toFixed(2);
    }


    updateBalance();
});


</script>
 




@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Update Failed',
            text: "{{ session('error') }}",
      
        });
    </script>
@endif





@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

 





<script>
    document.getElementById('searchCustomer').addEventListener('input', function () {
        const query = this.value;
    
        if (query.length < 1) {
            document.getElementById('customerSearchResults').classList.add('hidden');
            return;
        }
    
        fetch(`/search-customers?query=${query}`)
            .then(response => response.json())
            .then(data => {
                const resultsContainer = document.getElementById('customerSearchResults');
                resultsContainer.innerHTML = '';
    
                if (data.length > 0) {
                    data.forEach(customer => {
                        const resultItem = document.createElement('div');
                        resultItem.className = 'p-2 cursor-pointer hover:bg-gray-500';
                        resultItem.textContent = `${customer.first_name} ${customer.last_name}`;
                        resultItem.dataset.customerId = customer.customer_id;
    
                        resultItem.addEventListener('click', function () {
                            // Populate the form field with the selected customer's name
                            document.getElementById('transac_firstname').value = customer.first_name;
                            document.getElementById('transac_lastname').value = customer.last_name;
    
                            // Optionally set the customer ID in a hidden input
                            let customerIdInput = document.getElementById('customer_id');
                            if (!customerIdInput) {
                                customerIdInput = document.createElement('input');
                                customerIdInput.type = 'hidden';
                                customerIdInput.id = 'customer_id';
                                customerIdInput.name = 'customer_id';
                                document.getElementById('checkIn-form').appendChild(customerIdInput);
                            }
                            customerIdInput.value = customer.customer_id;
    
                            // Hide the search results
                            resultsContainer.classList.add('hidden');
                        });
    
                        resultsContainer.appendChild(resultItem);
                    });
    
                    resultsContainer.classList.remove('hidden');
                } else {
                    resultsContainer.classList.add('hidden');
                }
            });
    });
</script>
    


<script>
    function display_realtime(page = 1) {
        var search = $('.mySearch').val(); 
        $.ajax({
            url: '{{ route('checkin_list') }}',
            type: 'GET',
            dataType: 'json',
            data: {
                page: page,
                search: search, 
            },
            success: function (data) {
                var tableBody = $('.default_datatable_roomList tbody');
                tableBody.empty(); // Clear existing table data
    
      
                data.attendances.forEach(function (attendance) {
                    var row = $("<tr class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>");
                        row.append("<td class='px-6 py-2'>" + (attendance.folio_number || '') + '</td>');
                        row.append("<td class='px-6 py-2'>" + (attendance.first_name || '') + '</td>');
                        row.append("<td class='px-6 py-2'>" + (attendance.last_name || '') + '</td>');
                        row.append("<td class='px-6 py-2'>" + (attendance.room_number || '') + '</td>');
                        let dateIn = '';
                        if (attendance.date_in) {
                            const date = new Date(attendance.date_in);
                            dateIn = date.toLocaleDateString('en-PH', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }).split('/').join('-'); // Format as YYYY-MM-DD
                        }
                        row.append("<td class='px-6 py-2'>" + dateIn + '</td>');
                        row.append("<td class='px-6 py-2'>" + (attendance.business_source || '') + '</td>');
                        var actionCell = `
                            <td class="px-6 py-3">
                              <a class="border cursor-pointer bg-lime-700 hover:bg-lime-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_modal_view_checkout" data-id="${attendance.folio_number}">
                                    <img src="/svg/check2.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                                </a>


                                <a class="border cursor-pointer bg-green-700 hover:bg-green-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_modal_view_checkin" data-id="${attendance.folio_number}">
                                    <img src="/svg/view.svg" alt="view" class="w-6 h-6 mx-auto inline text-slate-50">
                                </a>

                                <a class="border cursor-pointer bg-blue-700 hover:bg-blue-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center  btn_table_modal_edit_checkin" data-id="${attendance.folio_number}">
                                    <img src="/svg/edit.svg" alt="edit" class="w-6 h-6 mx-auto inline text-slate-50">
                                </a>

                                <a class="border cursor-pointer bg-red-700 hover:bg-red-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_modal_delete_checkin" data-room="${attendance.room_id}" data-id="${attendance.folio_number}">
                                    <img src="/svg/delete.svg" alt="delete" class="w-6 h-6 mx-auto inline text-slate-50">
                                </a>
                            </td>
                        `;
                    row.append(actionCell);
                    tableBody.append(row);
                });
    
    
    
                renderPagination(data.current_page, data.last_page, data.total);
    
            },
            error: function (error) {
                console.error('Error fetching attendance data:', error);
            }
        });
    }
    
    
    
    
    display_realtime();
    
    function renderPagination(currentPage, lastPage, total) {
        const paginationContainer = $('#pagination');
        paginationContainer.empty(); // Clear existing pagination
    
        let paginationHtml = '';
    
        // Previous button
        paginationHtml += `<button onclick="display_realtime(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>‹</button>`;
    
        // Define the range of page numbers to display
        const pageLimit = 5; // Number of page links to show
        let startPage = Math.max(1, currentPage - Math.floor(pageLimit / 2));
        let endPage = Math.min(lastPage, startPage + pageLimit - 1);
    
        // Adjust startPage if endPage exceeds lastPage
        if (endPage === lastPage) {
            startPage = Math.max(1, lastPage - pageLimit + 1);
        }
    
        // Create page buttons
        for (let i = startPage; i <= endPage; i++) {
            if (i === currentPage) {
                paginationHtml += `<span>${i}</span>`; // Current page
            } else {
                paginationHtml += `<button onclick="display_realtime(${i})">${i}</button>`;
            }
        }
    
        // Add ellipses if there are pages before the start page
        if (startPage > 1) {
            paginationHtml = `<button onclick="display_realtime(1)">1</button>...` + paginationHtml;
        }
    
        // Add ellipses if there are pages after the end page
        if (endPage < lastPage) {
            paginationHtml += `...<button onclick="display_realtime(${lastPage})">${lastPage}</button>`;
        }
    
        // Next button
        paginationHtml += `<button onclick="display_realtime(${currentPage + 1})" ${currentPage === lastPage ? 'disabled' : ''}>›</button>`;
    
        // Add total count at the end (optional)
        paginationHtml += `<span>...${total}</span>`;
    
        paginationContainer.html(paginationHtml); // Append the pagination HTML
    }
    </script>
    
@endpush


@endsection


