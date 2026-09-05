<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function getOverdueCheckouts()
    {
        $today = Carbon::today();
        $overdueCheckouts = DB::table('transactions')
            ->where('date_out', '<', $today)
            ->where('client_current_status', 'CHECKED_IN')
            ->select('folio_number', 'first_name', 'last_name', 'room_id', 'date_out')
            ->get();

        $count = $overdueCheckouts->count();
        $details = $overdueCheckouts->map(function ($checkout) {
            $roomNumber = DB::table('room')->where('id', $checkout->room_id)->value('room_number') ?? 'N/A';
            return [
                'folio_number' => $checkout->folio_number,
                'full_name' => trim("{$checkout->first_name} {$checkout->last_name}"),
                'room_number' => $roomNumber,
                'date_out' => $checkout->date_out,
            ];
        })->all();

        $names = $overdueCheckouts->pluck('first_name')->join(', ');

        $formattedDetails = $overdueCheckouts->mapWithKeys(function ($checkout) {
            $roomNumber = DB::table('room')->where('id', $checkout->room_id)->value('room_number') ?? 'N/A';
            return [$checkout->folio_number => [
                'folio_number' => $checkout->folio_number,
                'full_name' => trim("{$checkout->first_name} {$checkout->last_name}"),
                'room_number' => $roomNumber,
                'date_out' => $checkout->date_out,
            ]];
        })->all();

        return response()->json([
            'count' => $count,
            'names' => $names ?: 'No overdue checkouts found',
            'details' => $formattedDetails,
        ]);
    }


    

    public function getOverdueReservations()
    {
        $today = Carbon::today();
        $overdueReservations = DB::table('transactions')
            ->where('date_in', '<', $today) // Changed to date_in < today
            ->where('client_current_status', 'RESERVE')
            ->select('folio_number', 'first_name', 'last_name', 'room_id', 'date_in') // Include date_in for display
            ->get();

        $count = $overdueReservations->count();
        $details = $overdueReservations->map(function ($reservation) {
            $roomNumber = DB::table('room')->where('id', $reservation->room_id)->value('room_number') ?? 'N/A';
            return [
                'folio_number' => $reservation->folio_number,
                'full_name' => trim("{$reservation->first_name} {$reservation->last_name}"),
                'room_number' => $roomNumber,
                'date_in' => $reservation->date_in,
            ];
        })->all();

        $names = $overdueReservations->pluck('first_name')->join(', ');

        $formattedDetails = $overdueReservations->mapWithKeys(function ($reservation) {
            $roomNumber = DB::table('room')->where('id', $reservation->room_id)->value('room_number') ?? 'N/A';
            return [$reservation->folio_number => [
                'folio_number' => $reservation->folio_number,
                'full_name' => trim("{$reservation->first_name} {$reservation->last_name}"),
                'room_number' => $roomNumber,
                'date_in' => $reservation->date_in,
            ]];
        })->all();

        return response()->json([
            'count' => $count,
            'names' => $names ?: 'No overdue reservations found',
            'details' => $formattedDetails,
        ]);
    }
}