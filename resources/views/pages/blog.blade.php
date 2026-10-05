<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rich Text Blog - Parsa Besharat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
</head>

<body class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-3 lg:p-8 min-h-screen relative overflow-x-hidden">

    <!-- MAIN FLOATING WINDOW CONTAINER (MATCHES HOMEPAGE & CHAT EXACTLY) -->
    <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[88vh] z-10 transition-all duration-700 shadow-2xl border border-white/10 animate-page-zoom-in">

        @include('top-header-controls')

        <!-- SIDEBAR INTEGRATED INSIDE CONTAINER -->
        @include('sidebar')

        <!-- MAIN BLOG CONTENT AREA -->
        <main class="flex-1 flex flex-col overflow-y-auto relative p-6 pt-12 lg:p-8 lg:pt-14 bg-black/30 gap-6 animate-page-slide-up">
            
            <!-- Header Title -->
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 flex items-center justify-center text-2xl shadow-lg">
                        ✍️
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-white flex items-center gap-2">
                            {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'PARSABE JOURNALE & FORSCHUNGSCHRONIK' : 'PARSABE JOURNALS & RESEARCH CHRONICLES' }}
                        </h1>
                        <p class="text-xs text-gray-400">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Rich-Text-Veröffentlichung, Technische KI-Einblicke & Journale' : 'Rich Text Publishing, Technical AI Insights & Journals' }}</p>
                    </div>
                </div>
            </div>

            <!-- 1. PRIMARY PUBLISHED ARTICLES LIST -->
            <div class="space-y-6">
                @forelse($posts as $post)
                    <article class="blog-card p-6 rounded-3xl flex flex-col md:flex-row gap-6 items-start transition hover:border-indigo-500/40">
                        @if($post->cover_image)
                            <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="w-full md:w-48 h-32 object-cover rounded-2xl border border-white/10 shadow-md">
                        @endif
                        <div class="flex-1 space-y-2">
                            <div class="flex items-center gap-3">
                                <span class="text-[10px] uppercase font-mono px-2.5 py-0.5 rounded-full bg-indigo-500/20 text-indigo-400 border border-indigo-500/30">
                                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Recent' }}
                                </span>
                                <span class="text-xs text-gray-400">by <strong class="text-white">{{ $post->author->name ?? 'Parsa Besharat' }}</strong></span>
                            </div>
                            <a href="/publications/articles/{{ $post->slug }}" class="group/title block">
                                <h2 class="text-lg font-bold text-white tracking-wide group-hover/title:text-indigo-400 transition-colors flex items-center gap-2">
                                    <span>{{ $post->title }}</span>
                                    <span class="text-xs text-indigo-400 opacity-0 group-hover/title:opacity-100 transition-opacity">➔</span>
                                </h2>
                            </a>
                            <div class="blog-content text-xs text-slate-300 line-clamp-3">
                                {!! $post->content !!}
                            </div>
                            <div class="pt-2">
                                <a href="/publications/articles/{{ $post->slug }}" class="inline-flex items-center gap-1 text-[11px] font-bold text-indigo-400 hover:text-indigo-300 transition">
                                    <span>{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Vollständiges Journal lesen' : 'Read Full Journal' }}</span>
                                    <span>➔</span>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="blog-card p-12 rounded-3xl text-center text-gray-400 text-xs font-mono space-y-3">
                        <p>No articles published yet. Be the first to share research insights!</p>
                        <button onclick="openWriteBlogModal()" class="px-5 py-2.5 bg-indigo-600 text-white font-bold text-xs rounded-xl shadow-lg">
                            ✏️ Write First Article
                        </button>
                    </div>
                @endforelse
            </div>

        </main>

    </div>

    <!-- 3. RICH TEXT WRITER MODAL SUITE (PLACED OUTSIDE MAIN CONTAINER FOR FULLSCREEN BACKDROP) -->
    <div id="write-blog-modal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-[100] flex items-center justify-center p-4">
        <div class="bg-gray-900/95 border border-white/20 p-6 rounded-3xl w-full max-w-2xl shadow-2xl space-y-4 animate-scale-up backdrop-blur-xl">
            <div class="flex items-center justify-between pb-3 border-b border-white/10">
                <h2 class="text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                    📝 Publish New Article
                </h2>
                <button onclick="closeWriteBlogModal()" class="text-gray-400 hover:text-white text-xs font-bold p-1">✕ Close</button>
            </div>

            @auth
                <form id="blog-form" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-1">Article Title</label>
                        <input type="text" name="title" required placeholder="Enter article title..."
                            class="w-full bg-black/50 border border-white/15 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500">
                    </div>

                    <!-- Rich Text Editor Toolbar -->
                    <div class="space-y-1">
                        <label class="block text-xs font-medium text-gray-400">Formatting Tools</label>
                        <div class="rich-editor-toolbar flex flex-wrap gap-1.5 p-2 bg-black/60 border border-white/10 rounded-xl">
                            <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs font-bold" data-cmd="bold"><b>B</b></button>
                            <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs italic" data-cmd="italic"><i>I</i></button>
                            <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs underline" data-cmd="underline"><u>U</u></button>
                            <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs font-mono" data-cmd="formatBlock" data-val="h2">H2</button>
                            <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs font-mono" data-cmd="formatBlock" data-val="h3">H3</button>
                            <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs" data-cmd="insertUnorderedList">• Bullet List</button>
                            <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs" data-cmd="insertTable">📊 Insert Table</button>
                            <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs" data-cmd="createLink">🔗 Link</button>
                        </div>
                    </div>

                    <!-- Content Editable Area -->
                    <div class="space-y-1">
                        <label class="block text-xs font-medium text-gray-400">Article Content</label>
                        <div id="rich-editor-area" contenteditable="true"
                            class="w-full min-h-[160px] max-h-[280px] bg-black/50 border border-white/15 rounded-xl p-4 text-xs text-slate-200 focus:outline-none focus:border-indigo-500 overflow-y-auto">
                            Write your rich text article content here...
                        </div>
                    </div>
                    <input type="hidden" name="content" id="blog-content-input">

                    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2 border-t border-white/10">
                        <div>
                            <label class="block text-[11px] font-medium text-gray-400 mb-1">Cover Image (Optional)</label>
                            <input type="file" name="cover_image" class="text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/30 file:text-indigo-300 hover:file:bg-indigo-600/50">
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold text-xs rounded-xl shadow-lg hover:opacity-90 active:scale-95 transition-all">
                            PUBLISH ARTICLE
                        </button>
                    </div>
                </form>
            @else
                <div class="py-8 text-center space-y-4">
                    <div class="w-16 h-16 mx-auto rounded-full bg-indigo-600/20 border border-indigo-500/40 flex items-center justify-center text-2xl text-indigo-400 animate-pulse">
                        🔑
                    </div>
                    <h3 class="text-base font-bold text-white">Sign In to Publish Articles</h3>
                    <p class="text-xs text-gray-400 max-w-sm mx-auto">Please log in to access the rich text editor suite and publish your research articles.</p>
                    <a href="{{ route('login') }}" class="inline-block px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg transition">
                        Sign In Now
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Taskbar & Mac Window Controls -->
    @include('taskbar')
    <script src="{{ asset('js/mac-window-controls.js') }}"></script>

    <!-- External Blog ESM Script -->
    <script type="module" src="{{ asset('js/blog.js') }}"></script>
</body>
</html>
