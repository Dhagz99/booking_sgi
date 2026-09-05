@extends('base')
@section('title', 'ROOM REPORT')
@section('content')

<style>
    @media print {
        /* Hide browser-added headers and footers */
        @page {
            margin: 0; /* Remove default margins to prevent browser-added content */
            size: auto; /* Ensure proper page sizing */
        }

        /* Hide any header/footer from the base template */
        header, footer, .header, .footer {
            display: none !important;
        }

        /* Ensure the date filter and print button remain hidden */
        .no-print {
            display: none;
        }

        /* Optional: Adjust table layout for printing */
        table {
            border-collapse: collapse;
            width: 100%;
        }
    }
</style>

<div class="p-1">
    <div class="flex flex-col justify-center items-center w-full py-6">
        <div><h6 class="font-sans italic">SOUTH GATE INN</h6></div>
        <div><h5>Guanzon St. Kabankalan City Negros Occidental Phils, 6100</h5></div>
        <div><h6>Tel.No / Fax No. 471-2729</h6></div>
        <div><h6>Email:southgateinn@yahoo.com</h6></div>
        <div><h2 class="font-semibold mt-2 text-2xl font-serif">Room Occupancy Report</h2></div>
    </div>

    <div class="w-full grid px-4">

        <div class="flex justify-between">
            <form action="{{ route('RoomReportsPage') }}" method="GET" class="flex justify-start gap-x-4 no-print">
                <div class="flex flex-col mt-2">
                    <label for="selected_date" class="mb-1">SELECT DATE</Florence</label>
                    <input type="date" id="selected_date" name="selected_date" class="p-1 rounded bg-slate-600 hover:bg-slate-500 text-white mb-4" value="{{ $selectedDate ?? '' }}">
                </div>
                <div class="flex items-center pl-4 mb-8">
                    <button type="submit" class="bg-green-800 hover:bg-green-700 px-4 py-1 rounded text-white mt-3">Filter</button>
                </div>
            </form>

            <div class="flex justify-end items-end no-print">
                <button onclick="window.print()" class="h-2/5 bg-slate-600 hover:bg-slate-500 text-white py-1 px-6 rounded mb-4 float-right">Print</button>
            </div>
        </div>

        <h2 style="margin-bottom:.8rem;font-weight:500;">
            {{ $selectedDate ? date('F j, Y', strtotime($selectedDate)) : '' }}
        </h2>


        <table>
            <thead>
                <tr class="text-xs border-2 border-zinc-300">
                    <th class="border-r-2 border-zinc-300 p-2">Room Number</th>
                    <th class="border-r-2 border-zinc-300">Name</th>
                    <th class="border-r-2 border-zinc-300">Check-In</th>
                    <th class="border-r-2 border-zinc-300">Check-Out</th>
                 
                    <th class="border-r-2 border-zinc-300">No of Days</th>
                    <th class="border-r-2 border-zinc-300">Discount Given</th>
                    <th class="border-r-2 border-zinc-300">Rate</th>
                    <th class="border-r-2 border-zinc-300">Amount Discounted</th>
                    <th class="border-r-2 border-zinc-300">Charges</th>
                    <th class="border-r-2 border-zinc-300">Sub total</th>
                    <th class="border-r-2 border-zinc-300">Total Due</th>
                    <th class="border-r-2 border-zinc-300">Amount Paid</th>
                    <th class="border-r-2 border-zinc-300">Balance</th>
                    <th class="border-r-2 border-zinc-300">Reference</th>
                </tr>
            </thead>
            <tbody class="text-xs">
                @if($transac->isEmpty())
                    <tr>
                        <td colspan="14" class="text-center p-4 border-2 border-zinc-300">
                            {{ $selectedDate ? 'No transactions found for this date.' : 'Please select a date to view transactions.' }}
                        </td>
                    </tr>
                @else
                    @foreach($transac as $index)
                    <tr class="border-2 border-zinc-300">
                        <td class="border-r-2 border-zinc-300 p-2">{{ $index->room_number ?? 'N/A' }}</td>
                        <td class="border-r-2 border-zinc-300 p-2">{{ $index->first_name . ' ' . $index->last_name ?? 'N/A' }}</td>
                        <td class="border-r-2 border-zinc-300 p-2">
                            {{ $index->date_in ? \Carbon\Carbon::parse($index->date_in)->format('Y-m-d') : 'N/A' }}
                        </td>
                        <td class="border-r-2 border-zinc-300 p-2">
                            {{ $index->date_out ? \Carbon\Carbon::parse($index->date_out)->format('Y-m-d') : 'N/A' }}
                        </td>
               
                        <td class="border-r-2 border-zinc-300 p-2">{{ $index->no_of_days ?? 'N/A' }}</td>
                        <td class="border-r-2 border-zinc-300 p-2">{{ $index->discount_num ?? 'N/A' }}</td>
                        <td class="border-r-2 border-zinc-300 p-2">{{ $index->rate_period ?? 'N/A' }}</td>
                        <!-- <td class="border-r-2 border-zinc-300 p-2">{{ $index->amount_discounted ?? 'N/A' }}</td> -->
                        <td class="border-r-2 border-zinc-300 p-2">{{ number_format($index->discount_per_day, 2) }}</td>
                        <td class="border-r-2 border-zinc-300 p-2">{{ number_format($index->other_charges_per_day, 2) }}</td>
                        <!-- <td class="border-r-2 border-zinc-300 p-2">{{ $index->sub_total ?? 'N/A' }}</td> -->
                        <td class="border-r-2 border-zinc-300 p-2">{{ number_format($index->subtotal_per_day, 2) }}</td>
                        <td class="border-r-2 border-zinc-300 p-2">{{ number_format($index->total_per_day, 2) }}</td>
                        <td class="border-r-2 border-zinc-300 p-2">{{ number_format($index->amount_paid_per_day, 2) }}</td>
                        <td class="border-r-2 border-zinc-300 p-2">{{ number_format($index->balance_per_day, 2) }}</td>
                        <td class="border-r-2 border-zinc-300 p-2">{{ $index->reference_num_receipt ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
            @if(!$transac->isEmpty())

                <tr class="text-xs font-bold border-2 border-zinc-300">
                    <td colspan="6" class="border-r-2 border-zinc-300 p-2 text-left">Grand Total:</td>
                    
                    <td class="border-r-2 border-zinc-300 p-2">{{ number_format($rateGrand, 2) }}</td>
  
                    <td class="border-r-2 border-zinc-300 p-2">{{ number_format($amountDiscountGrand, 2) }}</td>
                    <td class="border-r-2 border-zinc-300 p-2">{{ number_format($chargesGrand, 2) }}</td>
                    <td class="border-r-2 border-zinc-300 p-2">{{ number_format($subTotalGrand, 2) }}</td>
                    <td class="border-r-2 border-zinc-300 p-2">{{ number_format($totalDueGrand, 2) }}</td>
                    <td class="border-r-2 border-zinc-300 p-2">{{ number_format($amountPaidGrand, 2) }}</td>
                    <td class="border-r-2 border-zinc-300 p-2">{{ number_format($balanceGrand, 2) }}</td>
                    <td colspan="1" class="border-r-2 border-zinc-300 p-2"></td>
                </tr>
       
            @endif
        </table>
    </div>
</div>

@endsection