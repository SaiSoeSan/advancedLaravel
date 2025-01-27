<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>   

        @vite('resources/css/app.css','resources/js/app.js')
    
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen">
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex flex-col justify-center items-center">
                    <h1 class="font-light text-8xl">MyGym</h1>
                    <div class="mt-8">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Log In</a>
                        @endauth
                    @endif
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>
