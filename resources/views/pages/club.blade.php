<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club & Cyber Audio Visualizer - Parsa Besharat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-3 lg:p-8 min-h-screen relative overflow-x-hidden bg-black">

    <!-- MAIN FLOATING WINDOW CONTAINER (MATCHES ALL PAGES EXACTLY) -->
    <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[88vh] z-10 transition-all duration-700 shadow-2xl border border-white/10 animate-page-zoom-in">

        @include('top-header-controls')

        <!-- SIDEBAR INTEGRATED INSIDE CONTAINER -->
        @include('sidebar')

        <!-- MAIN CLUB CONTENT AREA -->
        <main class="flex-1 flex flex-col overflow-hidden relative p-4 pt-12 lg:p-6 lg:pt-14 justify-between bg-black/80 backdrop-blur-2xl animate-page-slide-up">
            
            <!-- TOP BAR HEADER -->
            <div class="flex items-center justify-between pb-3 border-b border-white/10 shrink-0 z-20">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-pink-600 via-purple-600 to-indigo-600 p-0.5 shadow-xl">
                        <div class="w-full h-full bg-black/90 rounded-[14px] flex items-center justify-center text-lg">
                            🎧
                        </div>
                    </div>
                    <div>
                        <h1 class="text-base font-bold text-white tracking-wider flex items-center gap-2">
                            <span>PARSA CYBER CLUB</span>
                            <span class="px-2 py-0.5 bg-pink-500/20 text-pink-400 border border-pink-500/30 rounded-full text-[10px] font-mono font-bold">NEON VISUALIZER</span>
                        </h1>
                        <p class="text-xs text-gray-400 font-mono">Interactive Cyberpunk Synthwave & Audio Studio</p>
                    </div>
                </div>

                <div>
                    <span id="equalizerStatusBadge" class="px-3 py-1 bg-amber-500/20 text-amber-300 border border-amber-500/40 rounded-full text-xs font-mono font-bold">
                        ⏸️ Audio Ready (Click Play)
                    </span>
                </div>
            </div>

            <!-- CANVAS AUDIO VISUALIZER AREA -->
            <div class="relative flex-1 rounded-3xl overflow-hidden border border-white/10 bg-black/90 shadow-2xl my-3 flex items-center justify-center">
                <canvas id="clubCanvas" class="absolute inset-0 w-full h-full z-0"></canvas>

                <!-- CENTER FLOATING CLUB ALBUM BADGE -->
                <div class="relative z-10 text-center space-y-4 p-6 bg-black/50 backdrop-blur-md rounded-3xl border border-white/15 max-w-sm shadow-2xl animate-scale-up">
                    <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-tr from-pink-500 via-purple-500 to-cyan-500 p-1 shadow-2xl animate-spin-slow">
                        <img src="{{ asset('images/profile.jpg') }}" class="w-full h-full rounded-full object-cover border-2 border-black">
                    </div>

                    <div>
                        <h2 class="text-lg font-extrabold text-white tracking-wide">Cyber Synthwave Beats</h2>
                        <p class="text-xs text-gray-300 font-mono pt-1">Parsa Besharat • Live Audio Stream</p>
                    </div>

                    <!-- PLAYER CONTROLS -->
                    <div class="flex items-center justify-center space-x-3 pt-2">
                        <button id="btnPlayClub" onclick="toggleClubAudio()" class="px-6 py-2.5 bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white font-bold rounded-2xl text-xs shadow-xl transition transform active:scale-95 flex items-center space-x-2">
                            <span>▶</span>
                            <span>Play Cyber Music</span>
                        </button>
                        
                        <button id="btnPauseClub" onclick="toggleClubAudio()" class="hidden px-6 py-2.5 bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-500 hover:to-red-500 text-white font-bold rounded-2xl text-xs shadow-xl transition transform active:scale-95 flex items-center space-x-2">
                            <span>⏸</span>
                            <span>Pause Music</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- AUDIO ELEMENT -->
            <audio id="audioTrack" src="{{ asset('main.mp3') }}" loop></audio>

            <!-- FOOTER INFO -->
            <div class="p-3 bg-black/60 border border-white/10 rounded-2xl flex items-center justify-between shrink-0 z-20 text-xs font-mono text-gray-400">
                <span>🔊 Audio: <strong class="text-white">main.mp3</strong></span>
                <span>✨ Move cursor or tap canvas to interact with neon particles</span>
            </div>

        </main>
    </div>

    <!-- Taskbar & Mac Window Controls -->
    @include('taskbar')
    <script src="{{ asset('js/mac-window-controls.js') }}"></script>
    <script type="module" src="{{ asset('js/club.js') }}"></script>

</body>
</html>