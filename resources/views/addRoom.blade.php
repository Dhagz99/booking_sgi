@extends('admin_base')
@section('title', 'Room Page')
@section('content')


@push('styles')
<link rel="stylesheet" href="{{asset('css/pagination.css')}}">
@endpush


<div class="p-10">
    <button type="button"
        class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none mb-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
        onclick="showModal('addRoom-modal')">
         ADD ROOM
    </button>
    
    
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
                        ROOM NUMBER
                    </th>

                    <th scope="col" class="px-6 py-3">
                        ROOM TYPE
                    </th>

                    <th scope="col" class="px-6 py-3">
                        STATUS   
                    </th>


                    <th scope="col" class="px-6 py-3">
                        RATE TYPE   
                    </th>
                    
                    
                    <th scope="col" class="px-6 py-3">
                        ADULT RATE   
                    </th>
                  

                    <th scope="col" class="px-6 py-3">
                        CHILDREN RATE  
                    </th>
                  
                    <th scope="col" class="px-6 py-3">
                        ROOM RATE  
                    </th>

                    <th scope="col" class="px-6 py-3">
                        OCCUPANTS  
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













    {{-- MODALS --}}




    <x-modalLarge id="addRoom-modal" title="Add Room"
    primaryButtonText="Save" primaryButtonAction="document.getElementById('addRoom-form').submit()"
    secondaryButtonAction="document.getElementById('addRoom-modal').classList.add('hidden'); document.getElementById('addRoom-modal').classList.remove('flex');"
    secondaryButtonText="Cancel"
    secondaryButtonClass="bg-slate-500 hover:bg-slate-700 px-4 py-2 rounded text-white">

    <form id="addRoom-form" method="post" class="p-5" action="{{route('storeRoom')}}">
        @csrf

        <div class="grid grid-cols-2 gap-x-8">

        <div class="flex-edit d-flex" style="display:none;">
            <input type="text" class="id_edit" name="id_edit" autocomplete="off">
        </div>

        <div class="relative z-0 mt-6 w-full group">
            <input type="number" id="room_number" name="room_number" autocomplete="off" class="room_number block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="room_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM NUMBER</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label for="room_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Room Type</label>
            <div class="relative">
                <select name="room_type_id" id="room_type" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                    <option value="" disabled selected>Choose a room type</option>
                    @foreach($roomTypes as $roomType)
                        <option value="{{ $roomType->room_type_id }}">{{ $roomType->room_type }}</option>
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


        <div class="relative z-0 w-full mb-5 group">
            <label for="room_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Room Status</label>
            <div class="relative">
                <select name="status_id" id="room_status" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                    <option value="" disabled selected>Choose a room status</option>
                    @foreach($roomStatus as $roomStatusList)
                        <option value="{{ $roomStatusList->status_id }}">{{ $roomStatusList->status }}</option>
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

        <div class="relative z-0 w-full mb-5 group">
            <label for="rate_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Rate Type</label>
            <div class="relative">
                <select name="rate_type" id="rate_type" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                    <option value="" disabled selected>Choose a rate type</option>
                        <option value="REGULAR_RATE">REGULAR RATE</option>
                        <option value="SINULOG_RATE">SINULOG RATE</option>
                </select>
     
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="relative z-0 mt-2 w-full group">
            <input type="number" id="room_rate" name="room_rate" autocomplete="off" class="room_rate block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="room_rate" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM RATE</label>
        </div>

        <div class="relative z-0 mt-2 w-full group">
            <input type="number" id="no_of_person" name="no_of_person" autocomplete="off" class="no_of_person block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="no_of_person" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NUMBER OF PERSON</label>
        </div>

        <div class="relative z-0 mt-4 w-full group">
            <input type="number" id="adult_rate" name="adult_rate" autocomplete="off" class="adult_rate block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="adult_rate" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ADULT RATE</label>
        </div>

        <div class="relative z-0 mt-4 w-full group">
            <input type="number" id="children_rate" name="children_rate" autocomplete="off" class="children_rate block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label for="children_rate" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">CHILDREN RATE</label>
        </div>


        </div>

    </form>

    </x-modalLarge>




    <x-modalLarge id="EditRoom-modal" title="Edit Room"
    primaryButtonText="Update" primaryButtonAction="document.getElementById('EditRoom-form').submit()"
    secondaryButtonAction="document.getElementById('EditRoom-modal').classList.add('hidden'); document.getElementById('EditRoom-modal').classList.remove('flex');"
    secondaryButtonText="Cancel"
    secondaryButtonClass="bg-slate-500 hover:bg-slate-700 px-4 py-2 rounded text-white">
    
    <form id="EditRoom-form" method="post" class="p-5" action="{{route('updateRoomModal')}}">
        @csrf

        <div class="flex hidden">
            <input type="text" class="id_edit_room" name="id_edit_room">
        </div>

        <div class="grid grid-cols-2 gap-x-8">

            <div class="relative z-0 w-full mb-5 group">
                <input type="number" id="edit_room_number" name="edit_room_number" autocomplete="off" class="edit_room_number block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
                <label for="edit_room_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM NUMBER</label>
            </div>
    
            <div class="relative z-0 w-full mb-5 group">
                <select id="edit_room_type" name="edit_room_type" class="edit_room_type block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option value="" disabled selected>Select Room Type</option>
                </select>
                <label for="edit_room_type" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM TYPE</label>
            </div>

            
            <div class="relative z-0 w-full mb-5 group">
                <select id="edit_room_status" name="edit_room_status" class="edit_room_status block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option value="" disabled selected>Select Room Status</option>
                </select>
                <label for="edit_room_status" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM STATUS</label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                    <select name="edit_rate_type" id="edit_rate_type" 
                        class=" edit_rate_type block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        >
                        <option value="" disabled selected>Choose a rate type</option>
                            <option value="REGULAR_RATE">REGULAR RATE</option>
                            <option value="SINULOG_RATE">SINULOG RATE</option>
                    </select>
                    <label for="edit_rate_type" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Select Rate Type</label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <input type="number" id="edit_adult_rate" name="edit_adult_rate"  autocomplete="off" class="edit_adult_rate block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
                <label for="edit_adult_rate" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ADULT RATE</label>
            </div>
    
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" id="edit_children_rate" name="edit_children_rate" autocomplete="off" class="edit_children_rate block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="edit_children_rate" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">CHILDREN RATE</label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <input type="number" id="edit_room_rate" name="edit_room_rate" autocomplete="off" class="edit_room_rate block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
                <label for="edit_room_rate" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM RATE</label>
            </div>
    

            <div class="relative z-0 w-full mb-5 group">
                <input type="number" id="edit_no_of_person" name="edit_no_of_person" autocomplete="off" class="edit_no_of_person block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="edit_no_of_person" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NO OF PERSON</label>
            </div>
    
    

            </div>

    </form>
</x-modalLarge>


    {{-- END MODALS --}}


@push('scripts')
<script src="{{ asset('js/search.js')}}"></script>
<script src="{{ asset('js/data_modal.js')}}"></script>

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
        title: 'error',
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

    function display_realtime(page = 1) {
        var search = $('.mySearch').val(); 
    
        $.ajax({
            url: '{{ route('room_list') }}',
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
                        row.append("<td class='px-6 py-1 hidden'>" + (attendance.id || '') + '</td>');
                        row.append("<td class='px-6 py-1'>" + (attendance.room_number || '') + '</td>');
                        row.append("<td class='px-6 py-1'>" + (attendance.room_type || '') + '</td>');
                        row.append("<td class='px-6 py-1'>" + (attendance.status || '') + '</td>');
                        row.append("<td class='px-6 py-1'>" + (attendance.rate_type || '') + '</td>');
                        row.append("<td class='px-6 py-1'>" + (attendance.adult_rate || '') + '</td>');
                        row.append("<td class='px-6 py-1'>" + (attendance.children_rate || '') + '</td>');
                        row.append("<td class='px-6 py-1'>" + (attendance.room_rate || '') + '</td>');
                        row.append("<td class='px-6 py-1'>" + (attendance.no_of_person || '') + '</td>');

                        var actionCell = `
                            <td class="px-6 py-1">
                             
                                <a class="border cursor-pointer bg-blue-700 hover:bg-blue-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center  btn_table_modal_edit" data-id="${attendance.id}">
                                    <img src="/svg/edit.svg" alt="edit" class="w-6 h-6 mx-auto inline text-slate-50">
                                </a>

                                  <a class="border cursor-pointer bg-red-700 hover:bg-red-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center  btn_table_modal_delete" data-id="${attendance.id}">
                                    <img src="/svg/delete.svg" alt="edit" class="w-6 h-6 mx-auto inline text-slate-50">
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


