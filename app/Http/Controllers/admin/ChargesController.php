<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ChargesController extends Controller
{
    public function charges_page(){
        $category_list = DB::table('charge_category')->select('category_id', 'category')->get();
        return view('adminView.charges', compact('category_list'));
    }

    public function storeCategory(Request $request) {
        $validatedData = $request->validate([
            'add_category_name' => 'required|string',

        ]);
        $store_data = [
            'category' => $validatedData['add_category_name'],
        ];
        try {
            DB::table('charge_category')->insert($store_data);
            session()->flash('success', 'New Category Saved Successfully!');
            return redirect()->route('charges_page');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Could not save data. Please try again.']);
        }
    }

    public function storeNewCharges(Request $request) {
        $validatedData = $request->validate([
            'charges_category_id' => 'required|string',
            'charges_description' => 'nullable|string',
            'charges_qty' => 'nullable|integer',
            'charges_price' => 'nullable|integer',
            'charges_rate_type' => 'nullable|string',
        ]);

        $store_data = [
            'category_id' => $validatedData['charges_category_id'],
            'charge_description' => isset($validatedData['charges_description']) && $validatedData['charges_description'] === 'none' ? null : ($validatedData['charges_description'] ?? null),
            'qty' => isset($validatedData['charges_qty']) && $validatedData['charges_qty'] === 'none' ? null : ($validatedData['charges_qty'] ?? null),
            'price' => $validatedData['charges_price'],
            'rate_type' => isset($validatedData['charges_rate_type']) && $validatedData['charges_rate_type'] === 'none' ? null : ($validatedData['charges_rate_type'] ?? null),
        ];

        try {
            DB::table('charge_type')->insert($store_data);
            return redirect()->route('charges_page')->with('success', 'Data Saved Successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error inserting datas: ' . $e->getMessage());
    
            // Redirect back with the error message
            return redirect()->back()->with('error', 'could not save' )->withInput();
        }
    }



    public function get_charge_type(){
        $pensioner_list = DB::table("charge_type")
                        ->leftJoin('charge_category', 'charge_type.category_id', '=', 'charge_category.category_id')
                        ->select(
                  'charge_type.id',
                           'charge_category.category',
                           'charge_type.charge_description',
                           'charge_type.qty',
                           'charge_type.price', 
                           'charge_type.rate_type',
                           ) 
                        ->orderBy("id", "desc") 
                        ->get();
                    
        return response()->json($pensioner_list);
    }








    public function storeDiscount(Request $request) {
        $validatedData = $request->validate([
            'fe_discount_description' => 'required|string',
            'fe_discount_num' => 'required|integer',
        ]);
        $store_data = [
            'discount_description' => $validatedData['fe_discount_description'],
            'discount_num' => $validatedData['fe_discount_num'],
        ];

        try {
            DB::table('charge_discount')->insert($store_data);
            session()->flash('success', 'New discount Saved Successfully!');
            return redirect()->route('charges_page');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Could not save data. Please try again.']);
        }
    }




    public function get_discount_list(){
        $discount_records = DB::table("charge_discount")
                        ->select(
                            'charge_discount_id',
                           'discount_description',
                           'discount_num'
                           ) 
                        ->orderBy("charge_discount_id", "desc") 
                        ->get();
                    
        return response()->json($discount_records);
    }


    



    public function EditChargeAdmin(Request $request){
        $id = $request->input("data_table_modal_id");
        $charges_category_list = DB::table('charge_category')->get();



        try {
        $datalist = DB::table('charge_type')->where('id', $id)->first();
    
            $data = [
                "success" => true,
                "id" => $datalist->id,
                "charge_description" => $datalist->charge_description,
                "qty" => $datalist->qty,
                "charges_category_list" => $charges_category_list,
                'category_id' => $datalist->category_id,
                'price' => $datalist->price,
                'rate_type' => $datalist->rate_type,
               
            ];
    
            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ["success" => false, "message" => "No records found"],
                404
            );
        }
    }

    public function UpdateChargeAdmin(Request $request)
    {
        if ($request->isMethod("post")) {
            $charge_id = $request->input("edit_charges_id");
            $category_id = $request->input("edit_charge_category");
            $edit_charges_description = $request->input("edit_charges_description");
            $edit_charges_price = $request->input("edit_charges_price");
            $edit_charge_rate_type = $request->input("edit_charge_rate_type");

    
            try {
                DB::table('charge_type')
                    ->where('id', $charge_id)
                    ->update(['category_id' => $category_id,
                                    'charge_description' => $edit_charges_description,
                                    'price' => $edit_charges_price,
                                    'rate_type' => $edit_charge_rate_type
                                ]);

                    session()->flash('success', 'Updated Successfully!');
                    return redirect()->route('charges_page');
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







    public function deleteChargeType(Request $request){
        $request->validate(rules: [
            'id' => 'required|string',
      
        ]);
        $deleted = DB::table(table: 'charge_type')
            ->where('id', $request->id)
            ->delete();
        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'No records found.']);
        }
    
    }




    // DISCOUNT ADMIN

    public function EditDiscountAdmin(Request $request){
        
        $id = $request->input("data_table_modal_id");
        try {
        $datalist = DB::table('charge_discount')->where('charge_discount_id', $id)->first();
    
            $data = [
                "success" => true,
                "charge_discount_id" => $datalist->charge_discount_id,
                "discount_description" => $datalist->discount_description,
                "discount_num" => $datalist->discount_num,
            ];
    
            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ["success" => false, "message" => "No records found"],
                404
            );
        }
    }


    public function UpdateDiscountAdmin(Request $request)
    {
        if ($request->isMethod("post")) {
            $edit_discount_id = $request->input("edit_discount_id");
            $edit_discount_description = $request->input("edit_discount_description");
            $edit_discount_num = $request->input("edit_discount_num");

    
            try {
                DB::table('charge_discount')
                    ->where('charge_discount_id', $edit_discount_id)
                    ->update(['discount_description' => $edit_discount_description,
                                    'discount_num' => $edit_discount_num,
                                 
                                ]);

                    session()->flash('success', 'Updated Successfully!');
                    return redirect()->route('charges_page');
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


    public function deleteAdminDiscount(Request $request){
        $request->validate(rules: [
            'charge_discount_id' => 'required|integer',
      
        ]);

        $deleted = DB::table(table: 'charge_discount')
            ->where('charge_discount_id', $request->charge_discount_id)
            ->delete();

        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'No records found.']);
        }
    
    }


}


