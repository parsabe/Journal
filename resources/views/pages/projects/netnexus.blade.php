<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetNexus Project - Parsa Besharat</title>

    <meta name="description" content="NetNexus is a collection of innovative web projects by Parsa Besharat, including Blue Pearl Chat Portal, Nigma Riddle Game, Sandika Social Media, and Huffman Algorithm implementation.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="NetNexus, Web Projects, Blue Pearl Chat, Nigma Riddle Game, Sandika Social Media, Huffman Algorithm, PHPortal, Parsa Besharat, Open Source">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="NetNexus Project - Parsa Besharat">
    <meta property="og:description" content="NetNexus is a collection of innovative web projects by Parsa Besharat, including Blue Pearl Chat Portal, Nigma Riddle Game, Sandika Social Media, and more.">
    <meta property="og:image" content="https://github.com/parsabe/NetNexus/blob/master/logo.png?raw=true">
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
                
                <div class="text-center space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">
                        NetNexus
                    </h1>
                    
                    <div class="flex justify-center gap-2 flex-wrap">
                        <a href="https://opensource.org/licenses/MIT">
                            <img src="https://img.shields.io/badge/License-MIT-purple.svg?style=for-the-badge" alt="MIT License Badge">
                        </a>
                    </div>

                    <div class="flex justify-center">
                        <img src="https://github.com/parsabe/NetNexus/blob/master/logo.png?raw=true" 
                             alt="NetNexus Logo" 
                             class="rounded-2xl shadow-lg max-w-sm h-auto border border-gray-200 dark:border-gray-700">
                    </div>

                    <div class="flex justify-center">
                        <a href="https://github.com/parsabe/NetNexus" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            View Repository
                        </a>
                    </div>

                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-justify">
                        <p>A collection of innovative web projects including a dynamic website, an engaging online riddle game, a social media platform, and a chat portal. Explore creative solutions and interactive experiences.</p>
                    </div>
                </div>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Projects</h2>
                    </div>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 font-medium">
                        <li>
                            <a href="https://github.com/parsabe/NetNexus/tree/master/blue-pearl" class="flex items-center gap-2 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                <span class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 px-2 py-0.5 rounded text-sm">1</span> 
                                Blue Pearl Chat Portal
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/parsabe/NetNexus/tree/master/nigma" class="flex items-center gap-2 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                <span class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 px-2 py-0.5 rounded text-sm">2</span> 
                                Nigma Online Riddle Game
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/parsabe/NetNexus/tree/master/sandika" class="flex items-center gap-2 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                <span class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 px-2 py-0.5 rounded text-sm">3</span> 
                                Sandika Social Media
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/parsabe/NetNexus/tree/master/huffman" class="flex items-center gap-2 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                <span class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 px-2 py-0.5 rounded text-sm">4</span> 
                                Huffman Algorithm
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/hounaar/NetNexus/tree/master/PHPortal" class="flex items-center gap-2 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                <span class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 px-2 py-0.5 rounded text-sm">5</span> 
                                PHPortal
                            </a>
                        </li>
                    </ul>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Contributing</h2>
                    </div>
                    <div class="text-gray-600 dark:text-gray-300 space-y-2">
                        <p>We welcome contributions! Thank you for visiting our repository. If you have any questions or feedback, please open an issue or reach out directly.</p>
                    </div>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">License</h2>
                    </div>
                    <div class="text-gray-600 dark:text-gray-300 space-y-2">
                        <p>This project is licensed under the <a href="https://opensource.org/licenses/MIT" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">MIT License</a>.</p>
                    </div>
                </section>

            </div>
        </main>
    </div>
</body>
</html>