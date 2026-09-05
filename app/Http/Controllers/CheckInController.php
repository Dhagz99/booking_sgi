<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Ensure Session is imported
use Carbon\Carbon;


class CheckInController extends Controller
{
    public function CheckInPage()
    {

        if (Auth::check()) {


        $country_list = DB::table("country")
            ->select("country_id", "country")
            ->get();

        $company_list = DB::table("company")
            ->select("company_id", "company")
            ->get();

        $discount_list = DB::table("charge_discount")
            ->select(
                "charge_discount_id",
                "discount_description",
                "discount_num"
            )
            ->get();

        $room_num = DB::table("room")
            // ->where('status_id', '!=',2)
            ->select(
                "id",
                "room_number",
                "room_rate",
                "adult_rate",
                "children_rate",
                "rate_type",
                "no_of_person",
     
            )
            ->get();

        $business_source_list = DB::table("business_source")
            ->select("business_source_id", "business_source")
            ->get();

        $charges_list = DB::table("charge_type")
            ->select(
                "charge_type.category_id",
                "charge_type.charge_description",
                "charge_type.qty",
                "charge_type.price",
                "charge_type.rate_type",
                "charge_category.category"
            )
            ->leftJoin(
                "charge_category",
                "charge_type.category_id",
                "=",
                "charge_category.category_id"
            )
            ->get();
        return view(
            "checkin",
            compact(
                "country_list",
                "company_list",
                "room_num",
                "business_source_list",
                "charges_list",
                "discount_list"
            )
        );

        }

        else{
            return redirect('/')->with('error', 'Your session has expired. Please log in again.'); 
        }
    }

    public function storeTransaction(Request $request)
    {
        function generatePrimaryKey()
        {
      
            // Get the current year in two-digit format
            $year = date("y"); // e.g., '24' for 2024

            // Retrieve the last record globally, irrespective of the year
            $lastKey = DB::table("transactions")
                ->orderBy("folio_number", "desc")
                ->value("folio_number");

            if ($lastKey) {
                // Extract the numeric portion of the last key (excluding the year prefix)
                $lastNumber = (int) substr($lastKey, 2); // Extract digits after the first two characters (year)
                $newNumber = str_pad($lastNumber + 1, 5, "0", STR_PAD_LEFT); // Keep 5 digits
            } else {
                // Start with '00001' if no records exist
                $newNumber = "00001";
            }

            // Return the new `folio_number` with the current year
            return $year . $newNumber;
        }

        $primaryKey = generatePrimaryKey();
        $login_name = Auth::user()->name; 

        $validatedData = $request->validate([
            "transac_firstname" => "required|string",
            "transac_lastname" => "nullable|string",
            "customer_id" => "nullable|exists:customers,customer_id",
            "transac_country" => "nullable|string",
            "transac_company" => "nullable|string",
            "transac_address" => "nullable|string",
            "transac_date_in" => "required|date",
            "transac_room_number" => "nullable|string",
            "transac_business_source" => "nullable|string",
            "transac_no_of_days" => "nullable|integer",
            "transac_no_of_adults" => "nullable|integer",
            "transac_no_of_children" => "nullable|integer",
            "transac_id_type" => "nullable|string",
            "transac_id_number" => "nullable|string",
            "transac_vec_model" => "nullable|string",
            "transac_plate_no" => "nullable|string",
            "transac_rate_period" => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            "transac_date_out" => "nullable|date",
            "transac_total_charges" => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            "transac_other_charges" => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            "transac_sub_total" => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            "transac_discount" => "nullable|integer",
            "transac_total" => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            "transac_amount_paid" => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            "transac_balance" => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            "transac_bank" => "nullable|string",
            "transac_card_type" => "nullable|string",
            "transac_reference_num" => "nullable|string",
            "transac_discount_amount" => "nullable|numeric|regex:/^\d+(\.\d{1,2})?$/",
            "transac_no_of_sc_pwd" => "nullable|integer",
            "transac_discount_bod_type" => "nullable|integer",
            "transac_no_of_sc_pwd_bod" =>  "nullable|integer",
            "transac_reference_num_receipt" => "nullable|string",

    
        ]);

        try {
            $dateIn = Carbon::parse($validatedData["transac_date_in"]);
            $dateOut = $validatedData["transac_date_out"] ? Carbon::parse($validatedData["transac_date_out"]) : null;
        
            if ($dateIn->year < 1900 || $dateIn->year > 2200) {
                return redirect()
                    ->route("CheckInPage")
                    ->with("error", "Invalid date for DATE IN");
            }
    
            if ($dateOut && ($dateOut->year < 1900 || $dateOut->year > 2200)) {
                return redirect()
                    ->route("CheckInPage")
                    ->with("error", "Invalid date for DATE OUT"); 
            }

        } catch (\Exception $e) {
            return redirect()
                ->route("CheckInPage")
                ->with("error", "Invalid date for date in or date out"); 
        }

        $store_data = [
            "folio_number"        => $primaryKey,
            "first_name"          => $validatedData["transac_firstname"],
            "last_name"           => $validatedData["transac_lastname"],
            "country_id"          => $validatedData["transac_country"],
            "company_id"          => isset($validatedData["transac_company"]) && $validatedData["transac_company"] === "none" ? null : $validatedData["transac_company"] ?? null,
            "customer_id"         => $request->customer_id,
            "address"             => isset($validatedData["transac_address"]) && $validatedData["transac_address"] === "none" ? null : $validatedData["transac_address"] ?? null,
            "date_in"             => $dateIn,
            "room_id"             => $validatedData["transac_room_number"],
            "no_of_days"          => $validatedData["transac_no_of_days"],
            "no_of_adults"        => isset($validatedData["transac_no_of_adults"]) && $validatedData["transac_no_of_adults"] === "none" ? null : $validatedData["transac_no_of_adults"] ?? null,
            "no_of_children"      => isset($validatedData["transac_no_of_children"]) && $validatedData["transac_no_of_children"] === "none" ? null : $validatedData["transac_no_of_children"] ?? null,
            "business_source_id"  => $validatedData["transac_business_source"],
            "id_type"             => isset($validatedData["transac_id_type"]) && $validatedData["transac_id_type"] === "none" ? null : $validatedData["transac_id_type"] ?? null,
            "id_number"           => isset($validatedData["transac_id_number"]) && $validatedData["transac_id_number"] === "none" ? null : $validatedData["transac_id_number"] ?? null,
            "vehicle_model"       => isset($validatedData["transac_vec_model"]) && $validatedData["transac_vec_model"] === "none" ? null : $validatedData["transac_vec_model"] ?? null,
            "vehicle_plate_no"    => isset($validatedData["transac_plate_no"]) && $validatedData["transac_plate_no"] === "none" ? null : $validatedData["transac_plate_no"] ?? null,
            "rate_period"         => $validatedData["transac_rate_period"],
            "date_out"            => $dateOut,
            "total_charges"       => $validatedData["transac_total_charges"],
            "other_charges"       => isset($validatedData["transac_other_charges"]) && $validatedData["transac_other_charges"] === "none" ? null : $validatedData["transac_other_charges"] ?? null,
            "sub_total"           => $validatedData["transac_sub_total"],
            "discount"            => $validatedData["transac_discount"],
            "total"               => $validatedData["transac_total"],
            "amount_paid"         => isset($validatedData["transac_amount_paid"]) && $validatedData["transac_amount_paid"] === "none" ? null : $validatedData["transac_amount_paid"] ?? null,
            "balance"             => $validatedData["transac_balance"],
            "bank"                => isset($validatedData["transac_bank"]) && $validatedData["transac_bank"] === "none" ? null : $validatedData["transac_bank"] ?? null,
            "card_type"           => isset($validatedData["transac_card_type"]) && $validatedData["transac_card_type"] === "none" ? null : $validatedData["transac_card_type"] ?? null,
            "reference_num"       => isset($validatedData["transac_reference_num"]) && $validatedData["transac_reference_num"] === "none" ? null : $validatedData["transac_reference_num"] ?? null,
            "created_at"          => now(),
            "time_checkin"        => now(),
            "added_by"            => $login_name,
            "client_current_status" => "CHECKED_IN",
            "amount_discounted"     => isset($validatedData["transac_discount_amount"]) && $validatedData["transac_discount_amount"] === "none" ? null : $validatedData["transac_discount_amount"] ?? null,
            "no_of_sc_pwd"       => isset($validatedData["transac_no_of_sc_pwd"]) && $validatedData["transac_no_of_sc_pwd"] === "none" ? null : $validatedData["transac_no_of_sc_pwd"] ?? null,
            "bod_no_of_sc_pwd"       => isset($validatedData["transac_no_of_sc_pwd_bod"]) && $validatedData["transac_no_of_sc_pwd_bod"] === "none" ? null : $validatedData["transac_no_of_sc_pwd_bod"] ?? null,
            "bod_discount_type"       => isset($validatedData["transac_discount_bod_type"]) && $validatedData["transac_discount_bod_type"] === "none" ? null : $validatedData["transac_discount_bod_type"] ?? null,
            "reference_num_receipt" =>  isset($validatedData["transac_reference_num_receipt"]) && $validatedData["transac_reference_num_receipt"] === "none" ? null : $validatedData["transac_reference_num_receipt"] ?? null,
        ];

        if ($validatedData["transac_business_source"] == 2) {
            $store_data["client_current_status"] = "RESERVE";
            $store_data["time_checkin"] = null;
        }

        try {
            DB::beginTransaction();
            DB::table("transactions")->insert($store_data);

            if ($store_data["business_source_id"] == 2) {
                DB::table("room")
                    ->where("id", $store_data["room_id"])
                    ->update([
                        "updated_at" => now(),
                        "transac_status" => "PENDING_RESERVE",
                    ]);
            }

            else {
                DB::table("room")
                ->where("id", $store_data["room_id"])
                ->update([
                    "status_id" => 2,
                    "updated_at" => now(),
                    "transac_status" => "WALKIN_OR_TRAVEL",
                ]);
            }        
            DB::commit();
        
            return redirect()
                ->route("CheckInPage")
                ->with("success", "Data Saved Successfully!");

        } catch (\Exception $e) {
            DB::rollBack();
        
            $errorMessage = "An error occurred: " . $e->getMessage();
        
            return redirect()
                ->route('CheckInPage')
                ->withErrors(['error' => $errorMessage]);
        }
        
    }



    public function searchCustomers(Request $request)
    {
        $query = $request->get("query", "");
        $customers = DB::table("customers")
            ->where("first_name", "like", "%" . $query . "%")
            ->select("customer_id", "first_name", "last_name")
            ->take(10)
            ->get();

        return response()->json($customers);
    }

    // CHECKIN LIST ******************
    public function checkin_list(Request $request){

        $search = $request->input("search");
        $perPage = 5;
        $currentPage = $request->input("page", 1);
        $searchTerms = preg_split("/\s+/", str_replace(",", "", $search));

        $normalizedSearchTerms = array_map(function ($term) {
            return iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $term);
        }, $searchTerms);

        $attendances = DB::table("transactions")
            ->leftJoin(
                "country",
                "transactions.country_id",
                "=",
                "country.country_id"
            ) // Use LEFT JOIN
            ->leftJoin(
                "company",
                "transactions.company_id",
                "=",
                "company.company_id"
            ) // Use LEFT JOI
            ->leftJoin("room", "transactions.room_id", "=", "room.id")
            ->leftJoin(
                "business_source",
                "transactions.business_source_id",
                "=",
                "business_source.business_source_id"
            )
            ->select(
                "transactions.folio_number",
                "transactions.first_name",
                "transactions.last_name",
                "transactions.created_at",
                "transactions.date_in",
                "transactions.company_id",
                "transactions.country_id",
                "transactions.client_current_status",
                "room.room_number",
                "transactions.room_id",
                "business_source.business_source",

            )
            ->when($search, function ($query) use ($normalizedSearchTerms) {
                $query->where(function ($query) use ($normalizedSearchTerms) {
                    foreach ($normalizedSearchTerms as $term) {
                        $query->orWhere(function ($query) use ($term) {
                            $query
                                ->where(
                                    "transactions.first_name",
                                    "like",
                                    "%" . $term . "%"
                                )
                                ->orWhere(
                                    "transactions.last_name",
                                    "like",
                                    "%" . $term . "%"
                                );
                        });
                    }
                });
            })
            
            ->where('transactions.client_current_status', 'CHECKED_IN')
            ->orderBy("transactions.folio_number", "desc")
            ->paginate($perPage);

        // $attendances->getCollection()->transform(function ($attendance) {
        //     $attendance->formatted_date_in = \Carbon\Carbon::parse(
        //         $attendance->date_in
        //     )->format("F d Y"); // Only the date
        //     return $attendance;
        // });

        return response()->json([
            "attendances" => $attendances->items(),
            "current_page" => $attendances->currentPage(),
            "last_page" => $attendances->lastPage(),
            "total" => $attendances->total(),
        ]);
    }




    public function viewCheckinModal(Request $request)
    {
        $ID = $request->input("data_table_modal_id");

        try {
            $datalist = DB::table("transactions")
                ->leftJoin(
                    "country",
                    "transactions.country_id",
                    "=",
                    "country.country_id"
                )

                ->leftJoin(
                    "company",
                    "transactions.company_id",
                    "=",
                    "company.company_id"
                )
                ->leftJoin("room", "transactions.room_id", "=", "room.id")
                ->leftJoin(
                    "business_source",
                    "transactions.business_source_id",
                    "=",
                    "business_source.business_source_id"
                )
                ->leftJoin(
                    "charge_discount",
                    "transactions.discount",
                    "=",
                    "charge_discount.charge_discount_id"
                )
                ->where("transactions.folio_number", $ID)
                ->select(
                    "transactions.folio_number",
                    "transactions.first_name",
                    "transactions.last_name",
                    "transactions.address",
                    "transactions.date_in",
                    "transactions.no_of_days",
                    "transactions.no_of_adults",
                    "transactions.no_of_children",
                    "country.country",
                    "company.company",
                    "room.room_number",
                    "business_source.business_source",
                    "transactions.date_out",
                    "transactions.rate_period",
                    "transactions.total_charges",
                    "transactions.other_charges",
                    "transactions.sub_total",
                    "charge_discount.discount_description",
                    "transactions.total",
                    "transactions.amount_paid",
                    "transactions.balance",
                    "transactions.id_type",
                    "transactions.id_number",
                    "transactions.vehicle_model",
                    "transactions.vehicle_plate_no",
                    "transactions.reference_num_receipt",
                )
                ->first();

            $data = [
                "success" => true,
                "folio_number" => $datalist->folio_number,
                "first_name" => $datalist->first_name,
                "last_name" => $datalist->last_name,
                "address" => $datalist->address,
                "country" => $datalist->country,
                "company" => $datalist->company,
                "room_number" => $datalist->room_number,
                "date_in" => $datalist->date_in,
                "no_of_days" => $datalist->no_of_days,
                "no_of_adults" => $datalist->no_of_adults,
                "no_of_children" => $datalist->no_of_children,
                "business_source" => $datalist->business_source,
                "date_out" => $datalist->date_out,
                "rate_period" => $datalist->rate_period,
                "total_charges" => $datalist->total_charges,
                "other_charges" => $datalist->other_charges,
                "sub_total" => $datalist->sub_total,
                "discount_description" => $datalist->discount_description,
                "total" => $datalist->total,
                "amount_paid" => $datalist->amount_paid,
                "balance" => $datalist->balance,
                "id_type" => $datalist->id_type,
                "id_number" => $datalist->id_number,
                "vehicle_model" => $datalist->vehicle_model,
                "vehicle_plate_no" => $datalist->vehicle_plate_no,
                "reference_num_receipt" => $datalist->reference_num_receipt,
            ];

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ["success" => false, "message" => "No records found"],
                404
            );
        }
    }



    // EDIT CHECKIN
    public function EditCheckIn(Request $request)
    {
        $id = $request->input("data_table_modal_id");
        $countries = DB::table('country')->get();
        $companies = DB::table('company')->get();
        $rooms = DB::table('room')->get();
        $business = DB::table('business_source')->get();
        $discounts = DB::table('charge_discount')->get();
        $charge_type_list = DB::table('charge_type')

        ->leftJoin('charge_category', 'charge_category.category_id', '=', 'charge_type.category_id')
        ->get();

        try {

            $datalist = DB::table("transactions")
                ->where("folio_number", $id)
                ->first();

            $roomData = DB::table('room')
                ->where('id', $datalist->room_id)
                ->first();


            $chargeDiscountData = DB::table('charge_discount')
            ->where('charge_discount_id', $datalist->discount)
            ->first();
    
            $data = [
                "success" => true,
                "folio_number" => $datalist->folio_number,
                "first_name" => $datalist->first_name,
                "last_name" => $datalist->last_name,
                "address" => $datalist->address,
                'country_id' => $datalist->country_id,
                'company_id' => $datalist->company_id,
                'id' => $datalist->room_id,
                'countries' => $countries,
                'companies' => $companies,
                'rooms' => $rooms,
                'date_in' => Carbon::parse($datalist->date_in)->format('Y-m-d'), // Convert to YYYY-MM-DD
                'date_out' => Carbon::parse($datalist->date_out)->format('Y-m-d'), 
                'no_of_days' => $datalist->no_of_days,
                'no_of_adults' =>$datalist->no_of_adults,
                'no_of_children' =>$datalist->no_of_children,
                'business_source_id' => $datalist->business_source_id,
                'business' => $business,
                'discounts' => $discounts,
                'charge_discount_id' => $datalist->discount,
                //'date_out' => $datalist->date_out,
                'id_type' => $datalist->id_type,
                'id_number' => $datalist->id_number,
                'vehicle_model' => $datalist->vehicle_model,
                'vehicle_plate_no' => $datalist->vehicle_plate_no,
                'rate_period' => $datalist->rate_period,
                'total_charges' => $datalist->total_charges,
                'other_charges' => $datalist->other_charges,
                'sub_total' => $datalist->sub_total,
                'total' => $datalist->total,
                'amount_paid' => $datalist->amount_paid,
                'balance' => $datalist->balance,
                "bank" => $datalist->bank,
                "card_type" => $datalist->card_type,
                "reference_num" => $datalist->reference_num,
                "room_rate" => $roomData->room_rate ?? null,
                "adult_rate" => $roomData->adult_rate ?? null,
                "children_rate" => $roomData->children_rate ?? null,
                "no_of_person" => $roomData->no_of_person ?? null,
                "discount_num" => $chargeDiscountData->discount_num ?? null,
                "charge_type_list" => $charge_type_list,
                "amount_discounted" =>$datalist->amount_discounted,
                "no_of_sc_pwd" => $datalist->no_of_sc_pwd,
                "bod_no_of_sc_pwd" => $datalist->bod_no_of_sc_pwd,
                "bod_discount_type" => $datalist->bod_discount_type,
                "reference_num_receipt" => $datalist->reference_num_receipt,
            ];

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ["success" => false, "message" => "No records found"],
                404
            );
        }
    }

    public function UpdateCheckIn(Request $request)
    {
        if ($request->isMethod("post")) {
            $id = $request->input("edit_checkin_folio_number");
            $first_name = $request->input("edit_checkin_firstname");
            $last_name = $request->input("edit_checkin_lastname");
            $address = $request->input('edit_checkin_address');
            $country_id = $request->input('edit_checkin_country');
            $company_id = $request->input('edit_checkin_company');
            $room_id = $request->input('edit_checkin_room');
            $date_in = $request->input('edit_checkin_datein');
            $no_of_days = $request->input('edit_checkin_no_of_days');
            $no_of_adults = $request->input("edit_checkin_no_of_adults");
            $no_of_children = $request->input("edit_checkin_no_of_children");
            $business_source_id = $request->input("edit_checkin_business_source_id");
            $date_out = $request->input("edit_checkin_dateout");
            $id_type = $request->input("edit_checkin_id_type");
            $id_number = $request->input("edit_checkin_id_number");
            $vehicle_model = $request->input("edit_checkin_vehicle_model");
            $vehicle_plate_no = $request->input("edit_checkin_vehicle_plate_no");
            $rate_period = $request->input("edit_checkin_rate_period");
            $total_charges = $request->input("edit_checkin_total_charges");
            $other_charges = $request->input("edit_checkin_other_charges");
            $sub_total = $request->input("edit_checkin_sub_total");
            $discount = $request->input("edit_checkin_discount");
            $total = $request->input("edit_checkin_total");
            $amount_paid = $request->input("edit_checkin_amount_paid");
            $balance = $request->input("edit_checkin_balance");
            $bank = $request->input("edit_checkin_bank");
            $card_type = $request->input("edit_checkin_card_type");
            $reference_num = $request->input("edit_checkin_reference_num");
            $amount_discounted = $request->input("edit_discount_amount");
            $reference_num_receipt = $request->input("edit_checkin_reference_num_receipt");
            $bod_discount_type = $request->input("edit_bod_discount_type");
            $bod_no_of_sc_pwd = $request->input("edit_bod_no_of_sc_pwd");
            $no_of_sc_pwd = $request->input("edit_no_of_sc_pwd");


            try {
                $updated = DB::table("transactions")
                    ->where("folio_number", $id)
                    ->update([
                        "first_name" => $first_name,
                        "last_name" => $last_name,
                        "address" => $address,
                        "country_id" => $country_id,
                        "company_id" => $company_id,
                        "room_id" => $room_id,
                        "date_in" => $date_in,
                        "no_of_days" => $no_of_days,
                        "no_of_adults" => $no_of_adults,
                        "no_of_children" => $no_of_children,
                        "business_source_id" => $business_source_id,
                        "date_out" => $date_out,
                        "id_type" => $id_type,
                        "id_number" => $id_number,
                        "vehicle_model" => $vehicle_model,
                        "vehicle_plate_no" => $vehicle_plate_no,
                        "rate_period" => $rate_period,
                        "total_charges" => $total_charges,
                        "other_charges" => $other_charges,
                        "sub_total" => $sub_total,
                        "discount" => $discount,
                        "total" => $total,
                        "amount_paid" => $amount_paid,
                        "balance" => $balance,
                        "bank" => $bank,
                        "card_type" => $card_type,
                        "reference_num" => $reference_num,
                        "amount_discounted" => $amount_discounted,
                        "reference_num_receipt" => $reference_num_receipt,
                        "bod_discount_type" => $bod_discount_type,
                        "bod_no_of_sc_pwd" => $bod_no_of_sc_pwd,
                        "no_of_sc_pwd" => $no_of_sc_pwd,
                    ]);

                if ($updated) {
                    session()->flash("success", "Updated Successfully!");
                    return redirect()->route("CheckInPage");
                } else {
         

                    $debugInfo = [
                        "folio_number" => $id,
                        "attempted_update" => ["first_name" => $first_name],
                    ];
                 

                    session()->flash(
                        "error",
                        "No changes were made. Debug Info: " .
                            json_encode($debugInfo)
                    );
                    return redirect()->route("CheckInPage");
                }
            } catch (\Exception $e) {

                $errorDetails = $e->getMessage();
                $errorTrace = $e->getTraceAsString();

                Log::error("Update Error", [
                    "message" => $errorDetails,
                    "trace" => $errorTrace,
                ]);

                session()->flash(
                    "error",
                    "An error occurred: " . $errorDetails
                );
                return redirect()->route("CheckInPage");
            }
        }

    
        return response()->json(
            ["success" => false, "error_message" => "Invalid request method"],
            405
        );
    }






    public function deleteCheckIn(Request $request){
        $request->validate([
            'folio_number' => 'required|string',
            'data_room' => 'nullable|string',
        ]);

        $deleted = DB::table('transactions')
            ->where('folio_number', $request->folio_number)
            ->delete();


            DB::table("room")
                ->where("id", $request->data_room)
                ->update([
                    "status_id" => 3,
                    "updated_at" => now(),
                ]);

            //Log::info("Data Room:", ['data_room' => $request->data_room]);

        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'No records found.']);
        }

    }



    public function get_reservationList(){
   

        $reservationList = DB::table("transactions")
                        ->leftJoin('country', 'country.country_id', '=', 'transactions.country_id')
                        ->leftJoin('room', 'room.id', '=', 'transactions.room_id')
                        ->select(
                  'transactions.folio_number',
                           'transactions.first_name',
                           'transactions.last_name',
                           'transactions.date_in',
                           'room.room_number',
                           'country.country',

                           ) 
                        ->orderBy("folio_number", "desc") 
                        ->where('client_current_status',"RESERVE")
                        ->get();
                    
        return response()->json($reservationList);
    }






    public function storeOtherchargesEdit(Request $request)
    {
        $validatedData = $request->validate([
            'folio_number' => 'required|integer',  
            'other_charges' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/', 
        ]);

        try {
            $existingTransaction = DB::table('transactions')->where('folio_number', $validatedData['folio_number'])->first();
    
            if ($existingTransaction) {

                DB::table('transactions')
                    ->where('folio_number', $validatedData['folio_number'])
                    ->update(['other_charges' => $validatedData['other_charges']]);
    
                return response()->json(['message' => 'Charges updated successfully!']);
            } else {
                // If no record is found, create a new entry

                session()->flash("error", "Error saving the data!");
                return redirect()->route("CheckInPage");
                // return response()->json(['message' => 'Charges saved successfully!']);
            }
    
        } catch (\Exception $e) {

            return response()->json(['message' => 'Could not save data. Error: ' . $e->getMessage()], 500);
        }
    }
    




    // VIEW CHECKOUT 

    public function viewCheckOutModal(Request $request)
    {
        $ID = $request->input("data_table_modal_id");

        try {
            $datalist = DB::table("transactions")
             
                ->where("folio_number", $ID)
                ->select(
                    "folio_number",
                    "first_name",
                    "last_name",
                    "no_of_days",
                    "rate_period",
                    "total_charges",
                    "other_charges",
                    "sub_total",
                    "discount",
                    "total",
                    "amount_paid",
                    "balance",
                    "bank",
                    "card_type",
                    "reference_num",
                    "room_id",
                )
                ->first();

            $data = [
                "success" => true,
                "folio_number" => $datalist->folio_number,
                "first_name" => $datalist->first_name,
                "last_name" => $datalist->last_name,
                "no_of_days" => $datalist->no_of_days,
                "rate_period" => $datalist->rate_period,
                "total_charges" => $datalist->total_charges,
                "other_charges" => $datalist->other_charges,
                "sub_total" => $datalist->sub_total,
                "discount" => $datalist->discount,
                "total" => $datalist->total,
                "amount_paid" => $datalist->amount_paid,
                "balance" => $datalist->balance,
                "bank" => $datalist->bank,
                "card_type" => $datalist->card_type,
                "reference_num" => $datalist->reference_num,
                "room_id" => $datalist->room_id,
            ];

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ["success" => false, "message" => "No records found"],
                404
            );
        }
    }











    public function storeCheckout(Request $request)
    {
        $validatedData = $request->validate([
            'checkout_view_folio_number' => 'required|integer',  
            'checkout_view_room' => 'nullable|integer',
        ]);

        try {
            $existingTransaction = DB::table('transactions')->where('folio_number', $validatedData['checkout_view_folio_number'])->first();
            $login_name = Auth::user()->name; 

            if ($existingTransaction) {

    

                DB::table('transactions')
                    ->where('folio_number', $validatedData['checkout_view_folio_number'])
                    ->update([
                        'client_current_status' => 'CHECKED_OUT',
                        'updated_by' => $login_name,
                        'updated_at' => now(),
                        'time_checkout' => now(),
                    ]);

                
              
        
                    DB::table("room")
                        ->where("id", $validatedData["checkout_view_room"])
                        ->update([
                            "status_id" => 3,
                            "updated_at" => now(),
                        ]);
                
       
    
                    session()->flash("success", "Checkout Sucessfully!");
                    return redirect()->route("CheckInPage");
            } else {
          

                session()->flash("error", "Error saving the data!");
                return redirect()->route("CheckInPage");
                // return response()->json(['message' => 'Charges saved successfully!']);
            }
    
        } catch (\Exception $e) {

            return response()->json(['message' => 'Could not save data. Error: ' . $e->getMessage()], 500);
        }
    }







    public function CheckInFromReservation(Request $request)
    {
        $ID = $request->input("data_table_modal_id");

        try {
            $datalist = DB::table("transactions")
                ->leftJoin("room", "transactions.room_id", "=", "room.id")
                ->where("folio_number", $ID)
                ->select(
                    "transactions.folio_number",
                    "transactions.first_name",
                    "transactions.last_name",
                    "room.room_number",
                    "transactions.room_id",
            
          
                )
                ->first();

            $data = [
                "success" => true,
                "folio_number" => $datalist->folio_number,
                "first_name" => $datalist->first_name,
                "last_name" => $datalist->last_name,
                "room_number" => $datalist->room_number,
                "room_id" => $datalist->room_id,

            ];

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ["success" => false, "message" => "No records found"],
                404
            );
        }
    }


    public function storeCheckInFromReservation(Request $request)
    {
        $validatedData = $request->validate([
            'checkinFromReserve_folio_number_input' => 'required|integer',  
            'checkinFromReserve_room_number_input' => 'nullable|string',
    
        ]);

        try {
            $existingTransaction = DB::table('transactions')->where('folio_number', $validatedData['checkinFromReserve_folio_number_input'])->first();
            $login_name = Auth::user()->name; 
            if ($existingTransaction) {

                DB::table('transactions')
                    ->where('folio_number', $validatedData['checkinFromReserve_folio_number_input'])
                    ->update([
                        'client_current_status' => 'CHECKED_IN',
                        'updated_by' => $login_name,
                        'updated_at' => now(),
                        "time_checkin" => now(),
                    ]);

                    $roomUpdate = DB::table("room")
                            ->where("id", $validatedData["checkinFromReserve_room_number_input"])
                            ->update([
                                "status_id" => 2,
                                "updated_at" => now(),
                                "transac_status" => "CHECKIN_FROM_RESERVE",
                            ]);

                    if (!$roomUpdate) {
                    Log::error('Room update failed', [
                        'room_id' => $validatedData["checkinFromReserve_room_number_input"],
                    ]);
                }
                
                
                    session()->flash("success", "Checkin Sucessfully!");
                    return redirect()->route("CheckInPage");
            } else {
          

                session()->flash("error", "Error saving the data!");
                return redirect()->route("CheckInPage");
            }
    
        } catch (\Exception $e) {
            $errorDetails = $e->getMessage();
            $errorTrace = $e->getTraceAsString();

            Log::error("Update Error", [
                "message" => $errorDetails,
                "trace" => $errorTrace,
            ]);

            return response()->json(['message' => 'Could not save data. Error: ' . $e->getMessage()], 500);
        }
    }





    


    public function deleteReservation(Request $request){
     
        $request->validate([
            'folio_number' => 'required|string',
      
        ]);


        $deleted = DB::table('transactions')
            ->where('folio_number', $request->folio_number)
            ->delete();

        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'No records found.']);
        }

    }





    public function get_CheckoutList(){
   
        $fiveMonthsAgo = Carbon::now()->subMonths(5)->startOfDay();
        $reservationList = DB::table("transactions")
                        ->leftJoin('country', 'country.country_id', '=', 'transactions.country_id')
                        ->leftJoin('room', 'room.id', '=', 'transactions.room_id')
                        ->select(
                  'transactions.folio_number',
                           'transactions.first_name',
                           'transactions.last_name',
                           'transactions.date_in',
                           'transactions.date_out',
                           'room.room_number',
                           'country.country',

                           ) 
                       ->where('client_current_status', 'CHECKED_OUT')
                       ->where('transactions.date_out', '>=', $fiveMonthsAgo)
                       ->orderBy('folio_number', 'desc')
                       ->get();
                        // ->orderBy("folio_number", "desc") 
                        // ->where('client_current_status',"CHECKED_OUT")
                        // ->get();
                    
        return response()->json($reservationList);
    }
















    // EDIT CHECKOUT

    public function EditCheckOut(Request $request)
    {
        $id = $request->input("data_table_modal_id");
        $countries = DB::table('country')->get();
        $companies = DB::table('company')->get();
        $rooms = DB::table('room')->get();
        $business = DB::table('business_source')->get();
        $discounts = DB::table('charge_discount')->get();
        $charge_type_list = DB::table('charge_type')

        ->leftJoin('charge_category', 'charge_category.category_id', '=', 'charge_type.category_id')
        ->get();

        try {

            $datalist = DB::table("transactions")
                ->where("folio_number", $id)
                ->first();

            $roomData = DB::table('room')
                ->where('id', $datalist->room_id)
                ->first();


            $chargeDiscountData = DB::table('charge_discount')
            ->where('charge_discount_id', $datalist->discount)
            ->first();
    
            $data = [
                "success" => true,
                "folio_number" => $datalist->folio_number,
                "first_name" => $datalist->first_name,
                "last_name" => $datalist->last_name,
                "address" => $datalist->address,
                'country_id' => $datalist->country_id,
                'company_id' => $datalist->company_id,
                'id' => $datalist->room_id,
                'countries' => $countries,
                'companies' => $companies,
                'rooms' => $rooms,
                'date_in' => Carbon::parse($datalist->date_in)->format('Y-m-d'), // Convert to YYYY-MM-DD
                'date_out' => Carbon::parse($datalist->date_out)->format('Y-m-d'), 
                'no_of_days' => $datalist->no_of_days,
                'no_of_adults' =>$datalist->no_of_adults,
                'no_of_children' =>$datalist->no_of_children,
                'business_source_id' => $datalist->business_source_id,
                'business' => $business,
                'discounts' => $discounts,
                'charge_discount_id' => $datalist->discount,
                //'date_out' => $datalist->date_out,
                'id_type' => $datalist->id_type,
                'id_number' => $datalist->id_number,
                'vehicle_model' => $datalist->vehicle_model,
                'vehicle_plate_no' => $datalist->vehicle_plate_no,
                'rate_period' => $datalist->rate_period,
                'total_charges' => $datalist->total_charges,
                'other_charges' => $datalist->other_charges,
                'sub_total' => $datalist->sub_total,
                'total' => $datalist->total,
                'amount_paid' => $datalist->amount_paid,
                'balance' => $datalist->balance,
                "bank" => $datalist->bank,
                "card_type" => $datalist->card_type,
                "reference_num" => $datalist->reference_num,
                "room_rate" => $roomData->room_rate ?? null,
                "adult_rate" => $roomData->adult_rate ?? null,
                "children_rate" => $roomData->children_rate ?? null,
                "no_of_person" => $roomData->no_of_person ?? null,
                "discount_num" => $chargeDiscountData->discount_num ?? null,
                "charge_type_list" => $charge_type_list,
                "amount_discounted" =>$datalist->amount_discounted,
                "no_of_sc_pwd" => $datalist->no_of_sc_pwd,
                "bod_no_of_sc_pwd" => $datalist->bod_no_of_sc_pwd,
                "bod_discount_type" => $datalist->bod_discount_type,
                "reference_num_receipt" => $datalist->reference_num_receipt,
            ];

            return response()->json($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                ["success" => false, "message" => "No records found"],
                404
            );
        }
    }






    public function UpdateCheckOut(Request $request)
    {
        if ($request->isMethod("post")) {
            $id = $request->input("edit_checkout_folio_number");
    
            // Build an array of only the fields sent in the request
            $data = [];
    
            // Add fields to $data only if they exist in the request
            if ($request->has('edit_checkout_firstname')) {
                $data['first_name'] = $request->input('edit_checkout_firstname');
            }
            if ($request->has('edit_checkout_lastname')) {
                $data['last_name'] = $request->input('edit_checkout_lastname');
            }
            if ($request->has('edit_checkout_address')) {
                $data['address'] = $request->input('edit_checkout_address');
            }
            if ($request->has('edit_checkout_country')) {
                $data['country_id'] = $request->input('edit_checkout_country');
            }
            if ($request->has('edit_checkout_company')) {
                $data['company_id'] = $request->input('edit_checkout_company');
            }
            if ($request->has('edit_checkin_room')) {
                $data['room_id'] = $request->input('edit_checkin_room');
            }
            if ($request->has('edit_checkout_datein')) {
                $data['date_in'] = $request->input('edit_checkout_datein');
            }
            if ($request->has('edit_checkout_no_of_days')) {
                $data['no_of_days'] = $request->input('edit_checkout_no_of_days');
            }
            if ($request->has('edit_checkout_no_of_adults')) {
                $data['no_of_adults'] = $request->input('edit_checkout_no_of_adults');
            }
            if ($request->has('edit_checkout_no_of_children')) {
                $data['no_of_children'] = $request->input('edit_checkout_no_of_children');
            }
            if ($request->has('edit_checkout_business_source')) {
                $data['business_source_id'] = $request->input('edit_checkout_business_source');
            }
            if ($request->has('edit_checkout_dateout')) {
                $data['date_out'] = $request->input('edit_checkout_dateout');
            }
            if ($request->has('edit_checkout_id_type')) {
                $data['id_type'] = $request->input('edit_checkout_id_type');
            }
            if ($request->has('edit_checkin_id_number')) {
                $data['id_number'] = $request->input('edit_checkin_id_number');
            }
            if ($request->has('edit_checkin_vehicle_model')) {
                $data['vehicle_model'] = $request->input('edit_checkin_vehicle_model');
            }
            if ($request->has('edit_checkin_vehicle_plate_no')) {
                $data['vehicle_plate_no'] = $request->input('edit_checkin_vehicle_plate_no');
            }
            if ($request->has('edit_checkout_rate_period')) {
                $data['rate_period'] = $request->input('edit_checkout_rate_period');
            }
            if ($request->has('edit_checkout_total_charges')) {
                $data['total_charges'] = $request->input('edit_checkout_total_charges');
            }
            if ($request->has('edit_checkout_other_charges')) {
                $data['other_charges'] = $request->input('edit_checkout_other_charges');
            }
            if ($request->has('edit_checkout_sub_total')) {
                $data['sub_total'] = $request->input('edit_checkout_sub_total');
            }
            if ($request->has('edit_checkout_discount')) {
                $data['discount'] = $request->input('edit_checkout_discount');
            }
            if ($request->has('edit_checkout_total')) {
                $data['total'] = $request->input('edit_checkout_total');
            }
            if ($request->has('edit_checkout_amount_paid')) {
                $data['amount_paid'] = $request->input('edit_checkout_amount_paid');
            }
            if ($request->has('edit_checkout_balance')) {
                $data['balance'] = $request->input('edit_checkout_balance');
            }
      
            if ($request->has('edit_checkin_reference_num')) {
                $data['reference_num'] = $request->input('edit_checkin_reference_num');
            }

            if ($request->has('edit_checkout_reference_num_receipt')) {
                $data['reference_num_receipt'] = $request->input('edit_checkout_reference_num_receipt');
            }
  
  
    
            try {
                // Only update if there’s something to update
                if (!empty($data)) {
                    $updated = DB::table('transactions')
                        ->where('folio_number', $id)
                        ->update($data);
    
                    if ($updated) {
                        session()->flash('success', 'Updated Successfully!');
                    } else {
                        $debugInfo = [
                            'folio_number' => $id,
                            'attempted_update' => $data,
                        ];
                        session()->flash(
                            'error',
                            'No changes were made. Debug Info: ' . json_encode($debugInfo)
                        );
                    }
                } else {
                    session()->flash('error', 'No fields provided to update.');
                }
    
                return redirect()->route('CheckInPage');
            } catch (\Exception $e) {
                $errorDetails = $e->getMessage();
                $errorTrace = $e->getTraceAsString();
    
                Log::error('Update Error', [
                    'message' => $errorDetails,
                    'trace' => $errorTrace,
                ]);
    
                session()->flash('error', 'An error occurred: ' . $errorDetails);
                return redirect()->route('CheckInPage');
            }
        }
    }





    public function deleteCheckout(Request $request){
     
        $request->validate([
            'folio_number' => 'required|string',
      
        ]);
    
    
        $deleted = DB::table('transactions')
            ->where('folio_number', $request->folio_number)
            ->delete();
    
        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'No records found.']);
        }
    
    }
    
    


}
