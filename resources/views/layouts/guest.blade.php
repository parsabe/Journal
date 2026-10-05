<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Parsa Besharat') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="icon" href="{{ asset('images/profile.jpg') }}">
    </head>
    <body class="text-gray-800 antialiased flex items-center justify-center p-4 lg:p-10 min-h-screen relative overflow-x-hidden">
        
        <div id="main-container" class="ios-glass relative w-full max-w-xl flex flex-col rounded-[2.5rem] overflow-hidden p-6 md:p-10 z-10 transition-colors duration-700 shadow-2xl">
            
            <!-- Top Controls Header -->
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-white/20">
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/profile.jpg') }}" alt="Parsa Besharat" class="w-10 h-10 rounded-full border-2 border-white/40 shadow-sm object-cover object-[50%_25%] group-hover:scale-105 transition-transform">
                    <div>
                        <h2 class="text-base font-bold tracking-tight text-gray-900 group-hover:text-orange-500 transition-colors">Parsa Besharat</h2>
                        <p class="text-xs text-gray-600">Researcher & AI Engineer</p>
                    </div>
                </a>

                <div class="flex items-center gap-3">
                    <a href="/" class="px-3.5 py-1.5 rounded-full ios-glass text-xs font-bold text-gray-900 hover:bg-white/40 transition">
                        🏠 Home
                    </a>
                </div>
            </div>

            <!-- Page Main Content Slot -->
            <div class="w-full">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-8 pt-4 text-center text-xs text-gray-500 border-t border-white/10">
                &copy; {{ date('Y') }} Parsa Besharat. All rights reserved.
            </div>

        </div>

    <!-- Taskbar & Mac Window Controls -->
    @include('taskbar')
    <script src="{{ asset('js/mac-window-controls.js') }}"></script>
    </body>
</html>
