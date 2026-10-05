<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCP Project - Parsa Besharat</title>

    <meta name="description" content="Scientific Computing Project (SCP) is a modular, extensible, and research-oriented deep learning pipeline for image classification, featuring VGG-16 implementation. Developed by Parsa Besharat.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="SCP, Scientific Computing Project, Deep Learning, Image Classification, VGG-16, PyTorch, Python, Research, Parsa Besharat, AI Pipeline">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="SCP Project - Parsa Besharat">
    <meta property="og:description" content="Scientific Computing Project (SCP) is a modular, extensible, and research-oriented deep learning pipeline for image classification, featuring VGG-16 implementation.">
    <meta property="og:image" content="{{ asset('images/scp.png') }}">
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

        <main class="flex-1 overflow-y-auto p-6 mt-20 md:p-10 scroll-smooth">
            <div class="max-w-4xl mx-auto space-y-10">
                
                <!-- Header -->
                <div class="text-center space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">
                        Scientific Computing Project (SCP)
                    </h1>
                    
                    <div class="flex justify-center gap-2 flex-wrap">
                        <a href="https://www.python.org/">
                            <img src="https://img.shields.io/badge/Python-3364ff?style=for-the-badge&logo=python&logoColor=white" alt="Python Badge">
                        </a>
                        <a href="https://pytorch.org/">
                            <img src="https://img.shields.io/badge/PyTorch-EE4C2C?style=for-the-badge&logo=pytorch&logoColor=white" alt="PyTorch Badge">
                        </a>
                        <a href="https://opensource.org/licenses/MIT">
                            <img src="https://img.shields.io/badge/License-MIT-purple.svg?style=for-the-badge" alt="MIT License Badge">
                        </a>
                    </div>

                    <div class="flex justify-center">
                        <img src="{{ asset('images/scp.png') }}" 
                             alt="SCP Logo" 
                             class="rounded-2xl shadow-lg max-w-full h-auto border border-gray-200 dark:border-gray-700">
                    </div>

                    <div class="flex justify-center">
                        <a href="https://github.com/parsabe/SCP" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            View Source Code
                        </a>
                    </div>

                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-justify">
                        <p>This project provides a <strong>modular, extensible, and research-oriented deep learning pipeline</strong> for image classification. It is designed for experimentation, hyperparameter optimization, and architecture extensibility.</p>
                        <p>The first implemented architecture is based on <a href="https://github.com/hounaar/SCP/tree/master/VGG-16" class="text-blue-600 dark:text-blue-400 hover:underline"><strong>VGG-16</strong></a>, with clear separation of training, tuning, and evaluation components. Additional architectures will be added in future updates.</p>
                        <p>You can download the augmented dataset <a href="https://github.com/hounaar/SCP/releases/tag/data" class="text-blue-600 dark:text-blue-400 hover:underline">here</a>.</p>
                    </div>
                </div>

                <!-- License and Reference -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">License and Reference</h2>
                    </div>
                    <div class="text-gray-600 dark:text-gray-300 space-y-2">
                        <p>This project is licensed under the <a href="https://opensource.org/licenses/MIT" class="text-blue-600 dark:text-blue-400 hover:underline">MIT License</a>.</p>
                        <p>If you use this project for academic or research purposes, please consider citing it or mentioning the contributors.</p>
                    </div>
                </section>

                <!-- Contributors -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Contributors</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">The following contributors are actively working on this project:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                        <li><a href="https://github.com/Lars314159" class="text-blue-600 dark:text-blue-400 hover:underline">Lars Wunderlich</a></li>
                        <li><a href="https://github.com/ToniMahojoni" class="text-blue-600 dark:text-blue-400 hover:underline">Toni Sand</a></li>
                        <li><a href="https://github.com/hounaar" class="text-blue-600 dark:text-blue-400 hover:underline">Parsa Besharat</a></li>
                    </ul>
                </section>

                <!-- Development Status -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Development Status</h2>
                    </div>
                    <div class="text-gray-600 dark:text-gray-300 space-y-2">
                        <p>This project is in <strong>active development</strong> under the Scientific Computing Project (SCP). Additional architectures and evaluation modules will be added in future releases.</p>
                        <p>For questions, issues, or contributions, please use the <a href="https://github.com/hounaar" class="text-blue-600 dark:text-blue-400 hover:underline">GitHub repository</a>.</p>
                    </div>
                </section>

            </div>
        </main>
    </div>
</body>
</html>