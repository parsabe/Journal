<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS Feedback Dashboard - Parsa Besharat</title>

    <meta name="robots" content="noindex, nofollow">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        window.tailwind = { config: { darkMode: 'class' } };
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
</head>

<body
    class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-4 lg:p-10 min-h-screen relative overflow-x-hidden">

    <div id="main-container"
        class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[85vh] z-10 transition-colors duration-700">

        <!-- Theme Switcher & Dots -->

        <div class="absolute top-6 right-8 flex items-center gap-5 z-50">
            <div class="flex gap-2">
                <div class="w-3.5 h-3.5 rounded-full bg-[#ff5f56] shadow-sm border border-[#e0443e]"></div>
                <div class="w-3.5 h-3.5 rounded-full bg-[#ffbd2e] shadow-sm border border-[#dea123]"></div>
                <div class="w-3.5 h-3.5 rounded-full bg-[#27c93f] shadow-sm border border-[#1aab29]"></div>
            </div>
        </div>

        @include('sidebar')

        <main class="flex-1 p-8 lg:p-14 relative overflow-y-auto scroll-smooth">
            <div class="relative z-10 mt-12 lg:mt-0">
                <div>
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 ios-glass text-gray-900 dark:text-white rounded-full text-sm font-bold mb-6">
                        🔒 ADMIN CONTROL PANEL
                    </span>

                    <h1
                        class="text-4xl lg:text-5xl font-extrabold mb-4 tracking-tight text-gray-900 dark:text-white drop-shadow-sm">
                        CS Portal <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600 dark:from-orange-400 dark:to-pink-500">Submissions.</span>
                    </h1>

                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-8 font-medium">
                        Welcome, Parsa. Here are the ideas, feedback, and questions submitted by the Campus Specialists.
                    </p>

                    <!-- Stats Bar -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                        <div class="p-5 rounded-2xl bg-white/40 dark:bg-black/30 border border-white/20 dark:border-white/10 shadow-sm flex flex-col justify-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Total Submissions</span>
                            <span class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $feedbacks->count() }}</span>
                        </div>
                        <div class="p-5 rounded-2xl bg-white/40 dark:bg-black/30 border border-white/20 dark:border-white/10 shadow-sm flex flex-col justify-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Received All Files</span>
                            <span class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-1">
                                {{ $feedbacks->where('received_all_files', true)->count() }}
                            </span>
                        </div>
                        <div class="p-5 rounded-2xl bg-white/40 dark:bg-black/30 border border-white/20 dark:border-white/10 shadow-sm flex flex-col justify-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Missing Files</span>
                            <span class="text-3xl font-extrabold text-rose-600 dark:text-rose-400 mt-1">
                                {{ $feedbacks->where('received_all_files', false)->count() }}
                            </span>
                        </div>
                    </div>

                    <!-- Search Input -->
                    <div class="mb-6 relative">
                        <input id="search-input" type="text" placeholder="Search by name, email, or content..."
                            class="w-full px-5 py-3.5 pl-12 bg-white/40 dark:bg-black/30 border border-gray-300 dark:border-white/10 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:focus:ring-orange-400 transition-all font-medium">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-lg">🔍</span>
                        </div>
                    </div>

                    <!-- Feedback List -->
                    <div class="space-y-6" id="feedback-list">
                        @forelse($feedbacks as $item)
                            <div class="feedback-card p-6 rounded-2xl bg-white/50 dark:bg-black/40 border border-white/30 dark:border-white/10 hover:border-orange-500/50 dark:hover:border-orange-400/50 shadow-md transition-all duration-300"
                                data-searchable="{{ strtolower(($item->student ? ($item->student->first_name . ' ' . $item->student->last_name . ' ' . $item->student->email) : ('did not show up ' . $item->email)) . ' ' . $item->ideas . ' ' . $item->feedback . ' ' . $item->questions) }}">
                                
                                <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-gray-200 dark:border-white/10">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                            {{ $item->student ? ($item->student->first_name . ' ' . $item->student->last_name) : 'Campus Specialist' }}
                                            @if(!$item->student)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                                    Did Not Show Up
                                                </span>
                                            @endif
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 font-medium">
                                            {{ $item->student ? $item->student->email : $item->email }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        @if($item->received_all_files)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                                                ✅ Received All Files
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/20">
                                                ❌ Missing/Corrupted Files
                                            </span>
                                        @endif
                                        <span class="text-xs text-gray-400 dark:text-gray-500 font-semibold uppercase">
                                            {{ $item->created_at->format('M d, Y H:i') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
                                    <!-- Ideas Section -->
                                    <div class="space-y-1.5">
                                        <h4 class="text-xs font-bold tracking-wider text-gray-400 dark:text-gray-500 uppercase">Ideas</h4>
                                        <div class="text-sm text-gray-700 dark:text-gray-300 font-medium leading-relaxed bg-white/20 dark:bg-black/10 p-3.5 rounded-xl border border-white/10 dark:border-white/5 whitespace-pre-wrap">
                                            {{ $item->ideas ?: 'None provided.' }}
                                        </div>
                                    </div>

                                    <!-- Feedback Section -->
                                    <div class="space-y-1.5">
                                        <h4 class="text-xs font-bold tracking-wider text-gray-400 dark:text-gray-500 uppercase">General Feedback</h4>
                                        <div class="text-sm text-gray-700 dark:text-gray-300 font-medium leading-relaxed bg-white/20 dark:bg-black/10 p-3.5 rounded-xl border border-white/10 dark:border-white/5 whitespace-pre-wrap">
                                            {{ $item->feedback ?: 'None provided.' }}
                                        </div>
                                    </div>

                                    <!-- Questions Section -->
                                    <div class="space-y-1.5">
                                        <h4 class="text-xs font-bold tracking-wider text-gray-400 dark:text-gray-500 uppercase">Questions</h4>
                                        <div class="text-sm text-gray-700 dark:text-gray-300 font-medium leading-relaxed bg-white/20 dark:bg-black/10 p-3.5 rounded-xl border border-white/10 dark:border-white/5 whitespace-pre-wrap">
                                            {{ $item->questions ?: 'None provided.' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 p-6 rounded-2xl bg-white/40 dark:bg-black/30 border border-white/20 dark:border-white/10">
                                <span class="text-3xl block mb-2">📭</span>
                                <span class="text-gray-500 dark:text-gray-400 font-semibold text-sm">No feedback submitted yet.</span>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </main>

    </div>

    <!-- External ESM Javascript Module -->
    <script type="module" src="{{ asset('js/cs-admin.js') }}"></script>
</body>

</html>
