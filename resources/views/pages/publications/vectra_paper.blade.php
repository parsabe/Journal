<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vectra Paper - Parsa Besharat</title>

    <meta name="description"
        content="Vectra is an end-to-end framework designed to generate, extract, and simulate high-fidelity 3D objects from 2D inputs. Research paper by Parsa Besharat.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords"
        content="Vectra, Spatial Computing, 3D Gaussian Splatting, Neural Rendering, Physics Simulation, Generative AI, Parsa Besharat, Research Paper">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Vectra Paper - Parsa Besharat">
    <meta property="og:description"
        content="Vectra is an end-to-end framework designed to generate, extract, and simulate high-fidelity 3D objects from 2D inputs.">
    <meta property="og:image" content="{{ asset('images/vectra.png') }}">
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
                        class="inline-flex items-center gap-2 px-4 py-1.5 ios-glass text-blue-600 dark:text-blue-400 rounded-full text-sm font-bold shadow-sm">
                        📄 RESEARCH PAPER
                    </span>
                    <h1
                        class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white drop-shadow-sm leading-tight">
                        Vectra: The Quarantine Matrix, Constraining Neural Hallucinations in 3D Gaussian Environments
                    </h1>

                    <div
                        class="flex flex-col items-center justify-center gap-2 text-gray-600 dark:text-gray-400 font-medium">
                        <p class="text-lg text-gray-800 dark:text-gray-200 font-semibold">Parsa Besharat</p>
                        <p class="text-sm">Department of Math and Computer Science, Technische Universität Bergakademie
                            Freiberg, Freiberg, Germany</p>
                        <a href="mailto:parsabe99@gmail.com"
                            class="text-blue-500 hover:underline text-sm">parsabe99@gmail.com</a>

                    </div>
                </header>

                <section
                    class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-blue-500 to-purple-600"></div>
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Abstract</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                        The hyper-accelerated rise of generative artificial intelligence is rewiring the rules of 3D
                        content creation. Yet, seamlessly jacking everyday 2D inputs—like text prompts and flat
                        images—into fully interactive, dynamic 3D constructs remains a critical bottleneck. This paper
                        introduces an end-to-end framework engineered to generate, extract, and simulate high-fidelity
                        3D objects directly from simple visual and textual data. By harnessing advanced neural rendering
                        and spatial splatting algorithms, our system spins up robust 3D assets on the fly, entirely
                        bypassing the tedious grind of traditional manual modeling. We orchestrate a streamlined
                        pipeline that fuses zero-shot semantic extraction, generative mesh synthesis, and web-based
                        physics integration. This unified architecture doesn't just supercharge the rendering of complex
                        3D scenes; it breathes real-time kinetic life into them, enabling fluid dynamic simulation and
                        direct user manipulation. We benchmark the framework’s performance across structural integrity,
                        pipeline latency, and interactive immersion within a scalable network. Ultimately, this work
                        delivers a highly optimized, plug-and-play solution that accelerates the 3D creation workflow,
                        paving the way for the next generation of accessible, dynamic, and fully interactive digital
                        realities.
                    </p>

                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-3 uppercase tracking-wider">
                            Keywords</h3>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">3D
                                Content Creation</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">3D
                                Gaussian Splatting</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Neural
                                Rendering</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Physics
                                Simulation</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Generative
                                AI</span>
                        </div>
                    </div>
                </section>

                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-4">
                    <a href="https://www.researchgate.net/publication/408133286_Vectra_The_Quarantine_Matrix_Constraining_Neural_Hallucinations_in_3D_Gaussian_Environments"
                        target="_blank"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-full font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-white/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Read Paper
                    </a>

                    <a href="https://vectra.parsabe.com" target="_blank"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 hover:bg-white/20 text-gray-900 dark:text-white rounded-full font-bold shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-gray-300 dark:border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                            </path>
                        </svg>
                        Project Website
                    </a>
                </div>

            </div>
        </main>
    </div>
</body>

</html>