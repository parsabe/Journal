<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>arthur morgan - Parsa Besharat Publications</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.tailwind = { config: { darkMode: "class" } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(["resources/css/app.css", "resources/js/app.js"])
    <link rel="icon" href="{{ asset("images/profile.jpg") }}">
    <link rel="stylesheet" href="{{ asset("css/blog.css") }}">
</head>
<body class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-3 lg:p-8 min-h-screen relative overflow-x-hidden">
    <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[88vh] z-10 transition-all duration-700 shadow-2xl border border-white/10 animate-page-zoom-in">
        @include("top-header-controls")
        @include("sidebar")
        <main class="flex-1 flex flex-col overflow-y-auto relative p-6 pt-12 lg:p-10 lg:pt-14 bg-black/40 gap-6 animate-page-slide-up">
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <a href="/blog" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                    <span>← Back to Blog</span>
                </a>
                <span class="text-xs text-indigo-400 font-mono font-bold uppercase">Publication Article</span>
            </div>
            
            <article class="max-w-3xl mx-auto w-full space-y-6">
                <img src="https://parsabe.com/storage/blog_covers/GxVpRVcnmYt2oZyU3GjD1YmA19eECjnifW3tsV0i.jpg" class="w-full max-h-72 object-cover rounded-3xl border border-white/15 shadow-2xl">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-extrabold text-white tracking-wide leading-tight mb-2">arthur morgan</h1>
                    <div class="flex items-center gap-3 text-xs text-gray-400 font-mono border-b border-white/10 pb-4">
                        <span>Published by <strong class="text-white">Parsa Besharat</strong></span>
                        <span>•</span>
                        <span>Jul 30, 2026</span>
                    </div>
                </div>
                
                <div class="blog-content text-sm text-slate-200 leading-relaxed font-sans space-y-4">
                    <ul><li><b>fuck you - instead i need you&nbsp;</b></li><li><b>fgfdggdfsfe <u>fsdfsef</u></b></li></ul>
                </div>
            </article>
        </main>
    </div>
    @include("taskbar")
    <script src="{{ asset("js/mac-window-controls.js") }}"></script>
</body>
</html>