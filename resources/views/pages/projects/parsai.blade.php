<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parsai Project - Parsa Besharat</title>

    <meta name="description" content="Parsai is an Edge, Firefox, and Chrome extension, as well as a Telegram bot, designed to provide versatile coding assistance using OpenAI's GPT-4. Developed by Parsa Besharat.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="Parsai, GPT-4 Extension, Chrome Extension, Firefox Extension, Edge Extension, Telegram Bot, AI Coding Assistant, OpenAI, Parsa Besharat">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Parsai Project - Parsa Besharat">
    <meta property="og:description" content="Parsai is an Edge, Firefox, and Chrome extension, as well as a Telegram bot, designed to provide versatile coding assistance using OpenAI's GPT-4.">
    <meta property="og:image" content="https://github.com/parsabe/Parsai/blob/main/main.jpg?raw=true">
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
            <div class="max-w-4xl mx-auto space-y-12">
                
                <div class="text-center space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">
                        Parsai
                    </h1>
                    
                    <div class="flex justify-center">
                        <img src="https://github.com/parsabe/Parsai/blob/main/main.jpg?raw=true" 
                             alt="Parsai Header Image" 
                             class="rounded-2xl shadow-lg max-w-full h-auto border border-gray-200 dark:border-gray-700">
                    </div>

                    <div class="flex justify-center pt-2">
                        <a href="https://github.com/parsabe/Parsai" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            View Source Code
                        </a>
                    </div>

                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-center md:text-lg">
                        <p>Parsai is an Edge, Firefox, and Chrome extension, as well as a Telegram bot, designed to provide versatile coding assistance using OpenAI's GPT-4.</p>
                    </div>
                </div>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">1. Parsai Google Chrome Extension</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">This Chrome Extension, which uses GPT-4, helps you by responding to your queries.</p>
                    
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Features</h3>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300 ml-2">
                        <li><strong>Ask GPT-4</strong>: Enter your questions and get responses directly from GPT-4.</li>
                        <li><strong>Syntax Highlighting</strong>: Responses are formatted and highlighted based on the detected programming language.</li>
                        <li><strong>Dark Theme</strong>: The extension features a sleek dark theme with black and dark purple colors.</li>
                    </ul>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Setup</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li><strong>Download the Source Code</strong>: Download the source code from the <a href="https://github.com/your-username/parsai/releases" class="text-blue-600 dark:text-blue-400 hover:underline">Releases</a> page.</li>
                        <li><strong>Extract the Zip File</strong>: Extract the downloaded zip file.</li>
                        <li><strong>OpenAI API key</strong>: Go to <a href="https://platform.openai.com/settings/organization/api-keys" class="text-blue-600 dark:text-blue-400 hover:underline">OpenAI API Document</a> and get your OpenAI key.</li>
                        <li><strong>Paste</strong>: Paste your OpenAI key in the <code>popup.js</code> code here:</li>
                    </ol>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-3 mb-4"><code>const OPENAI_API_KEY = ''; //openAI API Key</code></pre>
                    <ol start="5" class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li><strong>Load Unpacked Extension</strong>:
                            <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                                <li>Open Chrome and navigate to <code>chrome://extensions/</code>.</li>
                                <li>Enable Developer Mode by toggling the switch in the top right corner.</li>
                                <li>Click on <code>Load unpacked</code> and select the extracted directory.</li>
                            </ul>
                        </li>
                    </ol>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">2. Parsai Telegram Bot</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">The Parsai Telegram bot allows you to ask coding questions and receive answers.</p>
                    
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Features</h3>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Ask questions and get answers from GPT-4 directly in Telegram.</li>
                        <li>Easy to use and accessible from anywhere.</li>
                    </ul>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Setup</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Go to <a href="https://platform.openai.com/settings/organization/api-keys" class="text-blue-600 dark:text-blue-400 hover:underline">OpenAI API Document</a>.</li>
                        <li>Download the Python code from here.</li>
                        <li>Install python modules dependencies:</li>
                    </ol>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-3 mb-4"><code>pip install openai python-telegram-bot</code></pre>
                    <ol start="4" class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Install telegram and go to <a href="https://t.me/BotFather" class="text-blue-600 dark:text-blue-400 hover:underline">Telegram BotFather (bot creator)</a>.</li>
                        <li>Copy both the OpenAI API key and Telegram bot access token you set and paste them here:</li>
                    </ol>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-3 mb-4"><code>OPENAI_API_KEY = '' #OpenAI API Code
TELEGRAM_API_KEY = '' #Telgram Bot Access Token</code></pre>
                    <ol start="6" class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Then Press on start.</li>
                    </ol>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">3. Firefox Extension</h2>
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Step 0: Prepare Your Extension Files</h3>
                    <p class="text-gray-600 dark:text-gray-300">Ensure your extension files (<code>manifest.json</code>, <code>popup.html</code>, <code>popup.js</code>, <code>styles.css</code>, etc.) are complete and properly configured. If needed, include the updated <code>browser_specific_settings</code> field in the <code>manifest.json</code> for Firefox compatibility.</p>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Step 1: OpenAI Setup</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li><strong>Download the Source Code</strong>: Download the source code from the <a href="https://github.com/your-username/parsai/releases" class="text-blue-600 dark:text-blue-400 hover:underline">Releases</a> page.</li>
                        <li><strong>Extract the Zip File</strong>: Extract the downloaded zip file.</li>
                        <li><strong>OpenAI API key</strong>: Go to <a href="https://platform.openai.com/settings/organization/api-keys" class="text-blue-600 dark:text-blue-400 hover:underline">OpenAI API Document</a> and get your OpenAI key.</li>
                        <li><strong>Paste</strong>: Paste your OpenAI key in the <code>popup.js</code> code here:</li>
                    </ol>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-3 mb-4"><code>const OPENAI_API_KEY = ''; //openAI API Key</code></pre>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Step 2: Open Firefox Developer Tools</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Launch <strong>Firefox Developer Edition</strong> or <strong>Firefox Nightly</strong>.
                            <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                                <li>These are ideal for extension development and testing.</li>
                                <li>Regular Firefox works too, but some features may be restricted.</li>
                            </ul>
                        </li>
                    </ol>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Step 3: Navigate to Debugging Page</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Open a new tab.</li>
                        <li>Go to <code>about:debugging</code>.</li>
                        <li>Click on <strong>"This Firefox"</strong> (or <strong>"This Nightly"</strong> if using Nightly).</li>
                    </ol>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Step 4: Load the Extension</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Click on <strong>"Load Temporary Add-on"</strong>.</li>
                        <li>Navigate to your extension’s folder.</li>
                        <li>Select any file in the extension directory (e.g., <code>manifest.json</code>).</li>
                        <li>Firefox will load the extension temporarily.</li>
                    </ol>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">4. Microsoft Edge Extension</h2>
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Step 0: Prepare Your Extension Files</h3>
                    <p class="text-gray-600 dark:text-gray-300">Ensure your extension files (<code>manifest.json</code>, <code>popup.html</code>, <code>popup.js</code>, <code>styles.css</code>, etc.) are complete and properly configured. Edge supports WebExtension APIs, so your extension’s <code>manifest.json</code> should already be compatible. Double-check permissions and ensure everything is in place.</p>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Step 1: OpenAI Setup</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li><strong>Download the Source Code</strong>: Download the source code from the <a href="https://github.com/your-username/parsai/releases" class="text-blue-600 dark:text-blue-400 hover:underline">Releases</a> page.</li>
                        <li><strong>Extract the Zip File</strong>: Extract the downloaded zip file.</li>
                        <li><strong>OpenAI API key</strong>: Go to <a href="https://platform.openai.com/settings/organization/api-keys" class="text-blue-600 dark:text-blue-400 hover:underline">OpenAI API Document</a> and get your OpenAI key.</li>
                        <li><strong>Paste</strong>: Paste your OpenAI key in the <code>popup.js</code> code here:</li>
                    </ol>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-3 mb-4"><code>const OPENAI_API_KEY = ''; //openAI API Key</code></pre>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Step 2: Open Edge Extensions Page</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Launch <strong>Microsoft Edge</strong>.</li>
                        <li>Open a new tab and go to <code>edge://extensions/</code>.</li>
                        <li>Enable <strong>Developer mode</strong> by toggling the switch in the bottom left corner.</li>
                    </ol>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Step 3: Load Your Extension</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Click on <strong>"Load unpacked"</strong>.</li>
                        <li>Navigate to your extension’s folder.</li>
                        <li>Select the folder containing your extension files (not an individual file).</li>
                    </ol>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Step 4: Test Your Extension</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>The extension’s icon should now appear in the Edge toolbar.</li>
                        <li>Click the icon to open and test your extension.</li>
                        <li>Verify all functionality, including inputs, buttons, and API calls.</li>
                    </ol>
                </section>

            </div>
        </main>
    </div>

    </div>
</body>

</html>
