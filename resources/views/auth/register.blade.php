<x-guest-layout>
    <div class="mb-6">
        <span class="inline-flex items-center gap-2 px-3 py-1 ios-glass text-orange-600 rounded-full text-xs font-bold mb-3">
            ✨ CREATE ACCOUNT
        </span>
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 drop-shadow-sm">
            Register Account
        </h1>
        <p class="mt-2 text-sm text-gray-600 leading-relaxed font-medium">
            Create an account to access special member features and tools.
        </p>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-700 text-sm font-medium">
            <div class="flex items-center gap-2 mb-1 font-bold">
                <span>⚠️</span> Registration Error:
            </div>
            <ul class="list-disc list-inside space-y-1 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                Full Name
            </label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   placeholder="Your Name"
                   class="w-full px-4 py-3 rounded-2xl bg-white/60 border border-white/40 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/50 transition-all font-medium">
        </div>

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
                   autocomplete="username"
                   placeholder="yourname@example.com"
                   class="w-full px-4 py-3 rounded-2xl bg-white/60 border border-white/40 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/50 transition-all font-medium">
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                Password
            </label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   placeholder="••••••••"
                   class="w-full px-4 py-3 rounded-2xl bg-white/60 border border-white/40 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/50 transition-all font-medium">
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">
                Confirm Password
            </label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="••••••••"
                   class="w-full px-4 py-3 rounded-2xl bg-white/60 border border-white/40 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/50 transition-all font-medium">
        </div>

        <div class="pt-2">
            <button type="submit" 
                    class="w-full py-3.5 bg-gradient-to-r from-orange-500 via-rose-600 to-pink-600 hover:from-orange-600 hover:to-pink-700 text-white font-bold rounded-2xl shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition transform border border-white/20 text-sm">
                Create Account
            </button>
        </div>

        <div class="text-center pt-3 border-t border-gray-200">
            <span class="text-xs text-gray-600">Already registered? </span>
            <a href="{{ route('login') }}" class="text-xs font-bold text-orange-600 hover:text-orange-500 hover:underline">
                Log In
            </a>
        </div>
    </form>
</x-guest-layout>
