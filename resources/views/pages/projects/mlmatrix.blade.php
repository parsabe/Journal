<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MLMatrix Project - Parsa Besharat</title>

    <meta name="description" content="MLMatrix is a comprehensive repository of Data Science and AI projects by Parsa Besharat, covering Scientific ML, Data Assimilation, High Performance Computing, and Crypto Currency Datasets.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="MLMatrix, Data Science, AI, Machine Learning, Scientific ML, Data Assimilation, High Performance Computing, Crypto Datasets, Parsa Besharat, Research">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="MLMatrix Project - Parsa Besharat">
    <meta property="og:description" content="MLMatrix is a comprehensive repository of Data Science and AI projects by Parsa Besharat, covering Scientific ML, Data Assimilation, High Performance Computing, and more.">
    <meta property="og:image" content="{{ asset('images/profile.jpg') }}">
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

        <main class="flex-1 overflow-y-auto p-6 md:p-10 scroll-smooth">
            <div class="max-w-4xl mx-auto space-y-10">
                
                <!-- Header -->
                <div class="text-center space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">
                        MLMatrix
                    </h1>
                      <div class="flex justify-center">
                        <a href="https://github.com/parsabe/MLMatrix" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            View Source Code
                        </a>
                    </div>
                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-justify">
                        <p>Welcome to the Tech Insights Repository! This repository features four in-depth articles covering a range of cutting-edge technologies and their applications. Explore the fascinating intersections of my data science projects.</p>
                        <p>This Repository includes all of Data Analysis and Data Science Projects that I have done or am going to do.</p>
                    </div>
                </div>

                <!-- Projects -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Projects</h2>
                    </div>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                        <li><a href='https://github.com/parsabe/MLMatrix/tree/master/src/Crypto%20Currency%20Datasets' class="text-blue-600 dark:text-blue-400 hover:underline">Crypto Currency Datasets</a></li>
                        <li><a href='https://github.com/parsabe/MLMatrix/tree/master/src/Scraper' class="text-blue-600 dark:text-blue-400 hover:underline">Scraper</a></li>
                        <li><a href='https://github.com/parsabe/MLMatrix/tree/master/src/Scientific%20ML' class="text-blue-600 dark:text-blue-400 hover:underline">Scientific ML</a></li>
                        <li><a href='https://github.com/parsabe/MLMatrix/tree/master/src/Data%20Assimiliation' class="text-blue-600 dark:text-blue-400 hover:underline">Data Assimiliation</a></li>
                        <li><a href='https://github.com/parsabe/MLMatrix/tree/master/src/AI' class="text-blue-600 dark:text-blue-400 hover:underline">AI</a></li>
                        <li><a href='https://github.com/parsabe/MLMatrix/tree/master/src/High%20Performance%20Computing' class="text-blue-600 dark:text-blue-400 hover:underline">High Performance Computing</a></li>
                        <li><a href='https://github.com/parsabe/MLMatrix/tree/master/src/High%20Performance%20Computing2' class="text-blue-600 dark:text-blue-400 hover:underline">High Performance Computing 2</a></li>
                        <li><a href='https://github.com/parsabe/MLMatrix/tree/master/src/Introduction%20of%20machine%20learning' class="text-blue-600 dark:text-blue-400 hover:underline">Machine Learning and Big Data</a></li>
                        <li><a href='https://github.com/parsabe/MLMatrix/tree/master/src/Mathematical%20Machine%20Learning' class="text-blue-600 dark:text-blue-400 hover:underline">Mathematical Machine Learning</a></li>
                        <li><a href='https://github.com/parsabe/MLMatrix/tree/master/src/Methods%20of%20Machine%20Learning' class="text-blue-600 dark:text-blue-400 hover:underline">Methods of Machine Learning</a></li>
                    </ul>
                </section>

                <!-- Contributing -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Contributing</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">
                        We welcome contributions!
                    </p>
                </section>

                <!-- License -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">License</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">
                        This project is licensed under the MIT License.
                    </p>
                </section>

                <!-- Footer Message -->
                <section class="space-y-4 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <p class="text-gray-600 dark:text-gray-300 text-center italic">
                        Thank you for visiting our repository! If you have any questions or feedback, please open an issue or reach out directly.
                    </p>
                </section>

            </div>
        </main>
    </div>
</body>
</html>