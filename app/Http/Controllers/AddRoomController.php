<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;


class AddRoomController extends Controller
{
    public function AddNewRoomPage(){

        if (Auth::check()) {
        $roomTypes = DB::table('room_type')->select('room_type_id', 'room_type')->get();
        $roomStatus = DB::table('room_status')->select('status_id', 'status')->get();
        return view('addRoom', compact('roomTypes', 'roomStatus'));

        }

        else{
            return redirect('/')->with('error', 'Your session has expired. Please log in again.'); 
        }
    }

    public function storeRoom(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'room_number' => 'required|integer',
            'room_type_id' => 'required|exists:room_type,room_type_id',
            'status_id' => 'required|exists:room_status,status_id',
            'room_rate' => 'required|integer',
            'no_of_person' => 'required|integer',
            'adult_rate' => 'required|integer',
            'children_rate' => 'required|integer',
            'rate_type' => 'required|string',
        ]);
    
        // Prepare data for insertion
        $store_data = [
            'room_number' => $validatedData['room_number'],
            'room_type_id' => $validatedData['room_type_id'],
            'status_id' => $validatedData['status_id'],
            'room_rate' => $validatedData['room_rate'],
            'no_of_person' => $validatedData['no_of_person'],
            'adult_rate' => $validatedData['adult_rate'],
            'children_rate' => $validatedData['children_rate'],
            'rate_type' => $validatedData['rate_type']
        ];
    
        try {
            // Insert data into the database
            DB::table('room')->insert($store_data);
    
            // Flash success message and redirect
      
            return redirect()->route('AddNewRoomPage')->with('success', 'New Room Saved Successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error inserting room data: ' . $e->getMessage());
    
            // Redirect back with the error message
            return redirect()->back()->with('error', 'Could not save data. Please try again.')->withInput();
        }
    }






    public function room_list(Request $request){
        $search = $request->input('search');
        $perPage = 20;
        $currentPage = $request->input('page', 1);
        $searchTerms = preg_split('/\s+/', str_replace(',', '', $search));
    
        $normalizedSearchTerms = array_map(function ($term) {
            return iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $term);
        }, $searchTerms);
    
        $attendances = DB::table('room')
            ->join('room_type', 'room.room_type_id', '=', 'room_type.room_type_id')
            ->join('room_status','room.status_id', '=', 'room_status.status_id')
            ->select(
                'room.id',
                'room.room_number',
                'room.rate_type',
                'room_type.room_type',
                'room_status.status',
                'room.rate_type',
                'room.adult_rate',
                'room.children_rate',
                'room.room_rate',
                'room.no_of_person',
            )
            ->when($search, function ($query) use ($normalizedSearchTerms) {
                $query->where(function ($query) use ($normalizedSearchTerms) {
                    foreach ($normalizedSearchTerms as $term) {
                        $query->orWhere(function ($query) use ($term) {
                            $query->where('room.room_number', 'like', '%' . $term . '%')
                                  ->orWhere('room.rate_type', 'like', '%' . $term . '%')
                                  ->orWhere('room_type.room_type', 'like', '%' . $term . '%')
                                  ->orWhere('room.rate_type', 'like', '%' . $term . '%')
                                  ->orWhere('room_status.status', 'like', '%' . $term . '%');
                        });
                    }
                });
            })
            ->orderBy('room.id', 'desc')
            ->paginate($perPage);
    
        return response()->json([
            'attendances' => $attendances->items(),
            'current_page' => $attendances->currentPage(),
            'last_page' => $attendances->lastPage(),
            'total' => $attendances->total(),
        ]);
    }

    public function EditRoom(Request $request){
        $id2 = $request->input('data_table_modal_id');
        try {
            $datalist = DB::table('room')->where('id', $id2)->first();
            $roomTypes = DB::table('room_type')->get();
            $statuses = DB::table('room_status')->get();
    
            $data = [
                'success' => true,
                'id' => $datalist->id,
                'room_number' => $datalist->room_number,
                'room_type_id' => $datalist->room_type_id,
                'status_id' => $datalist->status_id,
                'room_types' => $roomTypes,
                'rate_type'=> $datalist->rate_type,
                'adult_rate' => $datalist->adult_rate,
                'children_rate' => $datalist->children_rate,
                'room_rate' => $datalist->room_rate,
                'no_of_person' => $datalist->no_of_person,
                'statuses' => $statuses,
            ];
            

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ['success' => false, 'message' => 'No records found'],
                404
            );
        }
    }
    
    





    public function updateRoomModal(Request $request)
    {
        if ($request->isMethod("post")) {
            $id = $request->input("id_edit_room");
            $room_number = $request->input("edit_room_number");
            $room_type_id = $request->input("edit_room_type");
            $status_id = $request->input("edit_room_status");
            $rate_type = $request->input('edit_rate_type');
            $adult_rate = $request->input('edit_adult_rate');
            $children_rate = $request->input('edit_children_rate');
            $room_rate = $request->input('edit_room_rate');
            $no_of_person = $request->input('edit_no_of_person');
    
            try {
                DB::table('room')
                    ->where('id', $id)
                    ->update(['room_number' => $room_number,
                     'room_type_id' => $room_type_id,
                     'status_id' => $status_id,
                     'rate_type' => $rate_type,
                     'adult_rate' => $adult_rate,
                     'children_rate' => $children_rate,
                     'room_rate' => $room_rate,
                     'no_of_person' => $no_of_person,
                     
                    ]);
                    session()->flash('success', 'Updated Successfully!');
                    return redirect()->route('AddNewRoomPage');
            } catch (\Exception $e) {
                return response()->json(
                    ["success" => false, "error_message" => $e->getMessage()],
                    500
                );
            }
        }
    
        return response()->json(
            ["success" => false, "error_message" => "Invalid request method"],
            405
        );
    }
    
    



    public function deleteRoom(Request $request){
     
        $request->validate([
            'id' => 'required|string',
      
        ]);


        $deleted = DB::table('room')
            ->where('id', $request->id)
            ->delete();

        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'No records found.']);
        }

    }
















    // ROOM TYPE

    public function RoomTypePage(){

        return view('adminView.roomRate');
    }


    public function get_room_typeList(){
   

        $reservationList = DB::table("room_type")
                      
                        ->select(
                  'room_type_id',
                           'room_type',
                           ) 


                        ->orderBy("room_type_id", "desc") 
                        ->get();
                    
        return response()->json($reservationList);
    }




    public function EditRoomRate_Modal(Request $request){
        $id2 = $request->input("data_table_modal_id");
        try {
        $datalist = DB::table('room_type')->where('room_type_id', $id2)->first();

            $data = [
                "success" => true,
                "room_type_id" => $datalist->room_type_id,
                "room_type" => $datalist->room_type,
       
            ];

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ["success" => false, "message" => "No records found"],
                404
            );
        }
    }

    public function UpdateRoomRate_Modal(Request $request)
    {
        if ($request->isMethod("post")) {
            $room_type_id = $request->input("edit_room_type_id");
            $room_type = $request->input("edit_room_type");

    
            try {
                DB::table('room_type')
                    ->where('room_type_id', $room_type_id)
                    ->update(['room_type' => $room_type]);
                    session()->flash('success', 'Updated Successfully!');
                    return redirect()->route('RoomTypePage');
            } catch (\Exception $e) {
                return response()->json(
                    ["success" => false, "error_message" => $e->getMessage()],
                    500
                );
            }
        }
    
        return response()->json(
            ["success" => false, "error_message" => "Invalid request method"],
            405
        );
    }



    public function storeRoomType(Request $request)
    {

        $validatedData = $request->validate([
            'add_room_type' => 'required|string',
   
        ]);
    

        $store_data = [
            'room_type' => $validatedData['add_room_type'],
 
        ];
    
        try {

            DB::table('room_type')->insert($store_data);
            return redirect()->route('RoomTypePage')->with('success', 'New Room Type Saved Successfully!');
        } catch (\Exception $e) {

            \Log::error('Error inserting room data: ' . $e->getMessage());
    

            return redirect()->back()->with('error', 'Could not save data. Please try again.')->withInput();
        }
    }

    
    public function deleteRoomType(Request $request){
     
        $request->validate([
            'folio_number' => 'required|string',
      
        ]);


        $deleted = DB::table('room_type')
            ->where('room_type_id', $request->folio_number)
            ->delete();

        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'No records found.']);
        }

    }




    














// COMPANY ADMIN

public function get_CompanyList(){

    $company_list = DB::table("company")
                    ->select('company_id','company') 
                    ->orderBy("company_id", "desc") 
                    ->get();
                
    return response()->json($company_list);
}

public function storeCompany(Request $request){
    $validatedData = $request->validate([
        'add_company' => 'required|string',
    ]);

    $store_data = [
        'company' => $validatedData['add_company'],
    ];

    try {
        DB::table('company')->insert($store_data);
        return redirect()->route('RoomTypePage')->with('success', 'New Company Saved Successfully!');
    } catch (\Exception $e) {
        \Log::error('Error inserting company data: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Could not save data. Please try again.')->withInput();
    }
}

public function deleteCompany(Request $request){
     
    $request->validate([
        'id' => 'required|string',
  
    ]);

    $deleted = DB::table('company')
        ->where('company_id', $request->id)
        ->delete();

    if ($deleted) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'No records found.']);
    }

}

public function EditCompany_Modal(Request $request){
    $id = $request->input("data_table_modal_id");

    try {
    $datalist = DB::table('company')->where('company_id', $id)->first();

        $data = [
            "success" => true,
            "company_id" => $datalist->company_id,
            "company" => $datalist->company,
   
        ];

        return response()->json($data);
    } catch (ModelNotFoundException $e) {
        return response()->json(
            ["success" => false, "message" => "No records found"],
            404
        );
    }
}

public function UpdateCompany_Modal(Request $request)
{
    if ($request->isMethod("post")) {
        $company_id = $request->input("edit_company_id");
        $company = $request->input("edit_company");


        try {
            DB::table('company')
                ->where('company_id', $company_id)
                ->update(['company' => $company]);
                session()->flash('success', 'Updated Successfully!');
                return redirect()->route('RoomTypePage');
        } catch (\Exception $e) {
            return response()->json(
                ["success" => false, "error_message" => $e->getMessage()],
                500
            );
        }
    }

    return response()->json(
        ["success" => false, "error_message" => "Invalid request method"],
        405
    );
}





















// CUSTOMERS
public function CustomerPage(){

    return view('adminView.customer');
}

public function get_CustomerList(){

    $customer_list = DB::table("customers")
                    ->select('customer_id','first_name','last_name') 
                    ->orderBy("customer_id", "desc") 
                    ->get();
                
    return response()->json($customer_list);
}


public function storeCustomer(Request $request){
    $validatedData = $request->validate([
        'customer_add_first_name' => 'nullable|string',
        'customer_add_last_name' => 'nullable|string',
    ]);

    $store_data = [
        'first_name' => $validatedData['customer_add_first_name'],
        'last_name' => $validatedData['customer_add_last_name'],
    ];

    try {
        DB::table('customers')->insert($store_data);
        return redirect()->route('CustomerPage')->with('success', 'New Customer Saved Successfully!');
    } catch (\Exception $e) {
        \Log::error('Error inserting company data: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Could not save data. Please try again.')->withInput();
    }
}


public function deleteCustomer(Request $request){
    $request->validate(rules: [
        'id' => 'required|string',
  
    ]);
    $deleted = DB::table(table: 'customers')
        ->where('customer_id', $request->id)
        ->delete();
    if ($deleted) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'No records found.']);
    }

}
public function EditCustomer_Modal(Request $request){
    $id = $request->input("data_table_modal_id");

    try {
    $datalist = DB::table('customers')->where('customer_id', $id)->first();

        $data = [
            "success" => true,
            "customer_id" => $datalist->customer_id,
            "first_name" => $datalist->first_name,
            "last_name" => $datalist->last_name,
        ];

        return response()->json($data);
    } catch (ModelNotFoundException $e) {
        return response()->json(
            ["success" => false, "message" => "No records found"],
            404
        );
    }
}

public function UpdateCustomer_Modal(Request $request)
{
    if ($request->isMethod("post")) {
        $customer_id = $request->input("edit_customer_id");
        $first_name = $request->input("edit_customer_first_name");
        $last_name = $request->input("edit_customer_last_name");

        try {
            DB::table('customers')
                ->where('customer_id', $customer_id)
                ->update(['first_name' => $first_name,
                                  'last_name' => $last_name]);

                session()->flash('success', 'Updated Successfully!');
                return redirect()->route('CustomerPage');
        } catch (\Exception $e) {
            return response()->json(
                ["success" => false, "error_message" => $e->getMessage()],
                500
            );
        }
    }

    return response()->json(
        ["success" => false, "error_message" => "Invalid request method"],
        405
    );
}

}
