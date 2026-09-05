@extends('base')
@section('title', 'CALENDAR')
@section('content')



<div class="p-1">



    <div class="grid grid-cols-12 gap-x-10 p-10">

        <div class="col-span-2 relative top-20">
            <h2 class="text-xl font-bold text-green-900">Legend List</h2>

                <div class="grid gap-y-4 mt-8 ml-6">
                    <div class=""><span class="bg-green-800 text-green-800 p-2 py-1 mr-2">b</span>Reserve</div>
                    <div class=""><span class="bg-yellow-700 text-yellow-700 p-2 py-1 mr-2">b</span>Travel Agent</div>
                    <div class=""><span class="bg-blue-800 text-blue-800 p-2 py-1 mr-2">b</span>Walk In</div>
                </div>
        </div>

        <div class="col-span-10" id="calendar"></div>
    </div>
  

</div>




{{-- MODALS --}}

<x-modalLarge 

    id="calendarView-modal" 
    title="TRANSACTION DETAILS"
    secondaryButtonAction="document.getElementById('calendarView-modal').classList.add('hidden'); document.getElementById('calendarView-modal').classList.remove('flex');"
    secondaryButtonText="Close"
    secondaryButtonClass="bg-slate-500 hover:bg-slate-700 px-4 py-2 rounded text-white"
    >


    <form id="calendarView-form" action="">


        <div class="mt-4 grid grid-cols-2">
            <input type="hidden" name="calendar_folio_number" id="checkinFromReserve_folio_number_input">
            <h4 class="font-bold">Customer Name: <span class="calendar_fullname font-light mx-1"></span></h4>
            <h4 class="font-bold">Room Number: <span class="calendar_room_number font-light mx-1"></span></h4>
            <h4 class="font-bold">No of Days: <span class="calendar_no_of_days font-light mx-1 mt-2"></span></h4>
            <h4 class="font-bold">Business Source: <span class="calendar_business_source font-light mx-1 mt-2"></span></h4>
            <h4 class="font-bold">Date In: <span class="calendar_time_checkin font-light mx-1 mt-2"></span></h4>
            <h4 class="font-bold">Date Out: <span class="calendar_time_checkout font-light mx-1 mt-2"></span></h4>
        </div>
    </form>

</x-modalLarge>


@push('scripts')

<script>
 document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        navLinks: true,
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today,multiMonthYear',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        events: function(fetchInfo, successCallback, failureCallback) {
    $.ajax({
        url: 'getTransactions',
        dataType: 'json',
        success: function(data) {
            console.log('Fetched Events:', data); // Log fetched events
            var allEvents = data.map(function(event) {
                console.log('Mapping Event--:', event.date_in, event.date_out);

                return {
                    id: event.folio_number,
                    title: `Room:${event.room_number} , ${event.first_name} ${event.last_name}`,
                    start: event.date_in,
                    end: event.date_out, // Make sure this includes the correct last day
                    allDay: true, // Ensures event spans full days
                    extendedProps: {
                        business_source_id: event.business_source_id
                    }
                };
            });

            successCallback(allEvents);
        },
        error: function() {
            failureCallback();
        }
    });
},


            eventClick: function(info) {
            var eventId = info.event.id;

            $.ajax({
                url: 'ViewCalendarModal',
                type: 'GET',
                data: { eventId: eventId },
                dataType: 'json',
                success: function(eventDetails) {
                    $('#checkinFromReserve_folio_number_input').val(eventDetails.folio_number);
                    $('.calendar_fullname').text(eventDetails.first_name + ' ' + eventDetails.last_name); // Use .text() for span
                    $('.calendar_room_number').text(eventDetails.room_number);  
                    $('.calendar_no_of_days').text(eventDetails.no_of_days);
                    $('.calendar_business_source').text(eventDetails.business_source);

                    const timeCheckin = eventDetails.date_in ? formatDate(eventDetails.date_in) : '';
                    const timeCheckout = eventDetails.date_out ? formatDate(eventDetails.date_out) : '';

                    $('.calendar_time_checkin').text(timeCheckin);
                    $('.calendar_time_checkout').text(timeCheckout);

                    $("#calendarView-modal").removeClass('hidden').addClass('flex');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching event details:', error);
                    alert('Error fetching event details.');
                }
            });
        },





        eventContent: function(arg) {
            var titleEl = document.createElement('div');
            titleEl.classList.add('fc-event-title');
            titleEl.innerHTML = `<b>${arg.event.title}</b>`;
            var arrayOfDomNodes = [titleEl];
            return { domNodes: arrayOfDomNodes };
        },

        eventDidMount: function(info) {
            console.log('Event Info:', info.event.extendedProps);
            var businessSourceId = info.event.extendedProps.business_source_id;
            var backgroundColor = '';


            switch (businessSourceId) {
                case 1:
                    backgroundColor = '#193cb8';
                    break;
                case 2:
                    backgroundColor = '#166534';
                    break;
                case 3:
                    backgroundColor = '#a65f00';
                    break;
                default:
                    backgroundColor = 'gray';
            }

            info.el.style.backgroundColor = backgroundColor;
            info.el.style.color = 'white';
        }
    });

    calendar.render();
});


function formatDate(dateString) {
    const date = new Date(dateString);
    const formatter = new Intl.DateTimeFormat('en-PH', {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
        // hour: 'numeric',
        // minute: 'numeric',
        // hour12: true
    });
    return formatter.format(date);
}


</script>


@endpush

@endsection


