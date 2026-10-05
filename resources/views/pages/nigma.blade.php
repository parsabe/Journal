<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edward Nigma Cryptographic Portal - Parsa Besharat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/nigma.css') }}">
</head>

<body class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-3 lg:p-8 min-h-screen relative overflow-x-hidden">

    <!-- MAIN FLOATING WINDOW CONTAINER (MATCHES HOMEPAGE & CHAT EXACTLY) -->
    <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[88vh] z-10 transition-all duration-700 shadow-2xl border border-emerald-500/20 animate-page-zoom-in">

        @include('top-header-controls')

        <!-- SIDEBAR INTEGRATED INSIDE CONTAINER -->
        @include('sidebar')

        <!-- MAIN NIGMA PORTAL CONTENT -->
        <main class="flex-1 flex flex-col overflow-y-auto relative p-6 pt-12 lg:p-8 lg:pt-14 matrix-bg gap-6 animate-page-slide-up">
            
            <!-- INSTAGRAM STORIES BAR -->
            @include('stories_bar')

            @if(!$authenticated)
                <!-- AUTHENTICATION GATE WITH 2FA ENFORCEMENT -->
                <div class="flex-1 flex flex-col items-center justify-center p-6 text-center animate-scale-up">
                    <div class="w-20 h-20 mb-4 rounded-full bg-gradient-to-tr from-emerald-600 via-teal-600 to-green-600 flex items-center justify-center text-3xl shadow-2xl animate-bounce">
                        ❓
                    </div>
                    <h2 class="text-2xl font-extrabold text-emerald-400 mb-1 tracking-tight font-mono">Edward Nigma Portal</h2>
                    <p class="text-xs text-emerald-300/80 max-w-sm mb-6 font-medium font-mono">Guest access is disabled. Log in or create an account with 2FA protection to solve Riddler ciphers.</p>

                    <div class="w-full max-w-md bg-black/60 p-6 rounded-3xl border border-emerald-500/30 shadow-2xl backdrop-blur-xl">
                        <div class="flex rounded-2xl bg-white/5 p-1 mb-5 text-xs font-semibold font-mono">
                            <button id="gateLoginTab" onclick="switchGateTab('login')" class="flex-1 py-2.5 rounded-xl bg-emerald-600 text-black font-bold shadow-md">Log In</button>
                            <button id="gateRegisterTab" onclick="switchGateTab('register')" class="flex-1 py-2.5 rounded-xl text-emerald-400">Sign Up</button>
                        </div>

                        <form id="gateLoginForm" method="POST" action="{{ route('login') }}" class="space-y-3.5 text-left text-xs font-mono">
                            @csrf
                            <input type="hidden" name="redirect" value="{{ url()->current() }}">
                            <div>
                                <label class="block text-emerald-400 mb-1 font-medium">Email Address</label>
                                <input type="email" name="email" required class="w-full bg-black/60 border border-emerald-500/40 rounded-xl px-3.5 py-2.5 text-emerald-300 focus:outline-none focus:border-emerald-400">
                            </div>
                            <div>
                                <label class="block text-emerald-400 mb-1 font-medium">Password</label>
                                <input type="password" name="password" required class="w-full bg-black/60 border border-emerald-500/40 rounded-xl px-3.5 py-2.5 text-emerald-300 focus:outline-none focus:border-emerald-400">
                            </div>
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-black font-bold rounded-xl shadow-lg">
                                Log In to Nigma
                            </button>
                        </form>

                        <form id="gateRegisterForm" method="POST" action="{{ route('register') }}" class="hidden space-y-3.5 text-left text-xs font-mono">
                            @csrf
                            <div>
                                <label class="block text-emerald-400 mb-1 font-medium">Full Name</label>
                                <input type="text" name="name" required class="w-full bg-black/60 border border-emerald-500/40 rounded-xl px-3.5 py-2.5 text-emerald-300 focus:outline-none focus:border-emerald-400">
                            </div>
                            <div>
                                <label class="block text-emerald-400 mb-1 font-medium">Email Address</label>
                                <input type="email" name="email" required class="w-full bg-black/60 border border-emerald-500/40 rounded-xl px-3.5 py-2.5 text-emerald-300 focus:outline-none focus:border-emerald-400">
                            </div>
                            <div>
                                <label class="block text-emerald-400 mb-1 font-medium">Password</label>
                                <input type="password" name="password" required class="w-full bg-black/60 border border-emerald-500/40 rounded-xl px-3.5 py-2.5 text-emerald-300 focus:outline-none focus:border-emerald-400">
                            </div>
                            <div>
                                <label class="block text-emerald-400 mb-1 font-medium">Confirm Password</label>
                                <input type="password" name="password_confirmation" required class="w-full bg-black/60 border border-emerald-500/40 rounded-xl px-3.5 py-2.5 text-emerald-300 focus:outline-none focus:border-emerald-400">
                            </div>
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-black font-bold rounded-xl shadow-lg">
                                Register with 2FA Protection
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- AUTHENTICATED NIGMA PORTAL -->
                <div class="flex items-center justify-between border-b border-emerald-500/30 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-3xl shadow-lg shadow-emerald-500/20">
                            ❓
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold tracking-tight text-emerald-400 nigma-glow-text font-mono flex items-center gap-2">
                                EDWARD NIGMA CRYPTOGRAPHIC PORTAL
                                <span class="text-[10px] uppercase font-mono px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/40">20 RIDDLES ACTIVE</span>
                            </h1>
                            <p class="text-xs text-emerald-400/80 font-mono">Encrypted Transmissions, Cryptographic Puzzles & Riddles (+15 CP in Sandika)</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1.5 bg-black/60 border border-emerald-500/40 rounded-xl text-xs font-mono text-emerald-300">
                            Solved: <strong class="text-emerald-400 font-bold">{{ $totalSolved ?? 0 }}</strong> / 20
                        </span>
                    </div>
                </div>

                <!-- ACTIVE RIDDLER DECODER CARD -->
                <div class="nigma-emerald-card p-6 rounded-3xl backdrop-blur-xl">
                    <input type="hidden" id="active-riddle-id" value="{{ $puzzles[0]->id ?? 1 }}">

                    <h2 id="active-riddle-title" class="text-base font-bold text-emerald-400 font-mono mb-2 flex items-center gap-2">
                        [ {{ $puzzles[0]->title ?? 'Riddle 1' }} ]
                    </h2>

                    <div class="p-4 bg-black/70 border border-emerald-500/40 rounded-2xl mb-4 font-mono">
                        <div id="active-riddle-text" class="text-sm text-emerald-200 italic mb-2">
                            "{{ $puzzles[0]->riddle ?? 'I have no voice, yet I speak to many...' }}"
                        </div>
                        <div class="text-[11px] text-emerald-600 dark:text-emerald-400/70">
                            Cipher Method: <span id="active-riddle-cipher" class="text-emerald-400 font-bold">{{ $puzzles[0]->cipher_type ?? 'Caesar Shift' }}</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <input type="text" id="nigma-answer-input" placeholder="Type solution answer key (e.g. book, footsteps, silence)..."
                            class="w-full bg-black/60 border border-emerald-500/40 rounded-xl px-4 py-3 text-sm text-emerald-300 placeholder-emerald-800 font-mono focus:outline-none focus:border-emerald-400 shadow-inner">
                        
                        <button id="btn-solve-riddle" class="w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-black font-mono font-bold text-xs rounded-xl shadow-lg shadow-emerald-500/20 active:scale-95 transition-all">
                            SUBMIT SOLUTION (+15 CP TO SANDIKA)
                        </button>

                        <div id="nigma-result" class="text-xs min-h-[20px]"></div>
                    </div>
                </div>

                <!-- ALL 20 RIDDLES ARCHIVE LIST -->
                <div class="nigma-emerald-card p-6 rounded-3xl space-y-4">
                    <h3 class="text-sm font-bold text-emerald-400 font-mono flex items-center justify-between">
                        <span>📜 20 RIDDLER TRANSMISSION ARCHIVE (Click any riddle to solve)</span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($puzzles as $p)
                            <div class="riddle-select-item p-3 bg-black/50 hover:bg-emerald-950/40 border border-emerald-500/30 cursor-pointer rounded-xl flex items-center justify-between font-mono text-xs transition-all group"
                                data-id="{{ $p->id }}" data-title="{{ $p->title }}" data-text="{{ $p->riddle }}" data-cipher="{{ $p->cipher_type }}">
                                <div class="truncate mr-2">
                                    <span class="text-emerald-300 group-hover:text-emerald-200 font-bold block truncate">{{ $p->title }}</span>
                                    <span class="text-[10px] text-emerald-600 block">{{ $p->cipher_type }}</span>
                                </div>
                                <div class="shrink-0">
                                    @if($p->is_solved)
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 text-[10px]">SOLVED</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-amber-500/20 text-amber-400 border border-amber-500/40 text-[10px]">UNSOLVED</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </main>

    </div>

    <script>
        function switchGateTab(tab) {
            const loginForm = document.getElementById('gateLoginForm');
            const regForm = document.getElementById('gateRegisterForm');
            const loginTab = document.getElementById('gateLoginTab');
            const regTab = document.getElementById('gateRegisterTab');

            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                regForm.classList.add('hidden');
                loginTab.classList.add('bg-emerald-600', 'text-black');
                loginTab.classList.remove('text-emerald-400');
                regTab.classList.remove('bg-emerald-600', 'text-black');
                regTab.classList.add('text-emerald-400');
            } else {
                regForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
                regTab.classList.add('bg-emerald-600', 'text-black');
                regTab.classList.remove('text-emerald-400');
                loginTab.classList.remove('bg-emerald-600', 'text-black');
                loginTab.classList.add('text-emerald-400');
            }
        }
    </script>

    <!-- Taskbar & Mac Window Controls -->
    @include('taskbar')
    <script src="{{ asset('js/mac-window-controls.js') }}"></script>
    <script type="module" src="{{ asset('js/nigma.js') }}"></script>
</body>
</html>
