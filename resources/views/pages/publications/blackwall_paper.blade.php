<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlackWall - Parsa Besharat</title>

    <meta name="description" content="BlackWall is a domain-aware and interpretable framework designed to identify, assess, and rank high-risk content across online platforms to prevent AI from going rogue. Research by Parsa Besharat.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="BlackWall, AI Safety, Suicidal Ideation Detection, Interpretable AI, Generative AI Moderation, Rogue AI Prevention, Parsa Besharat, Research Paper">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="BlackWall Paper - Parsa Besharat">
    <meta property="og:description" content="BlackWall is a domain-aware and interpretable framework designed to identify, assess, and rank high-risk content across online platforms to prevent AI from going rogue.">
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
                        BlackWall – Protect an AI from going rogue via an AI
                    </h1>

                    <div
                        class="flex flex-col items-center justify-center gap-2 text-gray-600 dark:text-gray-400 font-medium">
                        <p class="text-lg text-gray-800 dark:text-gray-200 font-semibold">Parsa Besharat</p>
                        <p class="text-sm">Department of Math and Computer Science, Technische Universität Bergakademie
                            Freiberg, Freiberg, Germany</p>
                        <a href="mailto:parsa.besharat@student.tu-freiberg.de"
                            class="text-blue-500 hover:underline text-sm">parsa.besharat@student.tu-freiberg.de</a>
                        <a href="https://orcid.org/0009-0006-0867-4511" target="_blank"
                            class="text-green-600 dark:text-green-400 hover:underline text-sm flex items-center gap-1 mt-2">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zM7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 01-.947-.947c0-.525.422-.947.947-.947zm-.722 3.038h1.444v10.041H6.647V7.416zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025 0 2.578-2.016 5.025-5.325 5.025h-3.919V7.416zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722 0-2.016-1.284-3.722-4.097-3.722h-2.222z" />
                            </svg>
                            ORCID: 0009-0006-0867-4511
                        </a>
                    </div>
                </header>

                <section
                    class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-blue-500 to-purple-600"></div>
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Abstract</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                        The increasing integration of social media and conversational AI into daily life has intensified
                        concerns around the spread of harmful, illegal, and psychologically sensitive content, including
                        suicidal ideation, self-harm, depression, and other forms of negative influence. Recent cases of
                        emotional attachment to chatbots and instances where AI systems have unintentionally misled
                        users on mental health issues highlight the urgency of reliable safety mechanisms. This paper
                        presents Blackwall, a domain-aware and interpretable framework designed to identify, assess, and
                        rank high-risk content across online platforms. By operating across heterogeneous data sources
                        and providing transparent risk explanations, Blackwall supports early intervention, responsible
                        moderation, and safer human–AI interaction. The framework aims to contribute toward ethically
                        grounded content safety systems that can mitigate psychological harm while preserving
                        transparency and trust.
                    </p>

                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-3 uppercase tracking-wider">
                            Keywords</h3>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">AI
                                Safety</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Suicidal
                                Ideation Detection</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Interpretable
                                AI</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Generative
                                AI Moderation</span>
                            <span
                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Rogue
                                AI Prevention</span>
                        </div>
                    </div>
                </section>

                <div class="flex justify-center pt-4">
                    <a href="https://www.researchgate.net/publication/400669946_BlackWall_-Protect_an_AI_from_going_rogue_via_an_AI"
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