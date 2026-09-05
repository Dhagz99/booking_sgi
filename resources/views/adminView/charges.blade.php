@extends('admin_base')
@section('title', 'CHARGES PAGE')
@section('content')





<div class="p-12">

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" role="tablist">
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg active:text-blue-600 active:border-blue-500"
                    id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                    aria-selected="true">CHARGES</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 active:text-blue-600 active:border-blue-500"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">DISCOUNT</button>
            </li>
          
        </ul>
    </div>
    <div id="default-tab-content">



        <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
            aria-labelledby="profile-tab">



            <div class="p-10">

 
                <button type="button"
                    class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none mb-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    onclick="showModal('AddChargeRecord-modal')">
                    ADD RECORD
                </button>
    
              
            
            
            <div class="relative overflow-x-auto shadow-xl px-12 bg-white sm:rounded-lg px-8 pt-8">
            
                
                  
                <table id="chargesTable1" class="w-full text-md text-left rtl:text-right text-gray-600 dark:text-gray-400 shadow-md">
                    <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
    
                            <th scope="col" class="px-2 py-3">
                                ID
                            </th>
                         
                            <th scope="col" class="px-2 py-3">
                                CATEGORY
                            </th>
        
                            <th scope="col" class="px-2 py-3">
                                DESCRIPTION
                            </th>
        
                            <th scope="col" class="px-2 py-3">
                                QUANTITY
                            </th>
        
        
                            <th scope="col" class="px-2 py-3">
                                PRICE 
                            </th>
                            
                            
                            <th scope="col" class="px-2 py-3">
                                RATE TYPE   
                            </th>

                                      
                            <th scope="col" class="px-2 py-3">
                                ACTION   
                            </th>
                         
                        </tr>
                    </thead>
                    <tbody>
                       
                        
                        
                    </tbody>
               
                </table>
            
                 
            </div>
            
            </div>
    
       
        </div>








        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
            aria-labelledby="dashboard-tab">


            <div class="p-10">

 
                <button type="button"
                    class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none mb-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    onclick="showModal('AddDiscount-modal')">
                    ADD DISCOUNT
                </button>
               
                <div class="relative overflow-x-auto shadow-xl p-12 bg-white sm:rounded-lg">
                    <table id="chargesTable2" class="table-auto text-md text-left text-gray-600 shadow-md">
                        <thead class="text-sm text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 hidden">ID</th>
                                <th scope="col" class="px-6 py-3">DESCRIPTION</th>
                                <th scope="col" class="px-6 py-3">DISCOUNT % </th>
                                <th scope="col" class="px-6 py-3">ACTION</th>
                   
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated by DataTables -->
                        </tbody>
                    </table>
                </div>
                
                
            
            </div>
    
        </div>

     
    </div>
</div>



















  



        {{-- MODALS --}}

        <x-modal id="AddDiscount-modal" title="ADD DISCOUNT"
        primaryButtonText="Save" primaryButtonAction="document.getElementById('AddDiscount-form').submit()"
        secondaryButtonAction="document.getElementById('AddDiscount-modal').classList.add('hidden'); document.getElementById('AddDiscount-modal').classList.remove('flex');"
        secondaryButtonText="Cancel"
        primaryButtonStyle="background-color: #2E68B4; color: white;">

            <form id="AddDiscount-form" method="post" class="p-5" action="{{route('storeDiscount')}}">
                @csrf

                <div class="mb-5">
                    <label for="fe_discount_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DESCRIPTION</label>
                    <input type="text" name="fe_discount_description" id="fe_discount_description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="quantity..." required />
                </div>

                <div class="mb-5">
                    <label for="fe_discount_num" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DISCOUNT %</label>
                    <input type="number" name="fe_discount_num" id="fe_discount_num" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="quantity..." required />
                </div>

            </form>

        </x-modal>




        <x-modalLarge id="AddChargeRecord-modal" title="ADD NEW CHARGES"
        primaryButtonText="Save" primaryButtonAction="document.getElementById('AddChargeRecord-form').submit()"
        secondaryButtonAction="document.getElementById('AddChargeRecord-modal').classList.add('hidden'); document.getElementById('AddChargeRecord-modal').classList.remove('flex');"
        secondaryButtonText="Cancel"
        secondaryButtonClass="bg-slate-500 hover:bg-slate-700 px-4 py-2 rounded text-white">
        
            <form id="AddChargeRecord-form" method="post" class="p-5" action="{{route('storeNewCharges')}}">
                @csrf
        
                <div class="grid grid-cols-2 gap-x-8">
        
                    <div class="mb-5 grid">
                        <label for="charges_category_id" class="charges_category_id block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            SELECT CATEGORY
                        </label>
                        <div class="relative flex gap-x-3">
                            <select name="charges_category_id" id="charges_category_id" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-60 overflow-y-auto">
                                <option value="" disabled selected>Choose a CATEGORY</option>
                                @foreach($category_list as $category_lists)
                                    <option value="{{ $category_lists->category_id }}">{{ $category_lists->category }}</option>
                                @endforeach
                            </select>
                    
                     
                    
                        <button type="button" data-modal-show="nested-modal-addcategory" class="bg-blue-700 px-3 py-0 rounded-md shadow-lg hover:bg-blue-900 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-7">
                                <path fill-rule="evenodd" d="M19.5 21a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3h-5.379a.75.75 0 0 1-.53-.22L11.47 3.66A2.25 2.25 0 0 0 9.879 3H4.5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h15Zm-6.75-10.5a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V10.5Z" clip-rule="evenodd" />
                            </svg>
                        </button>

                    </div>
                    </div>
                    
        
        
                    <div class="mb-5">
                        <label for="charges_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DESCRIPTION</label>
                        <input type="text" name="charges_description" id="charges_description" class="charges_description bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="description..."/>
                    </div>
        
                    <div class="mb-5">
                        <label for="charges_qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">QUANTITY</label>
                        <input type="number" name="charges_qty" id="charges_qty" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="quantity..." />
                    </div>
        
                    <div class="mb-5">
                        <label for="charges_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PRICE</label>
                        <input type="number" name="charges_price" id="charges_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="price..." />
                    </div>
        
            

                    <div class="mb-5">
                        <label for="charges_rate_type" class="charges_rate_type block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            SELECT RATE TYPE
                        </label>
                        <div class="relative">
                            <select name="charges_rate_type" id="charges_rate_type" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-10 appearance-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 max-h-60 overflow-y-auto">
                                <option value="" disabled selected>Choose rate type</option>
                                <option value="SINGLE">SINGLE</option>
                                <option value="DOUBLE">DOUBLE</option>
                                <option value="none">None</option> 
                            </select>
                            <!-- Custom Icon -->
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
        
             
                </div>
            </form>



            <div id="nested-modal-addcategory" class="z-0 fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
                <div class="bg-white py-5 rounded-lg shadow-lg w-1/3">
                    <div class="py-2 px-3 text-center mb-6 font-medium text-blue-800"><h2>ADD NEW CATEGORY</h2></div>
              
                    <form action="{{ route('storeCategory')}}" method="post">
                        @csrf
                        <div class="mb-4 px-5">
                            <label for="add_category_name" class="block text-sm font-medium text-gray-700 mb-2">CATEGORY</label>
                            <input type="text" id="add_category_name" name="add_category_name" class="p-2 border rounded-lg w-full" placeholder="Enter category...">
                        </div>
                        
                       
                        <div class="flex justify-end gap-4 w-full">
                            <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
                            <button type="button" data-modal-hide="nested-modal-addcategory" class="mr-4 mt-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Close</button>
                        </div>
        
                    </form>

                </div>
            </div>
        


        </x-modalLarge>
        






        <!-- EDIT CHARGES admin -->
        <x-modalLarge id="EditChargeAdmin-modal" title="EDIT CHARGES"
        primaryButtonText="Update" primaryButtonAction="document.getElementById('EditChargeAdmin-form').submit()"
        secondaryButtonAction="document.getElementById('EditChargeAdmin-modal').classList.add('hidden'); document.getElementById('EditChargeAdmin-modal').classList.remove('flex');"
        secondaryButtonText="Cancel"
        secondaryButtonClass="bg-slate-500 hover:bg-slate-700 px-4 py-2 rounded text-white">

        <form id="EditChargeAdmin-form" method="post" class="flex items-center justify-between" action="{{route('UpdateChargeAdmin')}}">

            @csrf

            <div class="grid grid-cols-2 gap-x-6 gap-y-4 w-full">

                <div class="hidden">
                    <input type="text" id="edit_charges_id" name="edit_charges_id" autocomplete="off" class="edit_charges_id block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
                    <label for="edit_charges_id" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ID</label>
                </div>

                
                <div class="flex flex-col">
                    <label for="edit_charge_category" class="text-gray-500 text-sm mb-1">CATEGORY</label>
                    <select id="edit_charge_category" name="edit_charge_category" class="edit_charge_category px-2 py-1 rounded">
                        <option value="" disabled selected>Select Category</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="edit_charges_description" class="text-sm text-gray-500 mb-1">CHARGE DESCRIPTION</label>
                    <input type="text" id="edit_charges_description" name="edit_charges_description" class="edit_charges_description px-4 py-1 rounded bg-slate-100" placeholder=" "/>
      
                </div>

                <div class="flex flex-col">
                    <label for="edit_charges_price" class="text-sm text-gray-500 mb-1">PRICE</label>
                    <input type="text" id="edit_charges_price" name="edit_charges_price" class="edit_charges_price px-4 py-1 rounded bg-slate-100" placeholder=" "/>
      
                </div>

                           
                <div class="flex flex-col">
                    <label for="edit_charge_rate_type" class="text-gray-500 text-sm mb-1">RATE TYPE</label>
                    <select id="edit_charge_rate_type" name="edit_charge_rate_type" class="edit_charge_rate_type px-2 py-1 rounded">
                        <option value="" disabled selected>Select Rate Type</option>
                        <option value="SINGLE" >Single</option>
                        <option value="DOUBLE" >Double</option>
                    </select>
                </div>


            </div>


            </form>


        </x-modalLarge>

    
    
    
<!-- EDIT DISCOUNT -->
      <x-modalLarge id="EditDiscountAdmin-modal" title="EDIT DISCOUNT"
        primaryButtonText="Update" primaryButtonAction="document.getElementById('EditDiscountAdmin-form').submit()"
        secondaryButtonAction="document.getElementById('EditDiscountAdmin-modal').classList.add('hidden'); document.getElementById('EditDiscountAdmin-modal').classList.remove('flex');"
        secondaryButtonText="Cancel"
        secondaryButtonClass="bg-slate-500 hover:bg-slate-700 px-4 py-2 rounded text-white">

        <form id="EditDiscountAdmin-form" method="post" class="flex items-center justify-between" action="{{route('UpdateDiscountAdmin')}}">

            @csrf

            <div class="grid grid-cols-2 gap-x-6 gap-y-4 w-full">

                <div class="hidden">
                    <input type="text" id="edit_discount_id" name="edit_discount_id" autocomplete="off" class="edit_discount_id block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
                    <label for="edit_discount_id" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">ID</label>
                </div>


                <div class="flex flex-col">
                    <label for="edit_discount_description" class="text-sm text-gray-500 mb-1">DISCOUNT DESCRIPTION</label>
                    <input type="text" id="edit_discount_description" name="edit_discount_description" class="edit_discount_description px-4 py-1 rounded bg-slate-100" placeholder=" "/>
                </div>

            
                <div class="flex flex-col">
                    <label for="edit_discount_num" class="text-sm text-gray-500 mb-1">DISCOUNT %</label>
                    <input type="number" id="edit_discount_num" name="edit_discount_num" class="edit_discount_num px-4 py-1 rounded bg-slate-100" placeholder=" "/>
                </div>

            </div>
            </form>
        </x-modalLarge>




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
    document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll("[role='tab']");
        const tabPanels = document.querySelectorAll("[role='tabpanel']");

        tabs.forEach(tab => {
            tab.addEventListener("click", function () {
                // Remove active state from all tabs and hide all panels
                tabs.forEach(t => {
                    t.classList.remove("text-blue-600", "border-blue-500");
                    t.classList.add("border-transparent");
                });
                tabPanels.forEach(panel => panel.classList.add("hidden"));

                // Set active state on the clicked tab and display the associated panel
                this.classList.remove("border-transparent");
                this.classList.add("text-blue-600", "border-blue-500");
                const targetPanel = document.querySelector(this.dataset.tabsTarget);
                targetPanel.classList.remove("hidden");
            });
        });
    });
</script>




<script>
    $(document).ready(function() {
        var noTransactionTable = $('#chargesTable1').DataTable({
            searching: true,
            pageLength: 6,
            ajax: {
                url: '{{ route('get_charge_type') }}',
                method: 'GET',
                dataSrc: function(json) {
                    return json;
                }
            },
            columns: [
                { data: 'id', type: 'num', visible: false }, 
                { data: 'category' },
                { data: 'charge_description' },
                { data: 'qty' },
                { data: 'price' },
                { data: 'rate_type' },

                     
                {
                data: null, 
                visible: true, 
                render: function(data, type, row) {
                    return `
                  
                        <a class="border cursor-pointer bg-blue-700 hover:bg-blue-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_edit_charges_admin" data-id="${data.id}">
                            <img src="/svg/edit.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                        </a>

                        <a class="border cursor-pointer bg-red-700 hover:bg-red-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_delete_charges_admin" data-id="${data.id}">
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

        var noTransactionTable = $('#chargesTable2').DataTable({
            searching: true,
            pageLength: 6,
            ajax: {
                url: '{{ route('get_discount_list') }}',
                method: 'GET',
                dataSrc: function(json) {
                    return json;
                }
            },
            columns: [
                { data: 'charge_discount_id', type: 'num', visible: false }, 
                { data: 'discount_description' },
                { data: 'discount_num' },
                {
                data: null, 
                visible: true, 
                render: function(data, type, row) {
                    return `
                  
                        <a class="border cursor-pointer bg-blue-700 hover:bg-blue-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_edit_discount_admin" data-id="${data.charge_discount_id}">
                            <img src="/svg/edit.svg" alt="check" class="w-6 h-6 mx-auto inline text-slate-50">
                        </a>

                        <a class="border cursor-pointer bg-red-700 hover:bg-red-600 text-slate-50 px-3 py-2 rounded shadow-2xl inline-block text-center btn_table_delete_discount_admin" data-id="${data.charge_discount_id}">
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


