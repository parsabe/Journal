<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Parsa Besharat</title>

    <meta name="description"
        content="Get in touch with Parsa Besharat for AI research collaborations, data science projects, or professional inquiries. Connect via Email, LinkedIn, or GitHub.">
    <meta name="author" content="Parsa Besharat">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Contact Parsa Besharat | AI Engineer & Researcher">
    <meta property="og:description"
        content="Reach out for collaborations in AI and Research. Available via email and professional social networks.">
    <meta property="og:image" content="{{ asset('images/profile.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Contact Parsa Besharat">
    <meta name="twitter:description" content="AI Engineer & Researcher. Get in touch for professional inquiries.">
    <meta name="twitter:image" content="{{ asset('images/profile.jpg') }}">

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
        class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[85vh] z-10 transition-colors duration-700 animate-page-zoom-in">

        @include('top-header-controls')

        @include('sidebar')

        <main class="flex-1 p-6 pt-12 lg:p-10 lg:pt-14 overflow-y-auto scrollbar-hide">
            <div class="max-w-2xl mx-auto w-full animate-page-slide-up">

                <span
                    class="inline-flex items-center gap-2 px-4 py-1.5 ios-glass text-white rounded-full text-sm font-bold mb-6">
                    {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? '✉️ KONTAKT' : '✉️ CONTACT' }}
                </span>

                <h1
                    class="text-4xl lg:text-5xl font-extrabold mb-8 tracking-tight text-white drop-shadow-sm">
                    {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Nehmen Sie' : 'Get in' }}
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-pink-500">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Kontakt auf.' : 'Touch.' }}</span>
                </h1>
                <hr class="border-white/15 mb-8">


                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <a href="https://github.com/parsabe" target="_blank" rel="noopener noreferrer"
                        class="glass-card flex flex-col items-center justify-center p-4 rounded-2xl border border-white/15 hover:border-white/30 transition-all group">
                        <svg class="w-7 h-7 mb-2 text-white group-hover:scale-110 transition-transform"
                            fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.168 6.839 9.492.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.03-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.338 4.695-4.566 4.942.359.308.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.001 10.001 0 0022 12c0-5.523-4.477-10-10-10z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-xs font-bold text-white">GitHub</span>
                    </a>

                    <a href="https://www.linkedin.com/in/parsabe" target="_blank" rel="noopener noreferrer"
                        class="glass-card flex flex-col items-center justify-center p-4 rounded-2xl border border-white/15 hover:border-white/30 transition-all group">
                        <svg class="w-7 h-7 mb-2 text-[#38bdf8] group-hover:scale-110 transition-transform"
                            fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg>
                        <span class="text-xs font-bold text-white">LinkedIn</span>
                    </a>

                    <a href="https://www.researchgate.net/profile/Parsa-Besharat" target="_blank"
                        rel="noopener noreferrer"
                        class="glass-card flex flex-col items-center justify-center p-4 rounded-2xl border border-white/15 hover:border-white/30 transition-all group">
                        <svg class="w-7 h-7 mb-2 text-[#2dd4bf] group-hover:scale-110 transition-transform"
                            fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M19.586 0c-.818 0-1.508.19-2.073.565-.564.377-.932.872-1.105 1.487l-.138.436h-3.649l-.139-.436c-.172-.615-.54-1.11-1.104-1.487-.565-.375-1.256-.565-2.074-.565-1.66 0-2.851.833-3.573 2.5l-.053.286h-2.478l-.053-.286c-.722-1.667-1.913-2.5-3.573-2.5-1.912 0-3.211 1.188-3.896 3.563l-.175.604h2.59l.066-.234c.239-.828.63-1.242 1.172-1.242.454 0 .796.359 1.026 1.078l.066.219h3.732l.066-.219c.23-.719.581-1.078 1.052-1.078.46 0 .802.359 1.026 1.078l.066.219h3.732l.066-.219c.23-.719.581-1.078 1.052-1.078.46 0 .802.359 1.026 1.078l.066.219h2.59l-.175-.604c-.685-2.375-1.984-3.563-3.896-3.563zm-14.836 7.5h14.5v1.5h-14.5v-1.5zm.75 3h13v1.5h-13v-1.5zm-.75 3h14.5v1.5h-14.5v-1.5zm.75 3h13v1.5h-13v-1.5zm-.75 3h14.5v1.5h-14.5v-1.5z" />
                        </svg>
                        <span class="text-xs font-bold text-white">ResearchGate</span>
                    </a>

                    <a href="mailto:parsa.besharat@student.tu-freiberg.de"
                        class="glass-card flex flex-col items-center justify-center p-4 rounded-2xl border border-white/15 hover:border-white/30 transition-all group">
                        <svg class="w-7 h-7 mb-2 text-[#f87171] group-hover:scale-110 transition-transform"
                            fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <span class="text-xs font-bold text-white">Email</span>
                    </a>
                </div>

                @if(session('success'))
                    <div
                        class="mb-6 p-4 rounded-xl bg-green-900/60 border border-green-500/40 text-green-200 backdrop-blur-md">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact') }}" class="space-y-5">
                    @csrf
                    <div class="group">
                        <label for="name"
                            class="block text-sm font-bold text-white mb-2 ml-1">Name</label>
                        <input type="text" id="name" name="name" required placeholder="Your full name"
                            class="w-full px-5 py-3.5 rounded-2xl bg-slate-900/60 border border-white/15 focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 outline-none transition-all text-white placeholder-slate-400 backdrop-blur-md hover:bg-slate-900/80">
                    </div>

                    <div class="group">
                        <label for="email" class="block text-sm font-bold text-white mb-2 ml-1">Email
                            address</label>
                        <input type="email" id="email" name="email" required placeholder="your.email@example.com"
                            class="w-full px-5 py-3.5 rounded-2xl bg-slate-900/60 border border-white/15 focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 outline-none transition-all text-white placeholder-slate-400 backdrop-blur-md hover:bg-slate-900/80">
                    </div>

                    <div class="group">
                        <label for="message"
                            class="block text-sm font-bold text-white mb-2 ml-1">Message</label>
                        <textarea id="message" name="message" rows="5" required placeholder="How can I help you?..."
                            class="w-full px-5 py-3.5 rounded-2xl bg-slate-900/60 border border-white/15 focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 outline-none transition-all text-white placeholder-slate-400 backdrop-blur-md hover:bg-slate-900/80 resize-none"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-4 px-6 bg-gradient-to-r from-orange-500 to-pink-600 hover:from-orange-400 hover:to-pink-500 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 border border-white/20 mt-2">
                        Send Message
                    </button>
                </form>










            </div>
        </main>

    </div>

</body>

</html>