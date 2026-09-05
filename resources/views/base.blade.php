<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{asset('images/LogoDarkJGC.png') }}">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/datatable.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
    
    <style>
          #loading-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); 
        z-index: 9999; 
        display: flex;
        justify-content: center;
        align-items: center;
      }
      
      #loader {
        border: 23px solid #f3f3f3;
        border-radius: 50%;
        border-top: 23px solid #5EA061;
        width: 8.5rem;
        height: 8.5rem;
        animation: spin 1.3s linear infinite;
      }

      @media print {
        .no-print {
            display: none;
        }
        .containers {
            margin-top: 0 !important; /* Remove the margin-top specifically for print */
        }
    }
      
      @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
      }


        </style>
    @stack('styles')
</head>
<body style="background-color: #EFEDE7;">


    <div id="loading-container">
        <div id="loader" class="center"></div>
    </div>
      

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Page content -->
    <div class="containers mt-20">
        @yield('content')
    </div>




    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/ajax.js')}}"></script>
    <script src="{{ asset('js/sweetalert2.js')}}"></script>
    <script src="{{ asset('js/datatable.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>


    <script>
        document.onreadystatechange = function () {
            if (document.readyState !== "complete") {
                document.querySelector("body").style.visibility = "hidden";
                document.querySelector("#loading-container").style.visibility = "visible";
            } else {
                document.querySelector("#loading-container").style.display = "none";
                document.querySelector("body").style.visibility = "visible";
            }
        };
    </script>

   @stack('scripts')
</body>
</html>



