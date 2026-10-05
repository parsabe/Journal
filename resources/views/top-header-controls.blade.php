<!-- TOP-RIGHT HEADER CONTROLS (LOGIN, SIGN UP, THEME TOGGLE & MACOS DOTS) -->
<div class="absolute top-4 right-6 flex items-center gap-2.5 z-50">
    @auth
        <span class="text-[11px] font-semibold text-gray-700 dark:text-gray-300 hidden sm:inline-flex items-center gap-1">
            👤 {{ Auth::user()->name }}
        </span>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="px-2.5 py-1 rounded-full bg-rose-950/80 hover:bg-rose-900 text-rose-300 text-[11px] font-semibold border border-rose-500/30 transition transform hover:scale-105 active:scale-95 shadow-sm">
                Logout
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="px-3 py-1 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white text-[11px] font-bold shadow-md transition transform hover:scale-105 active:scale-95 flex items-center gap-1">
            🔑 <span>Login</span>
        </a>
        <a href="{{ route('register') }}" class="px-3 py-1 rounded-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white text-[11px] font-bold shadow-md transition transform hover:scale-105 active:scale-95 flex items-center gap-1">
            ✨ <span>Sign Up</span>
        </a>
    @endauth

    <!-- LANGUAGE SWITCHER (EN / DE) -->
    @php
        $currentLocale = session('app_locale', app()->getLocale());
    @endphp
    @if($currentLocale === 'de')
        <a href="{{ route('lang.switch', 'en') }}" class="px-2.5 py-1 rounded-full bg-slate-800/80 hover:bg-slate-700 text-amber-300 border border-amber-500/30 text-[11px] font-bold shadow-sm transition transform hover:scale-105" title="Switch to English (EN)">
            🇬🇧 EN
        </a>
    @else
        <a href="{{ route('lang.switch', 'de') }}" class="px-2.5 py-1 rounded-full bg-slate-800/80 hover:bg-slate-700 text-amber-300 border border-amber-500/30 text-[11px] font-bold shadow-sm transition transform hover:scale-105" title="Auf Deutsch wechseln (DE)">
            🇩🇪 DE
        </a>
    @endif

    <div class="flex gap-1.5 items-center pl-1">
        <div class="mac-dot-red w-3 h-3 rounded-full bg-[#ff5f56] shadow-sm border border-[#e0443e] cursor-pointer hover:opacity-80 transition transform hover:scale-110" title="Close Window"></div>
        <div class="mac-dot-yellow w-3 h-3 rounded-full bg-[#ffbd2e] shadow-sm border border-[#dea123] cursor-pointer hover:opacity-80 transition transform hover:scale-110" title="Minimize Window"></div>
        <div class="mac-dot-green w-3 h-3 rounded-full bg-[#27c93f] shadow-sm border border-[#1aab29] cursor-pointer hover:opacity-80 transition transform hover:scale-110" title="Maximize Window"></div>
    </div>
</div>

<!-- GLOBAL REACT-TOASTIFY NOTIFICATION AUDIO & VISUAL ENGINE -->
<script type="module" src="{{ asset('js/toast-notifications.js') }}"></script>

<!-- SMART GERMAN TRANSLATOR ENGINE -->
<script>
    window.APP_LOCALE = "{{ session('app_locale', app()->getLocale()) }}";
</script>
<script type="module" src="{{ asset('js/german-translator.js') }}"></script>
