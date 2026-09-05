<style>
    @media print {
        .no-print {
            display: none;
        }
    }
    #notification-count, #reservation-count {
        min-width: 1rem;
        height: 1rem;
        background-color: #ef4444; /* Red color */
        color: white;
        border-radius: 9999px; /* Circular */
        font-size: 0.625rem; /* Smaller text */
        line-height: 1rem;
        transform: translate(50%, -50%);
        display: none; /* Hidden by default, shown when count > 0 */

    }
    #overdue-table, #overdue-reservation-table {
        max-height: 10rem; 
        overflow-y: auto;
    }

    #overdue-table table, #overdue-reservation-table table {
        width: 100%;
        border-collapse: collapse;
    }

    #overdue-table th, #overdue-reservation-table th,
    #overdue-table td, #overdue-reservation-table td {
        padding: 0.75rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    #overdue-table th, #overdue-reservation-table th {
        background-color: #f9fafb;
        font-weight: 600;
        color: #4a5568;
    }

    #overdue-table tr:hover, #overdue-reservation-table tr:hover {
        background-color: #f7fafc;
    }

    /* Optional: Style the scrollbar for WebKit browsers */
    #overdue-table::-webkit-scrollbar, #overdue-reservation-table::-webkit-scrollbar {
        width: 0.5rem;
    }

    #overdue-table::-webkit-scrollbar-track, #overdue-reservation-table::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 0.25rem;
    }

    #overdue-table::-webkit-scrollbar-thumb, #overdue-reservation-table::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 0.25rem;
    }

    #overdue-table::-webkit-scrollbar-thumb:hover, #overdue-reservation-table::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>




<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600 no-print">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('homepage') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/sgi-bg.svg') }}" class="h-12" alt="JGC">
        </a>

        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse items-center">
            <!-- Notification Bell with Single Badge for combined notifications -->
            <button type="button" onclick="fetchAndShowNotifications()" aria-label="Open notifications" class="relative focus:outline-none mx-5 p-1 hover:bg-slate-300 hover:rounded-md">
                <svg class="notification-icon size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
                <span id="notification-count" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full transform translate-x-1/2 -translate-y-1/2"></span>
            </button>

            <button class="block w-full md:w-auto text-white bg-green-700 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" onclick="showModal('logout-modal')">
                Logout
            </button>

            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('homepage') }}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
                </li>

                <li class="relative">
                    <button id="dropdownNavbarLink" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                        Reports
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdownNavbar" class="absolute z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownNavbarLink">
                            @if (Auth::user()->name != 'sgi_front_desk') 
                            <li>
                                <a href="{{ route('RoomReportsPage') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Room Occupancy</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('calendarPage') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Calendar</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('CheckInPage') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Check In</a>
                </li>

                @if (Auth::user()->name != 'sgi_front_desk') 
                <li>
                    <a href="#" onclick="showPasswordModal(event, '{{ route('admin_page') }}')" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                        Admin
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<x-modalLarge id="noCheckout-modal" title="Overdue Notifications"
    secondaryButtonAction="document.getElementById('noCheckout-modal').classList.add('hidden'); document.getElementById('noCheckout-modal').classList.remove('flex');"
    secondaryButtonText="Close"
    secondaryButtonClass="bg-slate-500 hover:bg-slate-600 text-white py-1 px-4 rounded"
    primaryButtonClass="bg-blue-700 hover:bg-blue-800 text-white rounded py-1 px-4"
>
    <div class="p-6 text-center">
        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
            You have <span id="notification-count-modal"></span> overdue notifications:
        </h3>
        <div class="mb-6">
            <h4 class="text-md font-semibold text-gray-700 dark:text-gray-300">Overdue Checkouts</h4>
            <div id="overdue-table" class="text-left max-h-40 overflow-y-auto"></div>
        </div>
        <div>
            <h4 class="text-md font-semibold text-gray-700 dark:text-gray-300">Overdue Reservations</h4>
            <div id="overdue-reservation-table" class="text-left max-h-40 overflow-y-auto"></div>
        </div>
    </div>
</x-modalLarge>

<x-modal id="password-modal" title="Enter Password">
    <form id="password-form" onsubmit="handlePasswordSubmit(event)">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Password
        </label>
        <input type="password" id="password" name="password" required
               class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        <input type="hidden" id="redirect-url" />
    </form>
</x-modal>

<x-modal id="logout-modal" title="Logout"
    primaryButtonText="Confirm Logout" primaryButtonAction="document.getElementById('logout-form').submit()"
    secondaryButtonText="Cancel" secondaryButtonAction="document.getElementById('logout-modal').classList.add('hidden')"
    primaryButtonStyle="background-color: #C12320; color: white;">
    <p class="text-gray-900 leading-relaxed text-gray-500 dark:text-gray-400">
        Are you sure you want to logout?
    </p>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</x-modal>
 
  
  <script>
      document.getElementById('dropdownNavbarLink').addEventListener('click', function() {
          var dropdown = document.getElementById('dropdownNavbar');
          dropdown.classList.toggle('hidden');
      });
  
      // Close the dropdown if clicked outside
      document.addEventListener('click', function(event) {
          var isClickInside = document.getElementById('dropdownNavbarLink').contains(event.target) || document.getElementById('dropdownNavbar').contains(event.target);
  
          if (!isClickInside) {
              document.getElementById('dropdownNavbar').classList.add('hidden');
          }
      });
  </script>
  
  <script>
      function showPasswordModal(event, redirectUrl) {
          event.preventDefault(); // Prevent default link behavior
          document.getElementById('redirect-url').value = redirectUrl; // Store the redirect URL
          showModal('password-modal'); // Show the modal
      }
      function handlePasswordSubmit(event) {
          event.preventDefault(); // Prevent form submission
          const password = document.getElementById('password').value;
          const redirectUrl = document.getElementById('redirect-url').value;
  
          // Example password verification (replace with real logic)
          if (password === 'jgc_sgi') {
              window.location.href = redirectUrl; // Redirect to the page
          } else {
              alert('Incorrect password');
          }
      }
  </script>
  
  






  <script>
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            console.log(`Showing modal: ${modalId}`); // Debug log
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            console.error(`Modal ${modalId} not found`);
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            console.log(`Closing modal: ${modalId}`); // Debug log
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function fetchAndUpdateNotifications() {
        const requests = [
            $.ajax({ type: "GET", url: "{{ route('getOverdueCheckouts') }}", dataType: "json" }),
            $.ajax({ type: "GET", url: "{{ route('getOverdueReservations') }}", dataType: "json" })
        ];

        $.when.apply($, requests).done(function (checkoutResponse, reservationResponse) {
            const checkoutCount = checkoutResponse[0].count || 0;
            const reservationCount = reservationResponse[0].count || 0;
            const totalCount = checkoutCount + reservationCount;

            const badge = document.getElementById('notification-count');
            if (badge) {
                badge.textContent = totalCount > 0 ? totalCount : '';
                badge.style.display = totalCount > 0 ? 'inline-flex' : 'none';
            }
        }).fail(function (xhr, status, error) {
            console.error("Error fetching combined notifications:", error);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Failed to fetch notifications!",
            });
        });
    }

    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        if (isNaN(date.getTime())) {
            return 'Invalid Date';
        }
        const formatter = new Intl.DateTimeFormat('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
        });
        return formatter.format(date);
    }

    function fetchAndShowNotifications() {
        const requests = [
            $.ajax({ type: "GET", url: "{{ route('getOverdueCheckouts') }}", dataType: "json" }),
            $.ajax({ type: "GET", url: "{{ route('getOverdueReservations') }}", dataType: "json" })
        ];

        $.when.apply($, requests).done(function (checkoutResponse, reservationResponse) {
            const checkoutCount = checkoutResponse[0].count || 0;
            const checkoutDetails = checkoutResponse[0].details || {};
            const reservationCount = reservationResponse[0].count || 0;
            const reservationDetails = reservationResponse[0].details || {};
            const totalCount = checkoutCount + reservationCount;

            const badge = document.getElementById('notification-count');
            const modalCount = document.getElementById('notification-count-modal');
            const checkoutTable = document.getElementById('overdue-table');
            const reservationTable = document.getElementById('overdue-reservation-table');

            if (badge) {
                badge.textContent = totalCount > 0 ? totalCount : '';
                badge.style.display = totalCount > 0 ? 'inline-flex' : 'none';
            }

            if (modalCount && checkoutTable && reservationTable) {
                modalCount.textContent = totalCount;
                checkoutTable.innerHTML = '';
                reservationTable.innerHTML = '';

                if (checkoutCount > 0) {
                    let checkoutHtml = `
                        <table class="min-w-full divide-y divide-gray-200 text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Folio</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Out</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    `;

                    Object.values(checkoutDetails).forEach(checkout => {
                        checkoutHtml += `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">${checkout.folio_number}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${checkout.full_name}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${checkout.room_number}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${formatDate(checkout.date_out)}</td>
                            </tr>
                        `;
                    });

                    checkoutHtml += `
                            </tbody>
                        </table>
                    `;
                    checkoutTable.innerHTML = checkoutHtml;
                } else {
                    checkoutTable.innerHTML = '<p class="text-gray-500 dark:text-gray-400 text-center">No overdue checkouts found</p>';
                }

                if (reservationCount > 0) {
                    let reservationHtml = `
                        <table class="min-w-full divide-y divide-gray-200 text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Folio</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date In</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    `;

                    Object.values(reservationDetails).forEach(reservation => {
                        reservationHtml += `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">${reservation.folio_number}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${reservation.full_name}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${reservation.room_number}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${formatDate(reservation.date_in)}</td>
                            </tr>
                        `;
                    });

                    reservationHtml += `
                            </tbody>
                        </table>
                    `;
                    reservationTable.innerHTML = reservationHtml;
                } else {
                    reservationTable.innerHTML = '<p class="text-gray-500 dark:text-gray-400 text-center">No overdue reservations found</p>';
                }

                showModal('noCheckout-modal'); // Show the single modal
            }
        }).fail(function (xhr, status, error) {
            console.error("Error fetching notifications:", error);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Failed to fetch notifications!",
            });
        });
    }

    // Initialize on page load and set up periodic updates
    document.addEventListener('DOMContentLoaded', function () {
        fetchAndUpdateNotifications(); // Initial fetch for combined notifications

        // Poll every 10 seconds (10,000 milliseconds)
        setInterval(fetchAndUpdateNotifications, 10000);

        // Ensure badge updates on click (in case it’s stale)
        document.querySelector('.notification-icon').addEventListener('click', fetchAndShowNotifications);
    });
</script>