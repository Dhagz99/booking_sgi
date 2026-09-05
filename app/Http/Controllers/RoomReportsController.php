<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomReportsController extends Controller
{
    public function RoomReportsPage(Request $request)
    {
        $selectedDate = $request->input('selected_date');
        $transac = collect();
        $subTotalGrand = 0;
        $totalDueGrand = 0;
        $chargesGrand = 0;  // Initialize outside if block
        $amountDiscountGrand = 0;   // Initialize outside if block
        $amountPaidGrand = 0;  // Initialize outside if block
        $balanceGrand = 0;  // Initialize outside if block
        $rateGrand = 0;

        if ($selectedDate) {
            if (!strtotime($selectedDate)) {
                return redirect()->back()->withErrors(['Invalid date selected']);
            }

            $transac = DB::table('transactions')
                ->leftJoin('room', 'room.id', '=', 'transactions.room_id')
                ->leftJoin('charge_discount', 'transactions.discount', '=', 'charge_discount.charge_discount_id')
                ->where(function ($query) use ($selectedDate) {
                    $query->whereDate('transactions.date_in', '<=', $selectedDate)
                          ->where(function ($subquery) use ($selectedDate) {
                              $subquery->whereDate('transactions.date_out', '>=', $selectedDate)
                                       ->orWhereNull('transactions.date_out');
                          });
                })
                ->select(
                    'room.room_number',
                    'transactions.first_name',
                    'transactions.last_name',
                    'transactions.time_checkin',
                    'transactions.time_checkout',
                    'transactions.rate_period',
                    'transactions.no_of_days',
                    'transactions.amount_discounted',
                    'transactions.other_charges',
                    'transactions.total',
                    'transactions.amount_paid',
                    'transactions.balance',
                    'transactions.date_in',
                    'transactions.date_out',
                    'transactions.sub_total',
                    'transactions.reference_num_receipt',
                    'charge_discount.discount_num'
                )
                ->get();

      

            $transac = $transac->sortBy('room_number')->map(function ($item) {
                // Discount per day
                $item->discount_per_day = ($item->no_of_days > 0 && $item->amount_discounted)
                    ? $item->amount_discounted / $item->no_of_days
                    : 0;

                // Subtotal per day
                $item->subtotal_per_day = ($item->no_of_days > 0 && $item->sub_total)
                    ? $item->sub_total / $item->no_of_days
                    : 0;

                $item->total_per_day = ($item->no_of_days > 0 && $item->total)
                    ? $item->total / $item->no_of_days
                    : 0;

                $item->balance_per_day = ($item->no_of_days > 0 && $item->balance)
                    ? $item->balance / $item->no_of_days
                    : 0;

                $item->amount_paid_per_day = ($item->no_of_days > 0 && $item->amount_paid)
                    ? $item->amount_paid / $item->no_of_days
                    : 0;

                $item->other_charges_per_day = ($item->no_of_days > 0 && $item->other_charges)
                    ? $item->other_charges / $item->no_of_days
                    : 0;




                return $item;
            });


           // $transac = $transac->sortBy('room_number');
            $subTotalGrand = $transac->sum('subtotal_per_day');
            $totalDueGrand = $transac->sum('total_per_day');
            $chargesGrand = $transac->sum('other_charges_per_day');
            $amountDiscountGrand = $transac->sum('discount_per_day');
            $amountPaidGrand = $transac->sum('amount_paid_per_day');
            $balanceGrand = $transac->sum('balance_per_day');
            $rateGrand = $transac->sum('rate_period');
        }

        return view('room_reports', compact('transac', 'selectedDate', 'subTotalGrand', 'totalDueGrand', 'chargesGrand', 'amountDiscountGrand', 'amountPaidGrand', 'balanceGrand','rateGrand'));
    }
}