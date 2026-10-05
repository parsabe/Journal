<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} | Articles - Parsa Besharat </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
</head>

<body
    class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-3 lg:p-8 min-h-screen relative overflow-x-hidden">
    <div id="main-container"
        class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[88vh] z-10 transition-all duration-700 shadow-2xl border border-white/10 animate-page-zoom-in">

        @include('top-header-controls')
        @include('sidebar')

        <main
            class="flex-1 flex flex-col overflow-y-auto relative p-6 pt-12 lg:p-10 lg:pt-14 bg-black/30 gap-6 animate-page-slide-up">

            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <a href="{{ route('blog') }}"
                    class="px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-white/20 text-gray-200 text-xs font-semibold flex items-center gap-1.5 transition">
                    <span>←</span>
                    <span>{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Zurück zum Blog' : 'Back to Blog' }}</span>
                </a>
                <span
                    class="text-[10px] uppercase font-mono px-3 py-1 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Published' }}
                </span>
            </div>

            <article class="space-y-6 max-w-4xl mx-auto w-full">
                <h1 class="text-3xl lg:text-4xl font-extrabold text-white tracking-tight drop-shadow-md">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center space-x-3 text-xs text-gray-400 font-mono pb-2 border-b border-white/10">
                    <img src="{{ $post->author->avatar ? asset($post->author->avatar) : asset('images/profile.jpg') }}"
                        class="w-8 h-8 rounded-full border border-white/20 object-cover">
                    <div>
                        <span class="text-white font-bold block">{{ $post->author->name ?? 'Parsa Besharat' }}</span>
                        <span>Author & Researcher</span>
                    </div>
                </div>

                @if($post->cover_image)
                    <div class="rounded-3xl overflow-hidden border border-white/10 shadow-2xl max-h-96 w-full">
                        <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="blog-content text-sm text-slate-200 leading-relaxed space-y-4 pt-2">
                    {!! $post->content !!}
                </div>
            </article>

            <footer class="mt-12 pt-6 border-t border-white/10 text-center text-xs text-gray-400 font-mono">
                &copy; {{ date('Y') }} Parsa Besharat Publications • All Rights Reserved.
            </footer>

        </main>
    </div>

    @include('taskbar')
    <script src="{{ asset('js/mac-window-controls.js') }}"></script>
</body>

</html>