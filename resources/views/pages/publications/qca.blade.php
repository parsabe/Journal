<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantum-dot Cellular Automata (QCA) - Parsa Besharat</title>

    <meta name="description" content="Research paper by Parsa Besharat exploring Quantum-dot Cellular Automata (QCA), a groundbreaking concept for nanoscale computing using quantum dots for data representation.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="Quantum-dot Cellular Automata, QCA, Nanoscale Computing, Quantum Mechanics, Binary Encoding, Semiconductor Technology, Parsa Besharat, Research Paper">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Quantum-dot Cellular Automata (QCA) - Parsa Besharat">
    <meta property="og:description" content="Research paper by Parsa Besharat exploring Quantum-dot Cellular Automata (QCA), a groundbreaking concept for nanoscale computing using quantum dots.">
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

<body class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-4 lg:p-10 min-h-screen relative overflow-x-hidden">
   <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[85vh] z-10 transition-colors duration-700">

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
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 ios-glass text-blue-600 dark:text-blue-400 rounded-full text-sm font-bold shadow-sm">
                        📄 CONFERENCE PAPER
                    </span>
                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white drop-shadow-sm leading-tight">
                        Quantum-dot Cellular Automata (QCA)
                    </h1>
                    
                    <div class="flex flex-col items-center justify-center gap-2 text-gray-600 dark:text-gray-400 font-medium">
                        <p class="text-lg text-gray-800 dark:text-gray-200 font-semibold">Parsa Besharat</p>
                        <p class="text-sm">April 2019 • Conference: Quantum-dot Cellular Automata (QCA)</p>
                    </div>
                </header>

                <section class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-blue-500 to-purple-600"></div>
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Abstract</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify mb-6">
                        In the rapidly evolving field of computational technology, Quantum-dot Cellular Automata (QCA) emerges as a groundbreaking concept, marking a paradigm shift from traditional transistor-based computing to quantum-level data manipulation. This paper presents an in-depth exploration of QCA, focusing on its innovative approach that harnesses the quantum mechanical properties of electrons within quantum dots for data representation and processing.
                    </p>

                    <div class="my-8">
                        
                    </div>

                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify mb-4">
                        These nano-scale quantum dots, arranged in cellular structures, offer a unique binary encoding mechanism, where electron positions and arrangements encode 0s and 1s, thus facilitating logical operations and data transmission. The potential of QCA to revolutionize computing is anchored in its promise for high-speed operation and drastically reduced power consumption, challenging the limitations of current semiconductor technologies. This study delves into the technical intricacies of QCA, examining the interplay of quantum dots in performing complex computational tasks. We also explore the architectural nuances of QCA, demonstrating how electron interactions within these quantum dot arrays can be harnessed for efficient information processing.
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                        Furthermore, this paper addresses the critical challenges and future prospects of QCA implementation in real-world computing scenarios. Key issues such as temperature sensitivity, which is a major consideration due to the quantum nature of the technology, and the complexities involved in fabricating nanoscale quantum dots are discussed in detail. We also consider the scalability of QCA and its compatibility with existing computing infrastructures.
                    </p>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-3 uppercase tracking-wider">Keywords</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Quantum-dot Cellular Automata (QCA)</span>
                            <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Nanoscale Computing</span>
                            <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Quantum Mechanics</span>
                            <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Binary Encoding</span>
                            <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Semiconductor Technology</span>
                        </div>
                    </div>
                </section>

                <div class="flex justify-center pt-4">
                    <a href="https://www.researchgate.net/publication/392637941_Quantum-dot_Cellular_Automata_QCA" target="_blank" 
                       class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-full font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-white/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Read Full Research Paper
                    </a>
                </div>

            </div>
        </main>
    </div>
</body>
</html>