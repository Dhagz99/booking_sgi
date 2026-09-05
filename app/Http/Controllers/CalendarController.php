<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;

class CalendarController extends Controller
{
    //


    public function calendarPage(){
        return view('calendarJS');
    }



    public function getTransactions(Request $request)
    {
        $transactions = DB::table('transactions')
                        ->leftJoin('room', 'room.id', '=', 'transactions.room_id')
                        ->select(
                            'transactions.folio_number',
                            'transactions.first_name',
                            'transactions.date_in',
                            'transactions.date_out',
                            'transactions.business_source_id',
                            'room.room_number',
                            'transactions.last_name',
                        )
                        ->get();
    
        // Map transactions to FullCalendar format
        $events = $transactions->map(function ($transaction) {
            $dateIn = Carbon::parse($transaction->date_in)->toIso8601String();
            $dateOut = Carbon::parse($transaction->date_out);
    
            // If time is exactly at 00:00:00, add a full day to display properly in FullCalendar
            if ($dateOut->format('H:i:s') === '00:00:00') {
                $dateOut->addDay();
            }
    
            return [
                'folio_number' => $transaction->folio_number,
                'first_name' => $transaction->first_name,
                'last_name' => $transaction->last_name,
                'date_in' => $dateIn,
                'date_out' => $dateOut->toIso8601String(),
                'business_source_id' => $transaction->business_source_id,
                'room_number' => $transaction->room_number ?? 'N/A',
            ];
        });
    
        return response()->json($events);
    }
    


    public function ViewCalendarModal(Request $request)
    {
        $folioNumber = $request->get('eventId'); // Get the eventId from the request
    
   
        $transaction = DB::table('transactions')
                        ->leftJoin('room', 'room.id', '=', 'transactions.room_id')
                        ->leftJoin("business_source","transactions.business_source_id","=","business_source.business_source_id")
                        ->select(
                            'transactions.folio_number',
                            'transactions.first_name',
                            'transactions.last_name',
                            'transactions.date_in',
                            'transactions.date_out',
                            'transactions.business_source_id',
                            'transactions.no_of_days',
                            'business_source.business_source',
             
                            'room.room_number',
                        )
                        ->where('transactions.folio_number', $folioNumber)
                        ->first(); 

    
        if ($transaction) {
            return response()->json([
                'folio_number' => $transaction->folio_number,
                'first_name' => $transaction->first_name,
                'last_name' => $transaction->last_name,
                'no_of_days' => $transaction->no_of_days,
                'business_source' => $transaction->business_source,
                'date_in' => $transaction->date_in ? Carbon::parse($transaction->date_in)->toIso8601String() : null,
                'date_out' => $transaction->date_out ? Carbon::parse($transaction->date_out)->toIso8601String() : null,
                'business_source_id' => $transaction->business_source_id,
                'room_number' => $transaction->room_number ?? 'N/A',
            ]);
        }
    
        return response()->json(['error' => 'Event not found'], 404);
    }
    




}
