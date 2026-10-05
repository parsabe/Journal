<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceasar Toolkit Project- Parsa Besharat</title>

    <meta name="description" content="Ceasar Toolkit is a free, open-source Python CLI framework for Ceasar cipher encoding, PDF encryption, and folder encryption using EncFS. Developed by Parsa Besharat.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="Ceasar Toolkit, Ceasar Cipher, Python CLI, PDF Encryption, Folder Encryption, EncFS, Open Source, Parsa Besharat, Cryptography Tool, Security">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Ceasar Toolkit Project - Parsa Besharat">
    <meta property="og:description" content="Ceasar Toolkit is a free, open-source Python CLI framework for Ceasar cipher encoding, PDF encryption, and folder encryption using EncFS.">
    <meta property="og:image" content="{{ asset('images/ceasar.png') }}">
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
                        Ceasar Toolkit
                    </h1>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/ceasar.png') }}" 
                             alt="Ceasar Toolkit Logo" 
                             width="1080" height="540"
                             class="rounded-2xl shadow-lg max-w-full h-auto border border-gray-200 dark:border-gray-700">
                    </div>
                    <div class="flex justify-center">
                        <a href="https://github.com/parsabe/Ceasar-Toolkit" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            View Source Code
                        </a>
                    </div>
                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-justify">
                        <p><strong>Ceasar Cipher Toolkit</strong> is a free, open-source CLI framework for encoding and decoding files using the classic Ceasar cipher. It also includes powerful tools to encrypt PDFs and folders — without compressing or modifying original file contents.</p>
                        <p><strong>No command-line arguments required</strong> — just run and go. The interactive menu handles everything.</p>
                    </div>
                </div>

                <!-- Features -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Features</h2>
                    </div>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                        <li>Interactive menu-driven interface</li>
                        <li>Ceasar cipher encode/decode with header-based shift tracking</li>
                        <li>PDF file encryption and decryption with password</li>
                        <li>Folder encryption using <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">encfs</code> (no zipping or renaming)</li>
                        <li>Animated loading spinners for all actions</li>
                        <li>Colorized success/error messages with <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">colorama</code></li>
                    </ul>
                </section>

                <!-- Example Use -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Example Use</h2>
                    </div>
                    <div class="space-y-4 text-gray-600 dark:text-gray-300">
                        <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg font-mono text-sm overflow-x-auto"><code>python main.py</code></pre>
                        <p>Then choose one of the options:</p>
                        <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg font-mono text-sm overflow-x-auto"><code>1. Ceasar Encode Text
2. Ceasar Decode Text
3. Encrypt PDF
4. Decrypt PDF
5. Encrypt Folder (EncFS)
6. Mount Encrypted Folder
7. Exit</code></pre>
                    </div>
                </section>

                <!-- Ceasar Cipher Usage -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Ceasar Cipher Usage</h2>
                    </div>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                        <li>Encodes any text file with a shift you provide</li>
                        <li>Stores <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">Shift:N</code> at the top of the file for auto-decoding</li>
                    </ul>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mt-4">Example</h3>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                        <li>Input: <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">document.txt</code></li>
                        <li>Output: <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">document_enc.txt</code></li>
                    </ul>
                    <p class="text-gray-600 dark:text-gray-300">Then decode → output: <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">document_dec.txt</code></p>
                </section>

                <!-- PDF Protection -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">PDF Protection</h2>
                    </div>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                        <li>Encrypts PDFs with a password using <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">PyPDF2</code></li>
                        <li>Decrypts PDFs with the correct password</li>
                    </ul>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mt-4">Example</h3>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                        <li>Input: <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">contract.pdf</code></li>
                        <li>Output: <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">contract_enc.pdf</code></li>
                        <li>Then decrypt → <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">contract_dec.pdf</code></li>
                    </ul>
                </section>

                <!-- Folder Encryption -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Folder Encryption (EncFS)</h2>
                    </div>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                        <li>Encrypts folders without changing contents</li>
                        <li>Does NOT zip, rename, or modify files</li>
                        <li>Uses <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">encfs</code> for true on-demand file encryption</li>
                    </ul>
                    
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Encrypt</h3>
                            <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                                <li>Input: <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">project/</code></li>
                                <li>Output: <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">project_encrypted/</code></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Decrypt</h3>
                            <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                                <li>Input: <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">project_encrypted/</code></li>
                                <li>Output: <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">project_decrypted/</code> (automatically extracted)</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Requirements -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Requirements</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Python Modules</h3>
                            <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg font-mono text-sm overflow-x-auto"><code>pip install PyPDF2 colorama</code></pre>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">System Tools</h3>
                            <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg font-mono text-sm overflow-x-auto"><code>sudo apt update
sudo apt install encfs</code></pre>
                        </div>
                    </div>
                </section>

                <!-- Installation -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Installation</h2>
                    </div>
                    
                    <div class="space-y-6 text-gray-600 dark:text-gray-300">
                        <div class="space-y-3">
                            <p class="font-medium">1. Simply install using the python pip package but first make sure you use Virtual Environment and source the activate:</p>
                            <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg font-mono text-sm overflow-x-auto"><code>python -v venv venv

# Bash / Zsh
source venv/bin/activate

# Fish shell
source venv/bin/activate.fish

# C shell (csh / tcsh)
source venv/bin/activate.csh</code></pre>
                            
                            <h4 class="font-semibold mt-2">Install Ceasar-toolkit</h4>
                            <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg font-mono text-sm overflow-x-auto"><code>pip install ceasar-toolkit</code></pre>
                            <p>Then simply call <code class="bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded font-mono text-sm">ceasar</code> in your commands.</p>
                        </div>

                        <div class="space-y-3">
                            <p class="font-medium">2. Clone the project and run:</p>
                            <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg font-mono text-sm overflow-x-auto"><code>git clone https://github.com/parsabe/Ceasar-cipher-toolkit.git
cd Ceasar-cipher-toolkit
python main.py</code></pre>
                        </div>
                    </div>
                </section>

                <!-- License -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">License</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">
                        Released under the <a href="LICENSE" class="text-blue-600 dark:text-blue-400 hover:underline">MIT License</a>.
                    </p>
                </section>

            </div>
        </main>
    </div>
</body>
</html>