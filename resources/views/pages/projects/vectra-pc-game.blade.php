<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VECTRA: The Matrix TUBAF Simulation - Parsa Besharat</title>

    <meta name="description" content="An immersive first-person 3D cinematic Matrix game built in Unity C#, featuring CUDA-accelerated Suno Bark AI voice generation, real-time Ollama LLM Operator integration, and cryptographic mainframe puzzles.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="VECTRA PC Game, Unity 3D, The Matrix Game, Suno Bark TTS, Ollama LLM, ROT13 Cipher, Cryptographic Puzzles, Parsa Besharat, TUBAF Informatik">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="VECTRA: The Matrix TUBAF Simulation - Parsa Besharat">
    <meta property="og:description" content="An immersive first-person 3D cinematic Matrix game built in Unity C#, featuring CUDA-accelerated Suno Bark AI voice generation, real-time Ollama LLM Operator integration, and cryptographic mainframe puzzles.">
    <meta property="og:image" content="{{ asset('images/vectra-pc.png') }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="VECTRA: The Matrix TUBAF Simulation - Parsa Besharat">
    <meta name="twitter:description" content="An immersive first-person 3D cinematic Matrix game built in Unity C#, featuring CUDA-accelerated Suno Bark AI voice generation, real-time Ollama LLM Operator integration, and cryptographic mainframe puzzles.">
    <meta name="twitter:image" content="{{ asset('images/vectra-pc.png') }}">

    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-E441FBGYXG"></script>
<script type="module" src="{{ asset('js/gtag.js') }}"></script>

<body class="text-gray-900 dark:text-gray-100 antialiased flex items-center justify-center p-4 lg:p-10 min-h-screen relative overflow-x-hidden">

    <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[85vh] z-10 transition-colors duration-700">

        <div class="absolute top-6 right-8 flex items-center gap-5 z-50">

            <div class="flex gap-2">
                <div class="w-3.5 h-3.5 rounded-full bg-[#ff5f56] shadow-sm border border-[#e0443e]"></div>
                <div class="w-3.5 h-3.5 rounded-full bg-[#ffbd2e] shadow-sm border border-[#dea123]"></div>
                <div class="w-3.5 h-3.5 rounded-full bg-[#27c93f] shadow-sm border border-[#1aab29]"></div>
            </div>
        </div>

        @include('sidebar')

        <main class="flex-1 overflow-y-auto p-6 md:p-10 scroll-smooth">
            <div class="max-w-4xl mx-auto space-y-10">
                
                <!-- Header & Hero -->
                <div class="text-center space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-mono font-bold bg-emerald-500/15 text-emerald-800 dark:text-emerald-300 border border-emerald-500/30">
                        🎮 3D CINEMATIC MATRIX SIMULATION (PC GAME)
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white drop-shadow-sm">
                        VECTRA: The Matrix TUBAF Simulation
                    </h1>
                    <p class="text-lg md:text-xl text-gray-800 dark:text-gray-100 font-semibold max-w-2xl mx-auto leading-relaxed">
                        An immersive first-person 3D cinematic Matrix game built in Unity C#, featuring CUDA-accelerated Suno Bark AI voice generation, real-time Ollama LLM Operator integration, and cryptographic mainframe puzzles.
                    </p>
                    
                    <div class="flex justify-center my-6">
                        <img src="{{ asset('images/vectra-pc.png') }}" 
                             alt="VECTRA Morpheus Scene" 
                             class="rounded-2xl shadow-2xl max-w-full h-auto border border-gray-300 dark:border-gray-700/80 transition-transform duration-300 hover:scale-[1.01]">
                    </div>

                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="https://github.com/parsabe/VECTRA-PC-game" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            GitHub Repository
                        </a>
                        <a href="{{ route('projects.vectra') }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            Spatial Web Framework
                        </a>
                        <a href="https://vectra.parsabe.com" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-500 to-emerald-600 text-white rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            Live Web Portal
                        </a>
                    </div>
                </div>

                <!-- Story Overview & Synopsis -->
                <section class="space-y-6">
                    <div class="flex items-center gap-3 border-b border-gray-300 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                            <span>📖</span> Story Overview & Synopsis
                        </h2>
                    </div>

                    <!-- Phase 1 Card -->
                    <div class="bg-white dark:bg-gray-900/95 backdrop-blur-md p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-xl space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-extrabold text-emerald-700 dark:text-emerald-400">Phase 1: The Construct</h3>
                            <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 text-xs font-mono rounded-full font-extrabold border border-emerald-300 dark:border-emerald-700/50">Intro Stage</span>
                        </div>
                        <p class="text-gray-900 dark:text-gray-100 leading-relaxed font-medium text-justify">
                            You awaken inside the Construct facing <strong class="text-gray-900 dark:text-white font-extrabold">Morpheus</strong>. A 49-second cinematic hostage intro locks your body while setting the mood. Morpheus presents the fundamental choice:
                        </p>
                        <div class="grid md:grid-cols-2 gap-4 pt-2">
                            <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-800/60 space-y-1">
                                <span class="font-extrabold text-sm text-blue-800 dark:text-blue-300 flex items-center gap-1.5">🔵 The Blue Pill</span>
                                <p class="text-xs text-blue-950 dark:text-blue-100 leading-relaxed font-medium">Quit the game immediately and return to your peaceful ignorance.</p>
                            </div>
                            <div class="p-4 rounded-xl bg-red-50 dark:bg-red-950/60 border border-red-200 dark:border-red-800/60 space-y-1">
                                <span class="font-extrabold text-sm text-red-800 dark:text-red-300 flex items-center gap-1.5">🔴 The Red Pill</span>
                                <p class="text-xs text-red-950 dark:text-red-100 leading-relaxed font-medium">Enter the simulation, examine the rules on the vintage TV, and call the Operator on the phone to transition into the mainframe.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Phase 2 Card -->
                    <div class="bg-white dark:bg-gray-900/95 backdrop-blur-md p-6 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-xl space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-extrabold text-emerald-700 dark:text-emerald-400">Phase 2: TUBAF Informatik Mainframe</h3>
                            <span class="px-3 py-1 bg-teal-100 dark:bg-teal-950/60 text-teal-800 dark:text-teal-300 text-xs font-mono rounded-full font-extrabold border border-teal-300 dark:border-teal-700/50">Mainframe Arena</span>
                        </div>
                        <p class="text-gray-900 dark:text-gray-100 leading-relaxed font-medium">
                            You land directly inside the corrupted <strong class="text-gray-900 dark:text-white font-extrabold">TUBAF Informatik Faculty Mainframe</strong>:
                        </p>
                        <ol class="space-y-3 text-sm text-gray-900 dark:text-gray-100 list-decimal list-inside ml-2 font-medium">
                            <li class="pl-2"><strong class="text-gray-900 dark:text-white font-extrabold">The Oracle:</strong> Speaks to you about trust, choices, and the impending purge. As she finishes, she fades out, and the ambient soundtrack <code class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700/50 rounded text-xs font-mono font-bold">doomed.mp3</code> begins playing softly in the background.</li>
                            <li class="pl-2"><strong class="text-gray-900 dark:text-white font-extrabold">Agent Smith:</strong> Spawns into the arena. Listen to his taunts, then strike him 5 times using the <kbd class="px-2.5 py-0.5 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-400 dark:border-gray-600 rounded text-xs font-mono font-bold shadow-sm">E</kbd> key (or left-click) to sever his proxy connection and defeat him.</li>
                            <li class="pl-2"><strong class="text-gray-900 dark:text-white font-extrabold">Trinity:</strong> Spawns and fades in after Agent Smith's defeat. She provides the encrypted security payload: <code class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700/50 rounded text-xs font-mono font-bold">V ungr Zngurzngvpf</code>.</li>
                            <li class="pl-2"><strong class="text-gray-900 dark:text-white font-extrabold">The Operator (Phone AI):</strong> Press <kbd class="px-2.5 py-0.5 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-400 dark:border-gray-600 rounded text-xs font-mono font-bold shadow-sm">Q</kbd> near the phone to chat with Tank, the Operator AI (powered by Ollama Local LLM), to decrypt the ROT13 cipher or get tactical advice.</li>
                            <li class="pl-2"><strong class="text-gray-900 dark:text-white font-extrabold">The Laptop Terminal:</strong> Press <kbd class="px-2.5 py-0.5 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-400 dark:border-gray-600 rounded text-xs font-mono font-bold shadow-sm">E</kbd> near the laptop to open the Cyberpunk ROT13 Mainframe Terminal. Decipher the key (<code class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700/50 rounded text-xs font-mono font-bold">V ungr Zngurzngvpf</code> &rarr; <code class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700/50 rounded text-xs font-mono font-bold">I hate Mathematics</code>), submit it, and purge the mainframe!</li>
                            <li class="pl-2"><strong class="text-gray-900 dark:text-white font-extrabold">Victory Screen:</strong> Plays <code class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700/50 rounded text-xs font-mono font-bold">ending.mp3</code> and presents the final credits overlay with developer links and music soundtrack copyright information.</li>
                        </ol>
                    </div>

                    <!-- Matrix Lore Notice -->
                    <div class="p-5 bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-800/60 rounded-2xl flex items-start gap-3 shadow-md">
                        <span class="text-2xl">💡</span>
                        <div class="space-y-1 text-sm text-amber-950 dark:text-amber-100">
                            <span class="font-extrabold text-amber-900 dark:text-amber-300 block">Matrix Lore Notice:</span>
                            <p class="italic leading-relaxed font-medium">If you heard Trinity with a man's voice earlier, it was because she was hacked and edited badly by Agent Smith. This was totally done on purpose!</p>
                        </div>
                    </div>
                </section>

                <!-- Full System Architecture & Tech Stack -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-300 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                            <span>🛠️</span> System Architecture & Tech Stack
                        </h2>
                    </div>
                    
                    <div class="overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/95 backdrop-blur-md shadow-xl">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-950 text-gray-900 dark:text-white font-black border-b border-gray-200 dark:border-gray-800 uppercase tracking-wider text-xs">
                                <tr>
                                    <th class="p-4">System / Component</th>
                                    <th class="p-4">Technology</th>
                                    <th class="p-4">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-800 text-gray-900 dark:text-gray-100 font-medium">
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">3D Models & Assets</td>
                                    <td class="p-4"><span class="px-2.5 py-1 bg-purple-100 dark:bg-purple-950/60 text-purple-900 dark:text-purple-300 border border-purple-300 dark:border-purple-700/50 rounded-md text-xs font-mono font-bold">Meshy.ai</span></td>
                                    <td class="p-4 leading-relaxed">Generative 3D AI Mesh models for Morpheus, TV, Phone, Oracle, Smith, Trinity, and Laptop.</td>
                                </tr>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">Game Engine</td>
                                    <td class="p-4"><span class="px-2.5 py-1 bg-blue-100 dark:bg-blue-950/60 text-blue-900 dark:text-blue-300 border border-blue-300 dark:border-blue-700/50 rounded-md text-xs font-mono font-bold">Unity 3D (C#)</span></td>
                                    <td class="p-4 leading-relaxed">First-Person Vector Controller, Raycasting, Physics, and Dynamic Scene Management.</td>
                                </tr>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">Voice AI Generation</td>
                                    <td class="p-4"><span class="px-2.5 py-1 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700/50 rounded-md text-xs font-mono font-bold">Suno Bark TTS</span></td>
                                    <td class="p-4 leading-relaxed">CUDA-accelerated float16 text-to-speech generation for Morpheus, Oracle, Smith, and Trinity.</td>
                                </tr>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">Operator AI Link</td>
                                    <td class="p-4"><span class="px-2.5 py-1 bg-amber-100 dark:bg-amber-950/60 text-amber-900 dark:text-amber-300 border border-amber-300 dark:border-amber-700/50 rounded-md text-xs font-mono font-bold">Ollama LLM API</span></td>
                                    <td class="p-4 leading-relaxed">Local LLM integration (<code class="text-xs font-mono font-bold">llama3</code> / <code class="text-xs font-mono font-bold">mistral</code>) powering real-time chat with Operator via REST API.</td>
                                </tr>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">Cryptography</td>
                                    <td class="p-4"><span class="px-2.5 py-1 bg-red-100 dark:bg-red-950/60 text-red-900 dark:text-red-300 border border-red-300 dark:border-red-700/50 rounded-md text-xs font-mono font-bold">ROT13 Cipher</span></td>
                                    <td class="p-4 leading-relaxed">Cryptographic terminal validation system (<code class="text-xs font-mono font-bold">V ungr Zngurzngvpf</code> &leftrightarrow; <code class="text-xs font-mono font-bold">I hate Mathematics</code>).</td>
                                </tr>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">UI Architecture</td>
                                    <td class="p-4"><span class="px-2.5 py-1 bg-teal-100 dark:bg-teal-950/60 text-teal-900 dark:text-teal-300 border border-teal-300 dark:border-teal-700/50 rounded-md text-xs font-mono font-bold">Runtime Vector GUI</span></td>
                                    <td class="p-4 leading-relaxed">Vector CRT Matrix overlay system generated entirely at runtime without prefabs.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Controls & Interaction Shortcuts -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-300 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                            <span>🎮</span> Controls & Interaction Shortcuts
                        </h2>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900/95 backdrop-blur-md shadow-xl">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-950 text-gray-900 dark:text-white font-black border-b border-gray-200 dark:border-gray-800 uppercase tracking-wider text-xs">
                                <tr>
                                    <th class="p-4">Action</th>
                                    <th class="p-4">Shortcut Key</th>
                                    <th class="p-4">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-800 text-gray-900 dark:text-gray-100 font-medium">
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">Move Body</td>
                                    <td class="p-4"><kbd class="px-2.5 py-1 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-400 dark:border-gray-600 rounded text-xs font-mono font-bold shadow-sm">W A S D</kbd></td>
                                    <td class="p-4 leading-relaxed">Walk around the simulation environment.</td>
                                </tr>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">Camera Look</td>
                                    <td class="p-4"><kbd class="px-2.5 py-1 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-400 dark:border-gray-600 rounded text-xs font-mono font-bold shadow-sm">Mouse Move</kbd></td>
                                    <td class="p-4 leading-relaxed">Rotate camera view freely (remains active during dialogue).</td>
                                </tr>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">Interact / Talk / Hit</td>
                                    <td class="p-4"><kbd class="px-3 py-1 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700/50 rounded text-xs font-mono font-bold shadow-sm">E</kbd></td>
                                    <td class="p-4 leading-relaxed">Talk to Morpheus/Oracle/Trinity, hit Agent Smith (5 times), open Laptop Terminal.</td>
                                </tr>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">Call Operator AI</td>
                                    <td class="p-4"><kbd class="px-3 py-1 bg-blue-100 dark:bg-blue-950/60 text-blue-900 dark:text-blue-300 border border-blue-300 dark:border-blue-700/50 rounded text-xs font-mono font-bold shadow-sm">Q</kbd></td>
                                    <td class="p-4 leading-relaxed">Open/Close the Operator Ollama AI Chat Terminal near the Phone.</td>
                                </tr>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="p-4 font-black text-gray-900 dark:text-white">Close UI / Terminal</td>
                                    <td class="p-4"><kbd class="px-2.5 py-1 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-400 dark:border-gray-600 rounded text-xs font-mono font-bold shadow-sm">ESC</kbd></td>
                                    <td class="p-4 leading-relaxed">Close any active terminal window and return to game.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Voice Generation Scripts (Bark TTS) -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-300 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                            <span>🎙️</span> Voice Generation Scripts (Bark TTS)
                        </h2>
                    </div>
                    <p class="text-sm text-gray-900 dark:text-gray-100 font-medium leading-relaxed">
                        The voice lines for game characters are generated using Python scripts utilizing CUDA TensorFloat32 acceleration with Suno Bark TTS:
                    </p>
                    <pre class="bg-[#121212] text-[#e0e0e0] p-5 rounded-2xl shadow-xl border border-gray-800 overflow-x-auto text-sm font-mono leading-relaxed"><code># 1. Morpheus Voices Generation
python main.py

# 2. Agent Smith Voices Generation
python generate_smith_voices.py

# 3. Trinity Voices Generation
.\venv\Scripts\python.exe generate_trinity_voices.py</code></pre>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs font-mono">
                        <div class="p-4 bg-white dark:bg-gray-900/95 border border-gray-200 dark:border-gray-800 rounded-xl shadow-md space-y-1">
                            <span class="font-black block text-gray-900 dark:text-white text-sm">Morpheus</span>
                            <span class="text-emerald-700 dark:text-emerald-400 font-bold block">v2/en_speaker_6</span>
                            <span class="text-gray-700 dark:text-gray-300 text-xs block font-medium">Deep male voice</span>
                        </div>
                        <div class="p-4 bg-white dark:bg-gray-900/95 border border-gray-200 dark:border-gray-800 rounded-xl shadow-md space-y-1">
                            <span class="font-black block text-gray-900 dark:text-white text-sm">Oracle</span>
                            <span class="text-emerald-700 dark:text-emerald-400 font-bold block">v2/en_speaker_9</span>
                            <span class="text-gray-700 dark:text-gray-300 text-xs block font-medium">Warm female voice</span>
                        </div>
                        <div class="p-4 bg-white dark:bg-gray-900/95 border border-gray-200 dark:border-gray-800 rounded-xl shadow-md space-y-1">
                            <span class="font-black block text-gray-900 dark:text-white text-sm">Agent Smith</span>
                            <span class="text-emerald-700 dark:text-emerald-400 font-bold block">v2/en_speaker_2</span>
                            <span class="text-gray-700 dark:text-gray-300 text-xs block font-medium">Intimidating male</span>
                        </div>
                        <div class="p-4 bg-white dark:bg-gray-900/95 border border-gray-200 dark:border-gray-800 rounded-xl shadow-md space-y-1">
                            <span class="font-black block text-gray-900 dark:text-white text-sm">Trinity</span>
                            <span class="text-emerald-700 dark:text-emerald-400 font-bold block">v2/en_speaker_4</span>
                            <span class="text-gray-700 dark:text-gray-300 text-xs block font-medium">Clear female voice</span>
                        </div>
                    </div>
                </section>

                <!-- Music Soundtrack & Credits -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-300 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                            <span>🎵</span> Music Soundtrack & Copyright Credits
                        </h2>
                    </div>

                    <div class="grid md:grid-cols-3 gap-4 text-sm">
                        <a href="https://open.spotify.com/intl-de/track/1yUaqPpTl2UEnF31L3r62O?si=6912dd797e734111" target="_blank"
                           class="p-4 bg-emerald-50 dark:bg-emerald-950/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/70 border border-emerald-300 dark:border-emerald-700/50 rounded-2xl transition flex items-center justify-between group shadow-sm">
                            <div>
                                <span class="font-black text-emerald-900 dark:text-emerald-300 block text-base">1. Opening Track</span>
                                <span class="text-xs text-emerald-800 dark:text-emerald-400 font-bold">Listen on Spotify</span>
                            </div>
                            <span class="text-emerald-700 dark:text-emerald-400 group-hover:translate-x-1 transition-transform text-lg font-bold">&rarr;</span>
                        </a>
                        <a href="https://youtu.be/Y_-6JcqTuQg?si=zqyu86zmAYBtSiNv" target="_blank"
                           class="p-4 bg-red-50 dark:bg-red-950/60 hover:bg-red-100 dark:hover:bg-red-900/70 border border-red-300 dark:border-red-700/50 rounded-2xl transition flex items-center justify-between group shadow-sm">
                            <div>
                                <span class="font-black text-red-900 dark:text-red-300 block text-base">2. Doomed Track</span>
                                <span class="text-xs text-red-800 dark:text-red-400 font-bold">Listen on YouTube</span>
                            </div>
                            <span class="text-red-700 dark:text-red-400 group-hover:translate-x-1 transition-transform text-lg font-bold">&rarr;</span>
                        </a>
                        <a href="https://youtu.be/08wg9S_elHY?si=E92hpVnRs6I5eQZm" target="_blank"
                           class="p-4 bg-purple-50 dark:bg-purple-950/60 hover:bg-purple-100 dark:hover:bg-purple-900/70 border border-purple-300 dark:border-purple-700/50 rounded-2xl transition flex items-center justify-between group shadow-sm">
                            <div>
                                <span class="font-black text-purple-900 dark:text-purple-300 block text-base">3. Ending Track</span>
                                <span class="text-xs text-purple-800 dark:text-purple-400 font-bold">Listen on YouTube</span>
                            </div>
                            <span class="text-purple-700 dark:text-purple-400 group-hover:translate-x-1 transition-transform text-lg font-bold">&rarr;</span>
                        </a>
                    </div>
                </section>

                <!-- Developer & Creator Credits -->
                <section class="space-y-4 pb-6">
                    <div class="flex items-center gap-3 border-b border-gray-300 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                            <span>👨‍💻</span> Developer & Creator Credits
                        </h2>
                    </div>
                    
                    <p class="text-gray-900 dark:text-gray-100 text-sm leading-relaxed font-medium">
                        Designed, written, and engineered by <strong class="text-gray-900 dark:text-white font-black">Parsa Besharat</strong>.
                    </p>

                    <div class="flex flex-wrap gap-4 text-sm font-extrabold pt-1">
                        <a href="https://parsabe.com" class="px-4 py-2 bg-emerald-50 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700/50 rounded-xl hover:bg-emerald-100 dark:hover:bg-emerald-900/70 transition">🌐 Portfolio Website (parsabe.com)</a>
                        <a href="https://linkedin.com/in/parsabe" target="_blank" class="px-4 py-2 bg-blue-50 dark:bg-blue-950/60 text-blue-900 dark:text-blue-300 border border-blue-300 dark:border-blue-700/50 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-900/70 transition">💼 LinkedIn</a>
                        <a href="https://github.com/parsabe" target="_blank" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 transition">🐙 GitHub</a>
                    </div>
                </section>

            </div>
        </main>
    </div>
</body>
</html>
