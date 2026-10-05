<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlackWall AI Core & Security Intelligence - Parsa Besharat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind & App CSS -->
    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
</head>

<body class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-3 lg:p-8 min-h-screen relative overflow-x-hidden">

    <!-- MAIN FLOATING WINDOW CONTAINER -->
    <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[88vh] z-10 transition-all duration-700 shadow-2xl border border-white/10 animate-page-zoom-in">

        @include('top-header-controls')

        <!-- SIDEBAR INTEGRATED INSIDE THE CONTAINER -->
        @include('sidebar')

        <!-- MAIN BLACKWALL CONTENT AREA -->
        <main class="flex-1 flex flex-col overflow-hidden relative p-4 pt-12 lg:p-6 lg:pt-14 justify-between bg-black/40 backdrop-blur-xl animate-page-slide-up">

            <!-- HEADER BAR -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pb-3 border-b border-white/10 shrink-0">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-red-600 via-rose-700 to-black p-0.5 shadow-xl shrink-0">
                        <div class="w-full h-full bg-black/90 rounded-[14px] flex items-center justify-center text-lg">
                            🛡️
                        </div>
                    </div>
                    <div>
                        <h1 class="text-sm sm:text-base font-bold text-white tracking-wider flex flex-wrap items-center gap-1.5">
                            <span>BLACKWALL AI CORE</span>
                            <span class="px-2 py-0.5 bg-red-500/20 text-red-400 border border-red-500/30 rounded-full text-[9px] sm:text-[10px] font-mono font-bold">PROMETHEUS SEC</span>
                        </h1>
                        <p class="text-[11px] sm:text-xs text-gray-400 font-mono leading-tight">Neural Defense Matrix & AI Query Inspection Engine</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 font-mono text-xs shrink-0 self-end sm:self-auto">
                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center gap-1.5 font-bold text-[10px] sm:text-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Security Active
                    </span>
                </div>
            </div>

            <!-- CHAT / TERMINAL MESSAGES STREAM -->
            <div id="blackwall-stream" class="flex-1 p-4 overflow-y-auto space-y-4 chat-scroll my-3">
                <div class="p-4 rounded-2xl bg-black/60 border border-red-500/30 space-y-2 text-xs font-mono text-gray-300">
                    <div class="flex items-center justify-between text-red-400 font-bold border-b border-white/10 pb-2">
                        <span>🛡️ SYSTEM SECURITY INITIALIZED</span>
                        <span>STATUS: OK</span>
                    </div>
                    <p>BlackWall Security Proxy connected. Command listening on <code class="text-amber-400">@blackwall</code> prefix.</p>
                    <p class="text-gray-400 text-[11px]">All prompt inputs and model outputs are filtered via real-time safety inspection engine.</p>
                </div>
            </div>

            <!-- INPUT COMMAND BAR -->
            <div class="p-3 bg-black/60 border border-white/10 rounded-2xl flex flex-col space-y-2 shrink-0">
                <div class="flex items-center justify-between px-1 text-[11px] text-gray-400 font-mono">
                    <span class="text-red-400 font-semibold">🔒 Neural Safety Barrier Engaged</span>
                    <span>Type <strong class="text-amber-400">@blackwall [query]</strong></span>
                </div>

                <form id="blackwall-form" class="flex items-center space-x-2">
                    <textarea id="blackwall-input" rows="1" placeholder="Enter prompt or @blackwall security query..." required
                        class="flex-1 bg-white/5 border border-white/15 rounded-xl px-4 py-2.5 text-white placeholder-gray-500 text-xs focus:outline-none focus:border-red-500 resize-none font-mono transition"></textarea>
                    
                    <button type="submit" id="blackwall-send-btn"
                        class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-500 hover:to-rose-600 text-white font-bold rounded-xl text-xs shadow-lg flex items-center space-x-1.5 transition transform active:scale-95">
                        <span>Analyze & Query</span>
                        <span>➔</span>
                    </button>
                </form>
            </div>

        </main>
    </div>

    <!-- Taskbar & Mac Window Controls -->
    @include('taskbar')
    <script src="{{ asset('js/mac-window-controls.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('blackwall-form');
            const input = document.getElementById('blackwall-input');
            const stream = document.getElementById('blackwall-stream');
            const sendBtn = document.getElementById('blackwall-send-btn');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // Enter to Submit / Shift+Enter for Newline
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    if (input.value.trim().length > 0) {
                        form.requestSubmit();
                    }
                }
            });

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const text = input.value.trim();
                if (!text) return;

                // Append User Bubble
                appendBubble('User', text, 'user');
                input.value = '';

                // Show Loading
                const loadingId = appendLoadingBubble();
                sendBtn.disabled = true;

                try {
                    const res = await fetch('/projects/blackwall/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken || ''
                        },
                        body: JSON.stringify({ message: text })
                    });

                    const data = await res.json();
                    removeLoadingBubble(loadingId);

                    if (res.ok) {
                        appendBubble('BlackWall AI', data.response, 'ai');
                    } else {
                        appendBubble('BlackWall Defense', `⚠️ ${data.reason || 'Query rejected by safety layer.'}`, 'warning');
                    }
                } catch (e) {
                    removeLoadingBubble(loadingId);
                    appendBubble('System', '⚠️ Error communicating with BlackWall backend server.', 'warning');
                } finally {
                    sendBtn.disabled = false;
                }
            });

            function appendBubble(sender, content, type) {
                const div = document.createElement('div');
                div.className = 'p-4 rounded-2xl text-xs space-y-1.5 animate-scale-up border font-mono ' + 
                    (type === 'user' ? 'bg-indigo-950/40 border-indigo-500/30 text-white ml-8' : 
                     type === 'warning' ? 'bg-red-950/60 border-red-500/50 text-red-300' : 
                     'bg-black/60 border-white/10 text-gray-200 mr-8');

                let parsedHtml = typeof marked !== 'undefined' ? marked.parse(content) : content;
                div.innerHTML = `<div class="font-bold flex items-center justify-between text-[10px] opacity-75">
                    <span>${sender}</span>
                    <span>${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                </div><div>${parsedHtml}</div>`;

                stream.appendChild(div);
                stream.scrollTop = stream.scrollHeight;
            }

            function appendLoadingBubble() {
                const id = 'load-' + Date.now();
                const div = document.createElement('div');
                div.id = id;
                div.className = 'p-3 rounded-2xl bg-black/50 border border-white/10 text-xs font-mono text-amber-400 animate-pulse flex items-center space-x-2 mr-8';
                div.innerHTML = '<span>⏳ BlackWall Security Engine processing neural prompt...</span>';
                stream.appendChild(div);
                stream.scrollTop = stream.scrollHeight;
                return id;
            }

            function removeLoadingBubble(id) {
                const elem = document.getElementById(id);
                if (elem) elem.remove();
            }
        });
    </script>
</body>
</html>