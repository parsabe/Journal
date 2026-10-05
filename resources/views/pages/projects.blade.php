<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Parsa Besharat</title>

    <meta name="description" content="Explore Parsa Besharat's portfolio of projects in AI, Machine Learning, Data Science, and Software Engineering. Featuring BlackWall, MLMatrix, SCP, and more.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="Projects, Portfolio, AI Projects, Machine Learning, Data Science, BlackWall, MLMatrix, SCP, Parsa Besharat, Software Engineering">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Projects - Parsa Besharat">
    <meta property="og:description" content="Explore Parsa Besharat's portfolio of projects in AI, Machine Learning, Data Science, and Software Engineering. Featuring BlackWall, MLMatrix, SCP, and more.">
    <meta property="og:image" content="{{ asset('images/profile.jpg') }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Projects - Parsa Besharat">
    <meta name="twitter:description" content="Explore Parsa Besharat's portfolio of projects in AI, Machine Learning, Data Science, and Software Engineering. Featuring BlackWall, MLMatrix, SCP, and more.">
    <meta name="twitter:image" content="{{ asset('images/profile.jpg') }}">



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
                <div id="projects">
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 ios-glass text-white rounded-full text-sm font-bold mb-6">
                        {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? '🚀 PROJEKTE' : '🚀 PROJECTS' }}
                    </span>

                    <h1
                        class="text-4xl lg:text-5xl font-extrabold mb-8 tracking-tight text-white drop-shadow-sm">
                        {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Ausgewählte' : 'Featured' }} <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Projekte.' : 'Projects.' }}</span>
                    </h1>
                    <hr class="border-white/15 mb-8">


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- AquaPulse -->
                    <div
                        class="glass-card rounded-2xl p-6 border border-cyan-500/40 flex flex-col">
                        <div class="h-48 w-full bg-gradient-to-tr from-cyan-950 via-slate-900 to-blue-900 rounded-xl mb-4 p-4 flex flex-col justify-between border border-cyan-500/30 relative">
                            <div class="flex justify-between items-center z-10">
                                <span class="text-xs font-mono font-bold px-2.5 py-1 rounded-full bg-cyan-500/20 text-cyan-400 border border-cyan-500/40">🌊 AI VISION & TELEMETRY</span>
                                <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 animate-pulse"></span>
                            </div>
                            <div class="z-10">
                                <div class="text-2xl font-black text-white font-mono tracking-wider flex items-center gap-2">
                                    <span>AQUAPULSE</span>
                                </div>
                                <p class="text-[11px] text-cyan-200/80 font-mono">YOLO Vision • BotSORT • EnKF</p>
                            </div>
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white flex items-center justify-between">
                            <span>AquaPulse</span>
                        </h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            Multi-model YOLO neural vision, BotSORT tracking, Ensemble Kalman Filtering stochastic data assimilation, and local generative AI reports for aquatic ecosystems.
                        </p>
                        <div class="flex gap-2">
                            <a href="{{ route('projects.aquapulse') }}"
                                class="inline-block text-center flex-1 py-2.5 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white rounded-xl text-sm font-bold shadow-md transition-all">
                                Read more
                            </a>
                            <a href="https://github.com/parsabe/AquaPulse" target="_blank"
                                class="inline-flex items-center justify-center p-2.5 bg-slate-900 border border-white/20 text-white rounded-xl hover:bg-slate-800 transition-colors" title="GitHub Repository">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Vectra Framework -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                            <img src="{{ asset('images/vectra.png') }}" alt="Vectra Spatial Framework"
                                class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">Vectra Framework</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            An end-to-end spatial computing framework engineered to generate, extract, and simulate high-fidelity 3D objects directly from simple visual and textual data.
                        </p>
                        <a href="{{ route('projects.vectra') }}"
                            class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                            Read more
                        </a>
                    </div>

                    <!-- VECTRA PC Game -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col border border-emerald-500/40">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden relative">
                            <img src="{{ asset('images/vectra-pc.png') }}" alt="VECTRA Matrix PC Game"
                                class="w-full h-full object-cover">
                            <div class="absolute top-3 right-3 bg-emerald-600 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md font-mono">
                                🎮 PC GAME
                            </div>
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">VECTRA: Matrix Game</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            An immersive first-person 3D cinematic Matrix game built in Unity C#, featuring Suno Bark AI voice generation, Ollama LLM Operator integration, and cryptographic mainframe puzzles.
                        </p>
                        <div class="flex gap-2">
                            <a href="{{ route('projects.vectra-pc-game') }}"
                                class="inline-block text-center flex-1 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                                Read more
                            </a>
                            <a href="https://github.com/parsabe/VECTRA-PC-game" target="_blank"
                                class="inline-flex items-center justify-center p-2.5 bg-slate-900 border border-white/20 text-white rounded-xl hover:bg-slate-800 transition-colors" title="GitHub Repository">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- BlackWall -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                            <img src="{{ asset('images/blackwall.png') }}" alt="BlackWall"
                                class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">BlackWall</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            A domain-aware and interpretable framework designed to identify, assess, and rank high-risk
                            content across online platforms.
                        </p>
                        <a href="{{ route('projects.blackwall') }}"
                            class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                            Read more
                        </a>
                    </div>

                    <!-- MLMatrix -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                            <img src="{{ asset('images/mlmatrix.png') }}" alt="MLMatrix"
                                class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">MLMatrix</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            This repository features four in-depth articles covering a range of cutting-edge
                            technologies and their applications.
                        </p>
                        <a href="{{ route('projects.mlmatrix') }}"
                            class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                            Read more
                        </a>
                    </div>

                    <!-- FunRoot -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                            <img src="{{ asset('images/funroot.png') }}" alt="FunRoot"
                                class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">FunRoot</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            This repository contains my projects that I do just for fun.
                        </p>
                        <a href="{{ route('projects.funroot') }}"
                            class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                            Read more
                        </a>
                    </div>

                    <!-- Ceasar Toolkit -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                            <img src="{{ asset('images/ceasar.png') }}" alt="Ceasar Toolkit"
                                class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">Ceasar Toolkit</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            Ceasar Cipher Toolkit is a free, open-source CLI framework for encoding and decoding files
                            using the classic Ceasar cipher.
                        </p>
                        <a href="{{ route('projects.ceasartoolkit') }}"
                            class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                            Read more
                        </a>
                    </div>

                    <!-- SCP -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                            <img src="{{ asset('images/scp.png') }}" alt="SCP" class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">SCP</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            This project provides a modular, extensible, and research-oriented deep learning pipeline
                            for image classification.
                        </p>
                        <a href="{{ route('projects.scp') }}"
                            class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                            Read more
                        </a>
                    </div>

                    <!-- NetNexus -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                            <img src="{{ asset('images/netnexus.jpg') }}" alt="NetNexus"
                                class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">NetNexus</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            A collection of innovative web projects including a dynamic website, an engaging online
                            riddle game, a social media platform, and a chat portal.
                        </p>
                        <a href="{{ route('projects.netnexus') }}"
                            class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                            Read more
                        </a>
                    </div>

                    <!-- Parsai -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                            <img src="{{ asset('images/parsai.jpg') }}" alt="Parsai" class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">Parsai</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            Parsai combines a powerful VS Code extension and a Telegram bot to provide versatile coding
                            assistance using OpenAI's GPT-4.
                        </p>
                        <a href="{{ route('projects.parsai') }}"
                            class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                            Read more
                        </a>
                    </div>

                    <!-- HounaarToolkit -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                            <img src="{{ asset('images/hounaar.png') }}" alt="HounaarToolkit"
                                class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">HounaarToolkit</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            HounaarToolkit is a versatile Python toolkit that provides a set of tools for various tasks,
                            including data analysis, YouTube video downloading, and more.
                        </p>
                        <a href="{{ route('projects.hounaartoolkit') }}"
                            class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                            Read more
                        </a>
                    </div>

                    <!-- Sandika -->
                    <div
                        class="glass-card rounded-2xl p-6 flex flex-col">
                        <div class="h-48 w-full bg-slate-950/60 border border-white/10 rounded-xl mb-4 overflow-hidden">
                            <img src="{{ asset('images/sandika.jpg') }}" alt="Sandika"
                                class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-white">Sandika</h2>
                        <p class="text-slate-300 text-sm mb-4 flex-grow leading-relaxed">
                            Sandika is an Online Simple Social media platform where poeple can post texts, images,
                            videos, solve riddles and some more.
                        </p>
                        <a href="{{ route('projects.sandika') }}"
                            class="inline-block text-center w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-sm font-medium shadow-md transition-all">
                            Read more
                        </a>
                    </div>




                </div>
                </div>
        </main>
    </div>
</body>

</html>