<x-guest-layout>
    <div class="mb-6">
        <span class="inline-flex items-center gap-2 px-3 py-1 ios-glass text-orange-600 rounded-full text-xs font-bold mb-3">
            🔐 ACCOUNT ACCESS
        </span>
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 drop-shadow-sm">
            Welcome Back
        </h1>
        <p class="mt-2 text-sm text-gray-600 leading-relaxed font-medium">
            Please log in with your credentials to access your account dashboard.
        </p>
    </div>

    <!-- Session Status Alert -->
    @if (session('status'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 text-sm font-medium flex items-center gap-3">
            <span class="text-base">✅</span>
            <div>{{ session('status') }}</div>
        </div>
    @endif

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-700 text-sm font-medium">
            <div class="flex items-center gap-2 mb-1 font-bold">
                <span>⚠️</span> Authentication Error:
            </div>
            <ul class="list-disc list-inside space-y-1 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                Email Address
            </label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="yourname@example.com"
                   class="w-full px-4 py-3 rounded-2xl bg-white/60 border border-white/40 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/50 transition-all font-medium">
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="text-xs font-bold text-orange-600 hover:text-orange-500 hover:underline">
                        Forgot Password?
                    </a>
                @endif
            </div>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full px-4 py-3 rounded-2xl bg-white/60 border border-white/40 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/50 transition-all font-medium">
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" 
                       type="checkbox" 
                       name="remember"
                       class="rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-500">
                <span class="ms-2 text-xs font-semibold text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" 
                    class="w-full py-3.5 bg-gradient-to-r from-orange-500 via-rose-600 to-pink-600 hover:from-orange-600 hover:to-pink-700 text-white font-bold rounded-2xl shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition transform border border-white/20 text-sm">
                Log In
            </button>
        </div>

        @if (Route::has('register'))
            <div class="text-center pt-3 border-t border-gray-200">
                <span class="text-xs text-gray-600">Don't have an account? </span>
                <a href="{{ route('register') }}" class="text-xs font-bold text-orange-600 hover:text-orange-500 hover:underline">
                    Create an account
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
