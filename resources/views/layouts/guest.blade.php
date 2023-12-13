<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-onyx-600 antialiased">
        <div class="min-h-screen flex flex-row p-6 bg-gray-100 dark:bg-gray-950">
            <div class="w-1/2 p-5 m-5">
                <div class="flex flex-col sm:max-w-screen-md p-5 justify-center">
                    <a href="/" class="w-2/3 h-2/3 flex-auto">
                        <x-application-logo class="fill-current text-congo_pink-600" />
                        <br>
                        <p class="text-lg text-center text-deep_peach-600">
                            Connect. Discuss. Thrive.
                        </p>
                    </a>
                </div>
            </div>
            
            <div class="w-1/2 sm:max-w-screen-md p-5 bg-white dark:bg-gray-600 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
