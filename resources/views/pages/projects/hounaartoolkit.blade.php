<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HounaarToolkit Project - Parsa Besharat</title>

    <meta name="description" content="HounaarToolkit is a versatile Python toolkit for data analysis, YouTube downloading, crypto price checking, network scanning, and rootkit detection. Developed by Parsa Besharat.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="HounaarToolkit, Python Toolkit, Data Analysis AI, YouTube Downloader, Crypto Price Checker, Network Scanner, Rootkit Detection, Type Rover, Open Source, Parsa Besharat">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="HounaarToolkit Project - Parsa Besharat">
    <meta property="og:description" content="HounaarToolkit is a versatile Python toolkit for data analysis, YouTube downloading, crypto price checking, network scanning, and rootkit detection.">
    <meta property="og:image" content="https://github.com/hounaar/HounaarToolkit/blob/main/logo.png?raw=true">
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
                        HounaarToolkit
                    </h1>
                    
                    <div class="flex justify-center">
                        <img src="https://github.com/hounaar/HounaarToolkit/blob/main/logo.png?raw=true" 
                             alt="HounaarToolkit Logo" 
                             class="rounded-2xl shadow-lg max-w-sm h-auto border border-gray-200 dark:border-gray-700">
                    </div>

                    <div class="flex justify-center pt-2">
                        <a href="https://github.com/parsabe/HounaarToolkit" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            View Source Code
                        </a>
                    </div>

                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-center md:text-lg">
                        <p>HounaarToolkit is a versatile Python toolkit that provides a set of tools for various tasks, including data analysis, YouTube video downloading, cryptocurrency price checking, typing automation, network scanning, and rootkit detection. This toolkit aims to simplify and streamline these common tasks into a single, easy-to-use package.</p>
                    </div>
                </div>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Features</h2>
                    </div>
                    <ul class="list-disc list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li><strong>Data Analysis AI:</strong> Perform data analysis with AI-powered tools to gain insights from your data effortlessly.</li>
                        <li><strong>YouTube Downloader:</strong> Download YouTube videos and playlists with ease, all from the command line.</li>
                        <li><strong>Cryptocurrency Price Checker:</strong> Get real-time cryptocurrency prices and information for your favorite coins.</li>
                        <li><strong>Type Rover:</strong> Automate typing tasks by simulating keyboard input. Useful for repetitive typing jobs.</li>
                        <li><strong>Network Scanner:</strong> Scan your network to discover connected devices and check their status.</li>
                        <li><strong>Rootkit Scanner:</strong> Detect rootkits and suspicious system files to ensure the security of your system.</li>
                    </ul>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Installation</h2>
                    </div>
                    
                    <p class="text-gray-600 dark:text-gray-300">You can install HounaarToolkit using git cloning:</p>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-2 mb-4"><code>git clone https://github.com/hounaar/HounaarToolkit.git</code></pre>
                    
                    <p class="text-gray-600 dark:text-gray-300 mt-4">Alternatively, for installing via pip, ensure you have Python 3.x installed on your system:</p>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-2 mb-4"><code>pip install HounaarToolkit</code></pre>

                    <p class="text-gray-600 dark:text-gray-300 mt-6">After installation, you'll need to add the HounaarToolkit executable to your system's PATH. Here's how you can do it on different platforms:</p>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Windows</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Find the directory where HounaarToolkit was installed. Typically, it's located here:</li>
                    </ol>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-3 mb-4"><code>C:\Users\YourUsername\AppData\Roaming\Python\Python{YourPythonVersion}\Scripts</code></pre>
                    <ol start="2" class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Copy the path to this directory.</li>
                        <li>Open the Start menu, search for "Environment Variables," and select "Edit the system environment variables."</li>
                        <li>In the System Properties window, click the "Environment Variables" button.</li>
                        <li>In the Environment Variables window, under "System Variables," find the "Path" variable, select it, and click the "Edit" button.</li>
                        <li>In the Edit Environment Variable window, click the "New" button, and paste the path to the HounaarToolkit directory.</li>
                        <li>Click "OK" to save your changes.</li>
                    </ol>

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-6">Linux and macOS</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600 dark:text-gray-300 ml-2">
                        <li>Open a terminal window.</li>
                        <li>Run the following command, replacing <code>/path/to/HounaarToolkit</code> with the actual path to the executable directory:</li>
                    </ol>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-3 mb-4"><code>export PATH=$PATH:/path/to/HounaarToolkit</code></pre>
                    <p class="text-gray-600 dark:text-gray-300 ml-2 mt-2">You can also add this command to your shell's configuration file (e.g., <code>~/.bashrc</code> or <code>~/.zshrc</code>) to make it permanent.</p>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Usage</h2>
                    </div>
                    
                    <p class="text-gray-600 dark:text-gray-300">Once HounaarToolkit is added to your PATH, you can run it from the command line:</p>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-3 mb-4"><code>hounaartoolkit</code></pre>
                    
                    <p class="text-gray-600 dark:text-gray-300 mt-4">Choose from the following commands:</p>
                    <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-300 ml-2 mt-2 font-medium">
                        <li>Data Analysis AI</li>
                        <li>YouTube Downloader</li>
                        <li>Cryptocurrency Price Checker</li>
                        <li>Type Rover</li>
                        <li>Network Scanner</li>
                        <li>Rootkit Scanner</li>
                        <li>Exit</li>
                    </ol>
                    <p class="text-gray-600 dark:text-gray-300 mt-4">Select the tool you want to use by entering the corresponding number.</p>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Requirements</h2>
                    </div>
                    
                    <p class="text-gray-600 dark:text-gray-300">HounaarToolkit requires the following Python libraries, which will be automatically installed when you install the package using pip:</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-gray-600 dark:text-gray-300 font-mono text-sm ml-2 mt-4 mb-4">
                        <div>• numpy</div>
                        <div>• pandas</div>
                        <div>• matplotlib</div>
                        <div>• seaborn</div>
                        <div>• reportlab</div>
                        <div>• scikit-learn</div>
                        <div>• pyautogui</div>
                        <div>• colorama</div>
                        <div>• PyPDF2</div>
                        <div>• pytube</div>
                        <div>• requests</div>
                        <div>• beautifulsoup4</div>
                        <div>• scapy</div>
                        <div>• python-nmap</div>
                    </div>

                    <p class="text-gray-600 dark:text-gray-300 mt-6">These libraries are essential for various functionalities within HounaarToolkit. You can also install them via the command below:</p>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-3 mb-4"><code>pip install -r req.txt</code></pre>
                </section>

                <section class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Contributing</h2>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300">If you'd like to contribute to HounaarToolkit, please open an issue or submit a pull request on our GitHub repository. We welcome contributions and suggestions from the community.</p>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">License</h2>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300">HounaarToolkit is licensed under the <a href="https://opensource.org/licenses/MIT" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">MIT License</a>. See the LICENSE file for details.</p>
                    </div>
                </section>

            </div>
        </main>
    </div>

    </div>
</body>

</html>
