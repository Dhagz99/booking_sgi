@extends('admin_base')
@section('title', 'ROOM PAGE')
@section('content')






<div class="p-10">

    <div class="flex justify-between">
    <button type="button"
        class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none mb-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
        onclick="showModal('addRoomType-modal')">
         ADD ROOM TYPE
    </button>

    <button type="button"
    class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none mb-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
    onclick="showModal('addCompany-modal')">
     ADD COMPANY
    </button>
    </div>
    
    
        <div class="relative overflow-x-auto shadow-xl bg-white sm:rounded-lg px-8 pt-8 flex gap-x-20">

            <div class="w-6/12">
            <table class="w-full text-md text-left rtl:text-right text-gray-600 dark:text-gray-400 shadow-md border border-slate-300 default_datatable_RoomRateList">
                <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="hidden edit_room_type_id" name="edit_room_type_id">ROOM ID</th>
                        <th scope="col" class="px-6 py-3">ROOM TYPE</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>  
                </tbody>
            </table>
            </div>



            <div class="w-6/12">
                <table class="w-full text-md text-left rtl:text-right text-gray-600 dark:text-gray-400 shadow-md border border-slate-300 default_datatable_CompanyList">
                    <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="hidden edit_room_type_id" name="edit_room_type_id">ROOM ID</th>
                            <th scope="col" class="px-6 py-3">COMPANY</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                    </tbody>
                </table>
            </div>


        </div>

    </div>

























{{-- MODALS --}}

<x-modal id="EditRoomRate-modal" title="Edit Room Type"
primaryButtonText="Update" primaryButtonAction="document.getElementById('EditRoomRate-form').submit()"
secondaryButtonAction="document.getElementById('EditRoomRate-modal').classList.add('hidden'); document.getElementById('EditRoomRate-modal').classList.remove('flex');"
secondaryButtonText="Cancel"
primaryButtonStyle="background-color: #2E68B4; color: white;">

    <form id="EditRoomRate-form" method="post" class="flex items-center justify-between" action="{{route('UpdateRoomRate_Modal')}}">

    @csrf

        <div class="hidden">
            <input type="text" id="edit_room_type_id" name="edit_room_type_id" autocomplete="off" class="edit_room_type_id block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="edit_room_type_id" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM TYPE</label>
        </div>

        <div class="relative z-0 w-6/12 mb-5 group mt-3">
            <input type="text" id="edit_room_type" name="edit_room_type" autocomplete="off" class="edit_room_type block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="edit_room_type" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM TYPE</label>
        </div>


    </form>

</x-modal>


{{-- ADD ROOM TYPE --}}
<x-modal id="addRoomType-modal" title="Add Room Type"
primaryButtonText="Save" primaryButtonAction="document.getElementById('addRoomType-form').submit()"
secondaryButtonAction="document.getElementById('addRoomType-modal').classList.add('hidden'); document.getElementById('addRoomType-modal').classList.remove('flex');"
secondaryButtonText="Cancel"
primaryButtonStyle="background-color: #2E68B4; color: white;">

    <form id="addRoomType-form" method="post" class="flex items-center justify-between" action="{{route('storeRoomType')}}">
        @csrf
        <div class="relative z-0 w-6/12 mb-5 group mt-3">
            <input type="text" id="add_room_type" name="add_room_type" autocomplete="off" class="add_room_type block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="add_room_type" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM TYPE</label>
        </div>
    </form>

</x-modal>
{{-- END OF ROOM TYPE --}}



{{-- add company --}}
<x-modal id="addCompany-modal" title="Add Company"
primaryButtonText="Save" primaryButtonAction="document.getElementById('addCompany-form').submit()"
secondaryButtonAction="document.getElementById('addCompany-modal').classList.add('hidden'); document.getElementById('addCompany-modal').classList.remove('flex');"
secondaryButtonText="Cancel"
primaryButtonStyle="background-color: #2E68B4; color: white;">

    <form id="addCompany-form" method="post" class="flex items-center justify-between" action="{{route('storeCompany')}}">
        @csrf
        <div class="relative z-0 w-6/12 mb-5 group mt-3">
            <input type="text" id="add_company" name="add_company" autocomplete="off" class="add_company block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="add_company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">COMPANY</label>
        </div>
    </form>

</x-modal>

{{-- edit company --}}

<x-modal id="EditCompany-modal" title="Edit Company"
    primaryButtonText="Update" primaryButtonAction="document.getElementById('EditCompany-form').submit()"
    secondaryButtonAction="document.getElementById('EditCompany-modal').classList.add('hidden'); document.getElementById('EditCompany-modal').classList.remove('flex');"
    secondaryButtonText="Cancel"
    primaryButtonStyle="background-color: #2E68B4; color: white;">

    <form id="EditCompany-form" method="post" class="flex items-center justify-between" action="{{route('UpdateCompany_Modal')}}">
    @csrf
        <div class="hidden">
            <input type="text" id="edit_company_id" name="edit_company_id" autocomplete="off" class="edit_company_id block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="edit_company_id" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ROOM TYPE</label>
        </div>
        <div class="relative z-0 w-6/12 mb-5 group mt-3">
            <input type="text" id="edit_company" name="edit_company" autocomplete="off" class="edit_company block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="edit_company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">COMPANY</label>
        </div>
    </form>
</x-modal>

{{-- END OF MODALS --}}




































@push('scripts')

<script src="{{asset('js/admin_datatable.js')}}"></script>

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
    $(document).ready(function() {
        var noTransactionTable = $('.default_datatable_RoomRateList').DataTable({
            searching: true,
            pageLength: 20,
            ajax: {
                url: '{{ route('get_room_typeList') }}',
                method: 'GET',
                dataSrc: function(json) {
                    return json;
                }
            },
            columns: [
                { data: 'room_type_id', type: 'num', visible: false }, 
                { data: 'room_type' },
 
                
                {
                data: null, 
                visible: true, 
                render: function(data, type, row) {
                    return `
                  
                        <a class="border cursor-pointer bg-blue-700 hover:bg-blue-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_edit_roomRate" data-id="${data.room_type_id}">
                            <img src="/svg/edit.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                        </a>

                        <a class="border cursor-pointer bg-red-700 hover:bg-red-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_delete_roomRate" data-room-rate="${data.room_type}" data-id="${data.room_type_id}">
                            <img src="/svg/delete.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                        </a>

                        


                    `;
                }
            },




            
            ],
            order: [[0, 'desc']],
        });
     
    });
</script>


<script>
    $(document).ready(function() {
        var noTransactionTable = $('.default_datatable_CompanyList').DataTable({
            searching: true,
            pageLength: 20,
            ajax: {
                url: '{{ route('get_CompanyList') }}',
                method: 'GET',
                dataSrc: function(json) {
                    return json;
                }
            },
            columns: [
                { data: 'company_id', type: 'num', visible: false }, 
                { data: 'company' },
 
                
                {
                data: null, 
                visible: true, 
                render: function(data, type, row) {
                    return `
                  
                        <a class="border cursor-pointer bg-blue-700 hover:bg-blue-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_edit_company" data-id="${data.company_id}">
                            <img src="/svg/edit.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                        </a>

                        <a class="border cursor-pointer bg-red-700 hover:bg-red-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_delete_company" data-company="${data.company}" data-id="${data.company_id}">
                            <img src="/svg/delete.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                        </a>

                        


                    `;
                }
            },




            
            ],
            order: [[0, 'desc']],
        });
     
    });
</script>

@endpush

@endsection


