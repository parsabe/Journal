<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaPulse Paper - Parsa Besharat</title>

    <meta name="description"
        content="AquaPulse: Robust Computer Vision and Uncertainty Estimation for Aquatic Ecosystems. Research paper by Parsa Besharat.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords"
        content="AquaPulse, Computer Vision, BotSORT, Ensemble Kalman Filter, Uncertainty Estimation, Aquatic Ecosystems, Parsa Besharat, Research Paper">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="AquaPulse Paper - Parsa Besharat">
    <meta property="og:description"
        content="AquaPulse: Robust Computer Vision and Uncertainty Estimation for Aquatic Ecosystems. Research paper by Parsa Besharat.">
    <meta name="twitter:card" content="summary_large_image">

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
        class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[85vh] z-10 transition-colors duration-700">

        <div class="absolute top-6 right-8 flex items-center gap-5 z-50">

            <div class="flex gap-2">
                <div class="w-3.5 h-3.5 rounded-full bg-[#ff5f56] shadow-sm border border-[#e0443e]"></div>
                <div class="w-3.5 h-3.5 rounded-full bg-[#ffbd2e] shadow-sm border border-[#dea123]"></div>
                <div class="w-3.5 h-3.5 rounded-full bg-[#27c93f] shadow-sm border border-[#1aab29]"></div>
            </div>

        </div>

        @include('sidebar')

        <main class="flex-1 p-6 lg:p-10 overflow-y-auto scrollbar-hide">
            <div class="max-w-4xl mx-auto space-y-12 pb-20">

                <header class="text-center space-y-6 pt-4">
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 ios-glass text-cyan-600 dark:text-cyan-400 rounded-full text-sm font-bold shadow-sm">
                        📄 RESEARCH PAPER
                    </span>
                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white drop-shadow-sm leading-tight">
                        AquaPulse: Robust Computer Vision and Uncertainty Estimation for Aquatic Ecosystems
                    </h1>

                    <div
                        class="flex flex-col items-center justify-center gap-2 text-gray-600 dark:text-gray-400 font-medium">
                        <p class="text-lg text-gray-800 dark:text-gray-200 font-semibold">Parsa Besharat</p>
                        <p class="text-sm">Department of Math and Computer Science, Technische Universität Bergakademie Freiberg, Freiberg, Germany</p>
                        <a href="mailto:parsabe99@gmail.com"
                            class="text-cyan-500 hover:underline text-sm">parsabe99@gmail.com</a>
                    </div>

                    <div class="flex flex-wrap justify-center gap-4 pt-4">
                        <a href="https://www.researchgate.net/publication/413441552_AquaPulse_Robust_Computer_Vision_and_Uncertainty_Estimation_for_Aquatic_Ecosystems" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-500 to-emerald-600 text-white rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            View on ResearchGate
                        </a>
                        <a href="https://github.com/parsabe/AquaPulse" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            GitHub Repository
                        </a>
                    </div>
                </header>

                <section
                    class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg relative overflow-hidden space-y-4">
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-cyan-500 to-blue-600"></div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Abstract</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                        AquaPulse bridges multi-model YOLO neural vision, BotSORT multi-object tracking, Ensemble Kalman Filtering stochastic data assimilation, and local generative AI into an end-to-end ecosystem telemetry platform. By eliminating manual fish counting and enabling non-invasive automated observation in turbid aquatic environments, AquaPulse provides researchers, marine biologists, and environmental agencies with real-time ecological safety monitoring, extinction risk forecasting, and publication-ready LaTeX scientific reports.
                    </p>
                </section>

                <section class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg space-y-4">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Key Contributions & Architecture</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                        <li><strong>Multi-Model YOLO Vision Engine:</strong> High-throughput object detection tuned for underwater turbidity and specimen detection.</li>
                        <li><strong>BotSORT Multi-Object Tracking:</strong> Continuous tracking with robust re-identification across occlusions and dynamic aquatic currents.</li>
                        <li><strong>Ensemble Kalman Filtering (EnKF):</strong> Stochastic data assimilation and state space modeling for real-time uncertainty estimation.</li>
                        <li><strong>Automated Scientific Reporting:</strong> Integrated local generative AI dialogue and telemetry engines producing publication-ready LaTeX documents and telemetry plots.</li>
                    </ul>
                </section>

            </div>
        </main>
    </div>
</body>
</html>
