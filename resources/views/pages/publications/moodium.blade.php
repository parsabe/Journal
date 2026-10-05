<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moodium - Parsa Besharat</title>

    <meta name="description" content="Moodium is an LLM-based culturally aware framework for multimodal emotion classification and prediction, fusing audio, visual, and textual data. Research by Parsa Besharat & Volker Göhler.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="Moodium, Affective Computing, Emotion Recognition, Large Language Models, LLM, Multimodal Fusion, Cultural Awareness, AI, Parsa Besharat, Volker Göhler">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Moodium: From Words to Feelings - Parsa Besharat">
    <meta property="og:description" content="Moodium is an LLM-based culturally aware framework for multimodal emotion classification and prediction, fusing audio, visual, and textual data.">
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
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 ios-glass text-blue-600 dark:text-blue-400 rounded-full text-sm font-bold shadow-sm">
                        📄 RESEARCH PAPER
                    </span>
                    <h1
                        class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white drop-shadow-sm leading-tight">
                        Moodium: From Words to Feelings, An LLM-Based Culturally Aware Framework for Emotion
                        Classification and Prediction
                    </h1>

                    <div
                        class="flex flex-col items-center justify-center gap-2 text-gray-600 dark:text-gray-400 font-medium">
                        <p class="text-lg text-gray-800 dark:text-gray-200 font-semibold">Parsa Besharat & Volker Göhler
                        </p>
                        <p class="text-sm">August 2025</p>
                    </div>
                </header>

                <section
                    class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-blue-500 to-purple-600"></div>
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Abstract</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                        Emotion recognition is a critical component of affective computing, enabling systems to respond
                        with empathy and adapt to human states. However, existing approaches struggle with cultural
                        bias, incomplete modality fusion, and a lack of interpretability—especially in real-world,
                        multilingual environments. This paper addresses these challenges by reviewing recent advances in
                        multimodal emotion classification and highlighting the emerging role of Large Language Models
                        (LLMs) in this domain. Building on these insights, we propose a culturally aware, LLM-integrated
                        framework that fuses audio, visual, and textual data using a staged attention mechanism with
                        adaptive gating. While full end-to-end training is still in progress, we present a detailed
                        architecture and demonstrate the system’s potential through simulated outputs interpreted by a
                        pretrained LLM. Our work lays the foundation for more robust, explainable, and culturally
                        sensitive emotion-aware systems.
                    </p>

                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-3 uppercase tracking-wider">
                            Keywords</h3>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Affective
                                Computing</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Emotion
                                Recognition</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Large
                                Language Models (LLMs)</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Multimodal
                                Fusion</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Cultural
                                Awareness</span>
                        </div>
                    </div>
                </section>

                <div class="flex justify-center pt-4">
                    <a href="https://www.researchgate.net/publication/400669787_Moodium_From_Words_to_Feelings_An_LLM-Based_Culturally_Aware_Framework_for_Emotion_Classification_and_Prediction"
                        target="_blank"
                        class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-full font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-white/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Read Full Research Paper
                    </a>
                </div>

            </div>
        </main>












    </div>
</body>

</html>