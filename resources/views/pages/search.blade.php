<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Parsa Besharat</title>

    <meta name="description" content="Parsa Besharat is an Iranian Researcher and AI Engineer. He is currently pursuing his
    MS.c degree in Data Science at the TU Freiberg University in Sachsen, Germany.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords"
        content="Parsa Besharat, Researcher, AI Engineer, Data Scientist, Machine Learning, Deep Learning, Natural Language Processing, Computer Vision, TU Freiberg University, Germany">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">



    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-E441FBGYXG"></script>
<script type="module" src="{{ asset('js/gtag.js') }}"></script>

<body
    class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-4 lg:p-10 min-h-screen relative overflow-x-hidden">

    <div id="main-container"
        class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[85vh] z-10 transition-colors duration-700 animate-page-zoom-in">

        @include('top-header-controls')

        @include('sidebar')
  
        <main class="flex-1 p-6 pt-12 lg:p-10 lg:pt-14 overflow-y-auto scrollbar-hide">
            <div class="max-w-6xl mx-auto animate-page-slide-up">
                <h1 class="text-3xl font-bold mb-6 text-white">Search here ...</h1>

                <form action="{{ route('search') }}" method="GET" class="mb-8">
                    <div class="relative flex items-center">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search here..."
                            class="w-full pl-4 pr-12 py-3 rounded-xl bg-slate-900/60 border border-white/15 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-slate-400 shadow-sm transition-all duration-300">
                        <button type="submit" class="absolute right-3 text-slate-400 hover:text-blue-400 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>

                @if(request()->filled('q'))
                    
                    @if(isset($projects) && $projects->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($projects as $project)
                                <div class="glass-card rounded-2xl p-6 flex flex-col">
                                    <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                                        <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <h2 class="text-xl font-bold mb-2 text-white">{{ $project->title }}</h2>
                                    <p class="text-slate-300 text-sm mb-4 flex-grow line-clamp-3 leading-relaxed">
                                        {{ $project->description }}
                                    </p>
                                    <a href="{{ route($project->route_name) }}" class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                                        Read more
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center mt-12">
                            <span class="text-4xl">🔍</span>
                            <h3 class="text-lg font-bold text-white mt-4">No projects found for "{{ request('q') }}"</h3>
                            <p class="text-slate-300 mt-2">Try adjusting your search keywords.</p>
                            <a href="{{ route('search') }}" class="inline-block mt-4 text-blue-400 hover:underline">Clear search</a>
                        </div>
                    @endif

                @else
                    <div class="text-center mt-16 opacity-75">
                        <p class="text-slate-300 font-medium">Type a keyword above to start searching through projects and publications.</p>
                    </div>
                @endif

            </div>
        </main>



    </div>
</body>

</html>