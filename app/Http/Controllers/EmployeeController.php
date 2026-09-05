<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class EmployeeController extends Controller
{
    public function storeEmployee(Request $request) {
     
        $validatedData = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'nullable|string',
         
        ]);
        $store_data = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
        ];


        try {
            DB::table('employee')->insert($store_data);

            session()->flash('success', 'New Employee Saved Successfully!');
        
            return redirect()->route('homepage');

        } catch (\Exception $e) {
 
            return response()->json(['success' => false, 'message' => 'Could not save data. Please try again.']);
        }
    }




    public function employee_list(Request $request)
    {
  
        $search = $request->input('search');
        $perPage = 5; 
        $currentPage = $request->input('page', 1); 
        $searchTerms = preg_split('/\s+/', str_replace(',', '', $search));
    
        // Normalize search terms
        $normalizedSearchTerms = array_map(function ($term) {
            return iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $term);
        }, $searchTerms);
    
        $attendances = DB::table('employee')
            ->select('id', 'firstname', 'lastname')
            ->when($search, function ($query) use ($normalizedSearchTerms) {
                $query->where(function ($query) use ($normalizedSearchTerms) {
                    foreach ($normalizedSearchTerms as $term) {
                        $query->orWhere(function ($query) use ($term) {
                            $query->where('firstname', 'like', '%' . $term . '%')
                                  ->orWhere('lastname', 'like', '%' . $term . '%');
                               
                        });
                    }
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage); // Use pagination
        
        return response()->json([
            'attendances' => $attendances->items(), 
            'current_page' => $attendances->currentPage(),
            'last_page' => $attendances->lastPage(),
            'total' => $attendances->total(),
        ]);
    }







    public function EditModal(Request $request){
        $id2 = $request->input("data_table_modal_id");
        try {
        $datalist = DB::table('employee')->where('id', $id2)->first();

            $data = [
                "success" => true,
                "id" => $datalist->id,
                "firstname" => $datalist->firstname,
                "lastname" => $datalist->lastname,
            ];

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ["success" => false, "message" => "No records found"],
                404
            );
        }
    }
    

    public function updateTableModal(Request $request)
    {
        if ($request->isMethod("post")) {
            $id = $request->input("id_edit");
            $firstname = $request->input("edit_Cfirstname");
            $lastname = $request->input("edit_Clastname");
    
            try {
                DB::table('employee')
                    ->where('id', $id)
                    ->update(['firstname' => $firstname, 'lastname' => $lastname]);
                    session()->flash('success', 'Updated Successfully!');
                    return redirect()->route('homepage');
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
