@extends('admin_base')
@section('title', 'CUSTOMER PAGE')
@section('content')



<div class="p-10">
    <button type="button"
        class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none mb-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
        onclick="showModal('addCustomer-modal')">
         ADD CUSTOMER
    </button>
    
    
    <div class="relative overflow-x-auto shadow-xl bg-white sm:rounded-lg px-8 pt-8">
     
          
        <table class="w-full text-md text-left rtl:text-right text-gray-600 dark:text-gray-400 shadow-md default_datatable_customerList">
            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 hidden">ID</th>
                    <th scope="col" class="px-6 py-3">FIRSTNAME</th>
                    <th scope="col" class="px-6 py-3">LASTNAME</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
       
        </table>
    
     
    </div>
    
    </div>




















    {{-- MODALS --}}




{{-- ADD CUSTOMER --}}
<x-modal id="addCustomer-modal" title="Add Room Type"
primaryButtonText="Save" primaryButtonAction="document.getElementById('addCustomer-form').submit()"
secondaryButtonAction="document.getElementById('addCustomer-modal').classList.add('hidden'); document.getElementById('addCustomer-modal').classList.remove('flex');"
secondaryButtonText="Cancel"
primaryButtonStyle="background-color: #2E68B4; color: white;">

    <form id="addCustomer-form" method="post" class="flex items-center justify-evenly" action="{{route('storeCustomer')}}">
        @csrf
        <div class="relative z-0 group mt-3">
            <input type="text" id="customer_add_first_name" name="customer_add_first_name" autocomplete="off" class="customer_add_first_name block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="customer_add_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">FIRSTNAME</label>
        </div>

        <div class="relative z-0 group mt-3">
            <input type="text" id="customer_add_last_name" name="customer_add_last_name" autocomplete="off" class="customer_add_last_name block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="customer_add_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">LASTNAME</label>
        </div>
    </form>

</x-modal>

{{-- edit customer --}}
<x-modal id="EditCustomer-modal" title="Edit Room Type"
primaryButtonText="Update" primaryButtonAction="document.getElementById('EditCustomer-form').submit()"
secondaryButtonAction="document.getElementById('EditCustomer-modal').classList.add('hidden'); document.getElementById('EditCustomer-modal').classList.remove('flex');"
secondaryButtonText="Cancel"
primaryButtonStyle="background-color: #2E68B4; color: white;">

    <form id="EditCustomer-form" method="post" class="flex items-center justify-evenly gap-x-6" action="{{route('UpdateCustomer_Modal')}}">

    @csrf

        <div class="hidden">
            <input type="text" id="edit_customer_id" name="edit_customer_id" autocomplete="off" class="edit_customer_id block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="edit_customer_id" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ID</label>
        </div>

        <div class="relative z-0 w-6/12 mb-5 group mt-3">
            <input type="text" id="edit_customer_first_name" name="edit_customer_first_name" autocomplete="off" class="edit_customer_first_name block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="edit_customer_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">FIRSTNAME</label>
        </div>

        <div class="relative z-0 w-6/12 mb-5 group mt-3">
            <input type="text" id="edit_customer_last_name" name="edit_customer_last_name" autocomplete="off" class="edit_customer_last_name block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
            <label for="edit_customer_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">LASTNAME</label>
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
            var noTransactionTable = $('.default_datatable_customerList').DataTable({
                searching: true,
                pageLength: 15,
                ajax: {
                    url: '{{ route('get_CustomerList') }}',
                    method: 'GET',
                    dataSrc: function(json) {
                        return json;
                    }
                },
                columns: [
                    { data: 'customer_id', type: 'num', visible: false }, 
                    { data: 'first_name' },
                    { data: 'last_name' },
                    {
                    data: null, 
                    visible: true, 
                    render: function(data, type, row) {
                        return `
                      
                            <a class="border cursor-pointer bg-blue-700 hover:bg-blue-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_edit_customer" data-id="${data.customer_id}">
                                <img src="/svg/edit.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                            </a>
    
                            <a class="border cursor-pointer bg-red-700 hover:bg-red-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_delete_customer" data-id="${data.customer_id}">
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
