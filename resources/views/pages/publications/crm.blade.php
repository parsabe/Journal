<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mining Usage in CRM - Parsa Besharat</title>

    <meta name="description" content="Research paper by Parsa Besharat on the usage of Data Mining in Customer Relationship Management (CRM) to enhance customer retention, loyalty, and service quality through predictive analytics.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="Data Mining, CRM, Customer Relationship Management, Customer Retention, Predictive Analytics, Business Intelligence, Parsa Besharat, Research Paper">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Data Mining Usage in CRM - Parsa Besharat">
    <meta property="og:description" content="Research paper by Parsa Besharat on the usage of Data Mining in Customer Relationship Management (CRM) to enhance customer retention, loyalty, and service quality.">
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
                        📄 RESEARCH PAPER
                    </span>
                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white drop-shadow-sm leading-tight">
                        Data mining usage in Customer Relation management (CRM)
                    </h1>
                    
                    <div class="flex flex-col items-center justify-center gap-2 text-gray-600 dark:text-gray-400 font-medium">
                        <p class="text-lg text-gray-800 dark:text-gray-200 font-semibold">Parsa Besharat</p>
                        <p class="text-sm">October 2022</p>
                    </div>
                </header>

                <section class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-blue-500 to-purple-600"></div>
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Abstract</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify mb-4">
                        Today, with the headway of data innovation, the Web, correspondence promoting has turned into a certain reality lately. Innovations, for example, information distribution centers, information mining and programming the executives, client relationship the board as a field has presented another manner by which associations and organizations can acquire an upper hand.
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify mb-4">
                        Particularly through information Mining, by separating concealed data from an enormous data set, associations can decide and treat important clients and foresee their future. Information mining is one of the areas that assist the association in pursuing the right and ideal choices In the serious business climate, all associations and organizations whose clients are the focal point of their consideration. 
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                        This article, a strategy for assessing the expansion in help quality and client faithfulness in organizations and foundations in the event of laying out a course of a decent connection between the market and the client and educating and uninvolved the mindset regarding the clients. It is an information mining help and furthermore, things like objectives, acknowledgment, a superior comprehension of client's requirements, and in particular the level of their fulfillment with the business market to offer better types of assistance and accordingly the maintenance of beneficial clients for the organization.
                    </p>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-3 uppercase tracking-wider">Keywords</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Data Mining</span>
                            <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">CRM</span>
                            <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Customer Relationship Management</span>
                            <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Customer Retention</span>
                            <span class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">Predictive Analytics</span>
                        </div>
                    </div>
                </section>

                <div class="flex justify-center pt-4">
                    <a href="https://www.researchgate.net/publication/392626582_Data_mining_usage_in_Customer_Relation_management_CRM" target="_blank" 
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