<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaPulse AI Project - Parsa Besharat</title>

    <meta name="description" content="AquaPulse bridges multi-model YOLO neural vision, BotSORT tracking, Ensemble Kalman Filtering stochastic data assimilation, and local generative AI into an end-to-end ecosystem telemetry platform.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="AquaPulse, Computer Vision, YOLO, BotSORT, Ensemble Kalman Filter, EnKF, AI Telemetry, Marine Vision, Parsa Besharat">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="AquaPulse AI Project - Parsa Besharat">
    <meta property="og:description" content="AquaPulse bridges multi-model YOLO neural vision, BotSORT tracking, Ensemble Kalman Filtering stochastic data assimilation, and local generative AI into an end-to-end ecosystem telemetry platform.">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="AquaPulse AI Project - Parsa Besharat">
    <meta name="twitter:description" content="AquaPulse bridges multi-model YOLO neural vision, BotSORT tracking, Ensemble Kalman Filtering stochastic data assimilation, and local generative AI into an end-to-end ecosystem telemetry platform.">

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

        <main class="flex-1 overflow-y-auto p-6 md:p-10 scroll-smooth">
            <div class="max-w-4xl mx-auto space-y-10 pb-12">
                
                <!-- Header -->
                <div class="text-center space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-500/10 text-cyan-500 border border-cyan-500/30 text-xs font-mono font-bold">
                        🌊 AI MARINE VISION & TELEMETRY SYSTEM
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-cyan-500 via-blue-600 to-indigo-600 dark:from-cyan-400 dark:via-blue-400 dark:to-indigo-400">
                        AquaPulse
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 font-medium max-w-3xl mx-auto">
                        Robust Computer Vision, BotSORT Object Tracking, Ensemble Kalman Filtering & Uncertainty Estimation for Aquatic Ecosystems
                    </p>

                    <div class="flex flex-wrap justify-center gap-4 pt-2">
                        <a href="https://github.com/parsabe/AquaPulse" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            GitHub Repository
                        </a>
                        <a href="https://www.researchgate.net/publication/413441552_AquaPulse_Robust_Computer_Vision_and_Uncertainty_Estimation_for_Aquatic_Ecosystems" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-500 to-emerald-600 text-white rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            ResearchGate Publication
                        </a>
                    </div>
                </div>

                <!-- Overview Section -->
                <section class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg space-y-4">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="p-2 rounded-xl bg-cyan-500/20 text-cyan-400">🌊</span> Overview & Executive Summary
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                        AquaPulse bridges multi-model YOLO neural vision, BotSORT multi-object tracking, Ensemble Kalman Filtering (EnKF) stochastic data assimilation, and local generative AI into an end-to-end ecosystem telemetry platform. By eliminating manual fish counting and enabling non-invasive automated observation in turbid aquatic environments, AquaPulse provides researchers, marine biologists, and environmental agencies with real-time ecological safety monitoring, extinction risk forecasting, and publication-ready LaTeX scientific reports.
                    </p>
                </section>

                <!-- Installation & Standalone -->
                <section class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="p-2 rounded-xl bg-blue-500/20 text-blue-400">📦</span> Downloads & Standalone Application
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-5 rounded-2xl bg-cyan-950/20 border border-cyan-500/30 flex items-center gap-4">
                            <div class="text-3xl">💻</div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white text-sm">AquaPulse Setup Installer</h3>
                                <p class="text-xs font-mono text-cyan-400 mt-1">AquaPulse_Setup.exe</p>
                            </div>
                        </div>
                        <div class="p-5 rounded-2xl bg-blue-950/20 border border-blue-500/30 flex items-center gap-4">
                            <div class="text-3xl">📁</div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white text-sm">Standalone Application Folder</h3>
                                <p class="text-xs font-mono text-blue-400 mt-1">AquaPulse_App/</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Developer Mode Section -->
                <section class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="p-2 rounded-xl bg-indigo-500/20 text-indigo-400">🔬</span> Running from Source (Developer Mode)
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">1. Activate Virtual Environment:</h3>
                            <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-xs font-mono"><code>c:\Users\parsa\Desktop\Code\venv\Scripts\Activate.ps1</code></pre>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">2. Launch the Master AI Vision Telemetry System:</h3>
                            <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-xs font-mono"><code>python "3 - AI process\main.py"</code></pre>
                        </div>
                    </div>
                </section>

                <!-- Output Session Structure -->
                <section class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="p-2 rounded-xl bg-purple-500/20 text-purple-400">📊</span> System Telemetry & Output Session Structure
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        Each video analysis session generates an isolated, timestamped output bundle under <code class="font-mono text-cyan-400">video_analysis_sessions/</code>:
                    </p>

                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-5 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-xs font-mono leading-relaxed"><code>video_analysis_sessions/&lt;video_name&gt;_&lt;timestamp&gt;/
├── output/           # Processed MP4 video with target reticles & EnKF HUD overlays
├── csv/              # Raw specimen counts and track data per frame
├── plots/            # 20 high-resolution analytical PNG telemetry plots
└── analysis/         # Ollama AI narrative report (.md), generated .tex file, and compiled PDF report</code></pre>
                </section>

                <!-- Complete Documentation -->
                <section class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg space-y-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <span class="p-2 rounded-xl bg-emerald-500/20 text-emerald-400">📄</span> Complete Project Documentation
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        For exhaustive mathematical details, system design diagrams, and empirical results, view:
                    </p>

                    <div class="space-y-3">
                        <div class="p-4 rounded-xl bg-gray-900/50 border border-gray-700/60 flex items-center gap-3 text-xs font-mono">
                            <span class="text-emerald-400 font-bold">1.</span>
                            <span class="text-gray-200">Word Document Technical Report:</span>
                            <span class="text-cyan-400">4 - Documentation/AquaPulse_Preprocessing_and_AI_Process_Report.docx</span>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-900/50 border border-gray-700/60 flex items-center gap-3 text-xs font-mono">
                            <span class="text-emerald-400 font-bold">2.</span>
                            <span class="text-gray-200">Interactive HTML Workflow & Architecture:</span>
                            <span class="text-cyan-400">4 - Documentation/AquaPulse_System_Workflow_and_Structure.html</span>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-900/50 border border-gray-700/60 flex items-center gap-3 text-xs font-mono">
                            <span class="text-emerald-400 font-bold">3.</span>
                            <span class="text-gray-200">Markdown Architecture & Reference Spec:</span>
                            <span class="text-cyan-400">4 - Documentation/AquaPulse_Workflow_and_Structure.md</span>
                        </div>
                    </div>
                </section>

                <!-- Contributing & License -->
                <section class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                🤝 Contributing
                            </h3>
                            <ol class="list-decimal list-inside text-xs text-gray-700 dark:text-gray-300 space-y-1.5 leading-relaxed font-mono">
                                <li>Fork the Repository on GitHub.</li>
                                <li>Create a Feature Branch: <code class="text-cyan-400">git checkout -b feature/amazing-feature</code></li>
                                <li>Commit Changes: <code class="text-cyan-400">git commit -m 'Add amazing feature'</code></li>
                                <li>Push to Branch: <code class="text-cyan-400">git push origin feature/amazing-feature</code></li>
                                <li>Open a Pull Request describing your changes.</li>
                            </ol>
                        </div>
                        <div class="space-y-3">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                📜 License
                            </h3>
                            <p class="text-xs text-gray-700 dark:text-gray-300 leading-relaxed">
                                Distributed under the MIT License. Copyright © 2026 AquaPulse AI Team. All Rights Reserved.
                            </p>
                        </div>
                    </div>
                </section>

            </div>
        </main>
    </div>
</body>
</html>
