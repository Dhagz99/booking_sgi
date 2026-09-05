
    
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>Laravel</title>
      @vite('resources/css/app.css')
    </head>
    <body>

    
    <section class="bg-gray-900 dark:bg-gray-200 h-screen" 
    style="background-image: url('{{ asset('images/build16.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">

            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 shadow-xl">
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <div class="flex justify-center">
                            <img src="{{ asset('images/jgc.png')}}" height="160" width="160">
                          
                        </div>
        
                        <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="post">
                            @csrf <!-- CSRF Token -->
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium dark:text-white text-green-800 font-semibold">Username</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username..." required>
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-green-800 font-semibold">Password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                            {{-- <div class="w-2/6 flex mx-auto">
                                <p class="text-center cursor-pointer text-blue-900 font-semibold hover:bg-blue-300 rounded p-2">USE QR CODE</p>
                            </div> --}}
                            
                            <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    
    </body>
    </html>
    
    <script>
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
    
    
</body>
</html>