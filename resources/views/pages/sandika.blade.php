<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandika Operational Hub - Parsa Besharat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/sandika.css') }}">
</head>

<body class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-3 lg:p-8 min-h-screen relative overflow-x-hidden">

    <!-- MAIN FLOATING WINDOW CONTAINER (MATCHES HOMEPAGE & CHAT EXACTLY) -->
    <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[88vh] z-10 transition-all duration-700 shadow-2xl border border-white/10 animate-page-zoom-in">

        @include('top-header-controls')

        <!-- SIDEBAR INTEGRATED INSIDE CONTAINER -->
        @include('sidebar')

        <!-- MAIN SANDIKA PORTAL CONTENT -->
        <main class="flex-1 flex flex-col overflow-y-auto relative p-6 pt-12 lg:p-8 lg:pt-14 bg-black/30 gap-6 animate-page-slide-up">
            
            <!-- INSTAGRAM STORIES BAR -->
            @include('stories_bar')

            @if(!$authenticated)
                <!-- AUTHENTICATION GATE WITH 2FA ENFORCEMENT -->
                <div class="flex-1 flex flex-col items-center justify-center p-6 text-center animate-scale-up">
                    <div class="w-20 h-20 mb-4 rounded-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center text-3xl shadow-2xl animate-bounce">
                        🔐
                    </div>
                    <h2 class="text-2xl font-extrabold text-white mb-1 tracking-tight">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Sandika Agenten-Portal' : 'Sandika Agent Portal' }}</h2>
                    <p class="text-xs text-gray-400 max-w-sm mb-6 font-medium">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Gastzugriff ist deaktiviert. Bitte melden Sie sich an oder erstellen Sie ein Konto mit 2FA-Schutz, um auf Ränge und Werkzeuge zuzugreifen.' : 'Guest access is disabled. Please log in or create an account with 2FA protection to access Sandika ranks and tools.' }}</p>

                    <div class="w-full max-w-md bg-black/40 p-6 rounded-3xl border border-white/15 shadow-2xl backdrop-blur-xl">
                        <div class="flex rounded-2xl bg-white/5 p-1 mb-3 text-xs font-semibold">
                            <button id="gateLoginTab" onclick="switchGateTab('login')" class="flex-1 py-2.5 rounded-xl bg-indigo-600 text-white shadow-md">Log In</button>
                            <button id="gateRegisterTab" onclick="switchGateTab('register')" class="flex-1 py-2.5 rounded-xl text-gray-400">Sign Up</button>
                        </div>

                        <!-- SOCIAL OAUTH BUTTONS -->
                        <div class="grid grid-cols-3 gap-1.5 mb-3">
                            <a href="{{ route('social.redirect', 'google') }}" class="py-2 bg-white/10 hover:bg-white/20 border border-white/15 rounded-xl flex items-center justify-center gap-1 text-[11px] font-bold text-white transition">
                                <span>🌐</span> Google
                            </a>
                            <a href="{{ route('social.redirect', 'facebook') }}" class="py-2 bg-blue-600/30 hover:bg-blue-600/50 border border-blue-500/30 rounded-xl flex items-center justify-center gap-1 text-[11px] font-bold text-blue-200 transition">
                                <span>📘</span> Facebook
                            </a>
                            <a href="{{ route('social.redirect', 'apple') }}" class="py-2 bg-black/60 hover:bg-black/80 border border-white/25 rounded-xl flex items-center justify-center gap-1 text-[11px] font-bold text-white transition">
                                <span>🍎</span> Apple
                            </a>
                        </div>

                        <form id="gateLoginForm" method="POST" action="{{ route('login') }}" class="space-y-3.5 text-left text-xs">
                            @csrf
                            <input type="hidden" name="redirect" value="{{ url()->current() }}">
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Email Address</label>
                                <input type="email" name="email" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Password</label>
                                <input type="password" name="password" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                            </div>
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl shadow-lg">
                                Log In to Sandika
                            </button>
                        </form>

                        <form id="gateRegisterForm" method="POST" action="{{ route('register') }}" class="hidden space-y-3.5 text-left text-xs">
                            @csrf
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Full Name</label>
                                <input type="text" name="name" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Email Address</label>
                                <input type="email" name="email" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Password</label>
                                <input type="password" name="password" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Confirm Password</label>
                                <input type="password" name="password_confirmation" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                            </div>
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl shadow-lg">
                                Register with 2FA Protection
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- AUTHENTICATED SANDIKA PORTAL -->
                <div class="flex items-center justify-between border-b border-white/10 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600/30 border border-indigo-500/40 flex items-center justify-center text-2xl shadow-lg">
                            🛡️
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold tracking-tight text-white flex items-center gap-2">
                                𝐒 𝐀 𝐍 𝐃 𝐈 𝐊 𝐀
                                <span class="text-[10px] uppercase font-mono px-2.5 py-0.5 rounded-full bg-indigo-500/20 text-indigo-400 border border-indigo-500/30">OPERATIONAL HUB</span>
                            </h1>
                            <p class="text-xs text-gray-400">Contribution Points (CP), Agent Ranks, Cipher Vault & Lexicon Network</p>
                        </div>
                    </div>
                </div>

                <!-- USER RANK & CP BADGE -->
                @php
                    $isBossman = Auth::check() && Auth::user()->email === 'parsabe99@gmail.com';
                    $userLevel = $isBossman ? 99 : (is_object($rank) ? $rank->level : 3);
                    $userTitle = $isBossman ? 'Bossman 👑' : (is_object($rank) ? $rank->rank_title : 'Captain ⚔️ (Verified)');
                    $userCp = is_object($rank) ? $rank->xp : 50;

                    $rankTitleLower = strtolower($userTitle);
                    if ($isBossman || str_contains($rankTitleLower, 'bossman')) {
                        $sandikaRankImg = 'images/ranks/bossman.jpg';
                    } elseif (str_contains($rankTitleLower, 'admiral')) {
                        $sandikaRankImg = 'images/ranks/admiral.jpg';
                    } elseif (str_contains($rankTitleLower, 'lieutenant')) {
                        $sandikaRankImg = 'images/ranks/lieutenant.png';
                    } elseif (str_contains($rankTitleLower, 'sergeant') || str_contains($rankTitleLower, 'sergent')) {
                        $sandikaRankImg = 'images/ranks/sergent.jpg';
                    } elseif (str_contains($rankTitleLower, 'captain')) {
                        $sandikaRankImg = 'images/ranks/captain.jpg';
                    } elseif (str_contains($rankTitleLower, 'soldier')) {
                        $sandikaRankImg = 'images/ranks/soldier.jpg';
                    } else {
                        $sandikaRankImg = 'images/ranks/rookie.jpg';
                    }
                @endphp
                <div class="sandika-rank-badge p-6 rounded-3xl backdrop-blur-xl flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 p-0.5 shadow-xl relative">
                            <img src="{{ asset($sandikaRankImg) }}" class="w-full h-full rounded-full object-cover border-2 border-gray-900">
                        </div>
                        <div>
                            <h2 id="user-title-val" class="text-lg font-bold text-white tracking-wide flex items-center gap-2">
                                <span>{{ $userTitle }}</span>
                                @if($isBossman || $userCp >= 50)
                                    <img src="{{ asset('images/ranks/verification.png') }}" class="w-5 h-5 object-contain inline-block drop-shadow" title="Verified Sandika Agent">
                                @endif
                            </h2>
                            <p class="text-xs text-indigo-300">Contribution Points (CP): <span id="user-xp-val" class="font-bold text-white">{{ $isBossman ? '∞ CP' : $userCp . ' CP' }}</span> • Level {{ $userLevel }}</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <span class="px-3.5 py-1.5 bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 rounded-full text-xs font-semibold flex items-center gap-2">
                            <img src="{{ asset('images/ranks/verification.png') }}" class="w-4 h-4 object-contain">
                            <span>{{ $userCp >= 50 ? 'Verified Agent' : 'Verification Threshold (50 CP)' }}</span>
                        </span>
                    </div>
                </div>

                <!-- CONCEPT TAB MENU BAR -->
                <div class="flex flex-wrap gap-2 p-1.5 bg-black/40 border border-white/10 rounded-2xl">
                    <button class="sandika-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-indigo-600/40 border border-indigo-400 text-white" data-target="tab-rules">
                        📜 Rules & Ranks
                    </button>
                    <button class="sandika-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-black/30 border border-white/10 text-gray-400" data-target="tab-stories">
                        📖 Stories Hub
                    </button>
                    <button class="sandika-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-black/30 border border-white/10 text-gray-400" data-target="tab-dictionary">
                        📚 Lexicon Dictionary
                    </button>
                    <button class="sandika-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-black/30 border border-white/10 text-gray-400" data-target="tab-git">
                        💻 Git Insights
                    </button>
                    <button class="sandika-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-black/30 border border-white/10 text-gray-400" data-target="tab-arkham">
                        👻 Amadeus Arkham Spirits (+20 CP)
                    </button>
                    <button class="sandika-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-black/30 border border-white/10 text-gray-400" data-target="tab-tools">
                        ⚙️ Tactical Tools & ROT13
                    </button>
                </div>

                <!-- TAB 1: RULES & RANKS -->
                <div id="tab-rules" class="sandika-tab-content space-y-4">
                    <div class="arkham-terminal p-6 rounded-3xl space-y-4">
                        <h2 class="text-sm font-bold text-indigo-400 font-mono">🔰 SANDIKA OPERATIONAL RULES & CP SYSTEM</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs text-gray-300 font-mono">
                            <div class="p-4 bg-black/50 border border-white/10 rounded-2xl space-y-2">
                                <h3 class="font-bold text-white text-sm">How to Earn CP (Contribution Points):</h3>
                                <ul class="space-y-1.5 text-gray-400">
                                    <li>• <strong class="text-indigo-300">Nigma Riddles:</strong> +15 CP per riddle solved</li>
                                    <li>• <strong class="text-indigo-300">Dictionary Words (EN/DE):</strong> +10 CP per entry</li>
                                    <li>• <strong class="text-indigo-300">Stories (>1000 chars):</strong> +10-15 CP</li>
                                    <li>• <strong class="text-indigo-300">Git Insights:</strong> +15 CP (GitHub verified) / +5 CP</li>
                                    <li>• <strong class="text-indigo-300">Voice Audio Logs:</strong> +45 CP</li>
                                </ul>
                            </div>

                            <div class="p-4 bg-black/50 border border-white/10 rounded-2xl space-y-2">
                                <h3 class="font-bold text-white text-sm">Agent Rank Hierarchy:</h3>
                                <ul class="space-y-1 text-gray-400">
                                    <li>• Rookie: 0 - 19 CP</li>
                                    <li>• Soldier: 20 - 49 CP</li>
                                    <li>• <strong class="text-emerald-400">Captain (Verified Threshold): 50 - 99 CP</strong></li>
                                    <li>• Sergeant: 100 - 149 CP</li>
                                    <li>• Lieutenant: 150 - 399 CP</li>
                                    <li>• Admiral: 400 - 1999 CP</li>
                                    <li>• Bossman: 2000+ CP</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: STORIES HUB -->
                <div id="tab-stories" class="sandika-tab-content hidden space-y-4">
                    <div class="arkham-terminal p-6 rounded-3xl space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-bold text-purple-400 font-mono">📖 STORIES & INTELLIGENCE REPORTS</h2>
                            <a href="/chat" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl text-xs font-bold shadow-lg hover:opacity-90">
                                💬 POST ON PROFILE FEED (+15 CP)
                            </a>
                        </div>

                        <div class="space-y-3">
                            @forelse($stories as $s)
                                <div class="p-4 bg-black/40 border border-white/10 rounded-2xl text-xs space-y-1">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-bold text-white text-sm">{{ $s->title }}</h3>
                                        <span class="text-[10px] font-mono text-purple-400">+{{ $s->cp_awarded }} CP</span>
                                    </div>
                                    <p class="text-gray-300 leading-relaxed">{{ $s->content }}</p>
                                </div>
                            @empty
                                <div class="text-center p-6 text-xs text-gray-500 font-mono">No stories posted yet.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- TAB 3: DICTIONARY -->
                <div id="tab-dictionary" class="sandika-tab-content hidden space-y-4">
                    <div class="arkham-terminal p-6 rounded-3xl space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-bold text-indigo-400 font-mono">📚 LEXICON DICTIONARY (ENGLISH & GERMAN)</h2>
                            <button onclick="document.getElementById('modal-dict').classList.remove('hidden')" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold shadow-lg hover:bg-indigo-500">
                                + ADD WORD (+10 CP)
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @forelse($dictionary as $d)
                                <div class="p-3 bg-black/40 border border-white/10 rounded-xl text-xs">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-bold text-indigo-300">{{ $d->word }}</span>
                                        <span class="text-[10px] uppercase font-mono px-2 py-0.5 rounded bg-indigo-500/20 text-indigo-400">{{ $d->language }}</span>
                                    </div>
                                    <p class="text-gray-400 text-[11px]">{{ $d->definition }}</p>
                                </div>
                            @empty
                                <div class="col-span-2 text-center p-6 text-xs text-gray-500 font-mono">Lexicon empty. Submit vocabulary to earn CP!</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- TAB 4: GIT INSIGHTS -->
                <div id="tab-git" class="sandika-tab-content hidden space-y-4">
                    <div class="arkham-terminal p-6 rounded-3xl space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-bold text-emerald-400 font-mono">💻 REPOSITORY GIT INSIGHTS</h2>
                            <button onclick="document.getElementById('modal-git').classList.remove('hidden')" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-bold shadow-lg hover:bg-emerald-500">
                                + POST GIT INSIGHT (+15 CP)
                            </button>
                        </div>

                        <div class="space-y-3">
                            @forelse($gitInsights as $g)
                                <div class="p-4 bg-black/40 border border-white/10 rounded-2xl text-xs space-y-1">
                                    <div class="flex items-center justify-between">
                                        <a href="{{ $g->repo_url }}" target="_blank" class="font-bold text-emerald-400 hover:underline">{{ $g->repo_url }}</a>
                                        <span class="text-[10px] font-mono text-emerald-400">+{{ $g->cp_awarded }} CP</span>
                                    </div>
                                    <p class="text-gray-300">{{ $g->description }}</p>
                                </div>
                            @empty
                                <div class="text-center p-6 text-xs text-gray-500 font-mono">No git insights logged.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- TAB: AMADEUS ARKHAM SPIRITS -->
                @php
                    $arkhamCiphers = [
                        1 => "V nz gur fcvrfvg bs Nznqrhf Nexunz. Gubhtu zl nppvbaf, V unir fnirq guvf pherq pvgl, gubhtu zl bja pherf vf gb sbeprqire erznva va gur fubyrqbj. Zl fgbel vf pneire vagb gur irel fbhy bs Nexunz naq jvyy bayl or erivrjrq gb gubfr qrpgvbanyr ragreivrjf gb qvfvire vg.",
                        2 => "Zl snvgu'f oehzf ena guebhtu gur uneq bs Tbgunz. Jr jrer qbpgbef, cvbqhyvfzbf naq gurapuvrf; jr unir orra gur betnavm pbeevqvat gur nepvsvp sveyvp sevygl sebz gur pvgl. Jr unir orra vg'f freiryrg tvivat nyy gb cerfrag vg. Naq fgvyyn vg unf pubfra gb ureg hf.",
                        3 => "Nf Tbgunz'f irvarf fbyyl sbvyq jvgu cnva naq fhecevfravat, gur rsrpgf jrer srggryrq rireljbeyqre. Zl snzr sryy svefg, vasvcerq ol fbzr sbyq qrnavrf; zl zbavbe yvirq ba, ohg bayl va n qrerng. V erprvirq gb gur snvgu ubzr gb pner sbe ure jurer fur erzvaqrq va ure orq sbe nf ybat nf ure obql pbafhccrq gb oervir. Ure grnref xrrq zr njnxf ng avtug.",
                        4 => "Zl wbhearl ynfgrq yvggyr bire n zbagu. Ivfvgvat nqnzrpvrf va obgu Zrgcbegf naq Xrfgbar, V jnf rkcrevraprq gb n jryyvfu bs arj vqrnf. V orqraq zl qnl erfhzvat ubzr va tbbq fcvrf, rtrevat gb frr zl jvgu naq snzvyl. V raqre vg xrayvat va gurve oehzf, oebxravtngrs bs zl yvir cbezvat guebhtu qevivat erq svatref.",
                        5 => "V erprvirq gb zl jbex, ohg V pbhyq abg funxr gur cvpgherf sebz zl zvaq. V fubhyq unir orerpungrq, ohg V jnf zber rrtre guna rire gb sva n rkcybfvba sbe jul fbzrbar jbhyq qh guvf. Gurfr oebtnq gur nantznyl orpuneq orfgre zr, funzryyrfr naq onexvat yvxr n zqn qbtl. Sbe jung sryygu unq orra irel frirer gb cvpx zl uryc.",
                        6 => "Gurl oebhtug gur nznavny orfgre zr, funznyrf naq onevxvat yvxr n znq qbt. Sbe jung srggyrq qnlzf V rvaqrevn uvf obfgf. Ur gnxr cynlgrer ebhaqvat uvfvaf, pnyyrqvat uvf qercnffirq penvqrz puvrf. Jung fubhyq unir oreraqhf erirnyrq gb cvtyglv. Guvf cbbe qbt arrqrq zl uryc.",
                        7 => "Gur vafvqr punatrq yvggyr bire gur lrnef. Vgf erchgvatvba jnf va gnggrenf, ohg V ibjq gb svx vg. Nf gur oevqtrf jrer oervqvg vg fjrneq V fgnq gur shgher, n oevgr jbireohf shgher.",
                        8 => "Arj oevpx, zrgny naq cnva pbeerpgrq byq jhaqhf. Serspu oynq jbexrq vagb gur obgl. Oevfpu arj zvafs pnevarq vagb gur obgl. Oevthu arj zvafs ernqrq naq nyy febrer gb hcyvk beqrf. Jr nyy xarj jr jrer gur barf gb svx guvf pvgl. Naq gur pvgl jvyy gunax hf.",
                        9 => "Zl snvgu'f xvyyre fghqrq va sebag bs zr. Lrnef bs gurfcnel unir qrernq uvz fnar. V jnf cebqhp gb frr uvz jnyx sern. Va rkgerzcerff sbe uvf yvoenfvg gur fgngvba erprcerfrag bayl n fvtavsvantr. Ur gnxed hp ntbavfgvat gb jnyx va n cnex, ubj ur ybatrq gb srry serfu neba ba uvf sner, naq gura ur gnxed zl sngure'f sbhagre cgra naq xvyynq zl frpergvp. Nf ur jnf fohqhrq, guraf oratgn be uvz gb fgnva ba gur sbez.",
                        10 => "V ryxrq pbhagyrff gevnyf wrnevat zr sebz va. Sbybyjvat zrzbevrf sbeybeva oebxra qernzf. Tragyr snvgu va n obql ebggrq. Juvyr ng avtug enc fcebhgf sbeybeva. Tragyrybgg va guvf pnir gung unf znqr zr fybjyv n pber gung pnar unir bayl erirnyra gb jub rkcyber vg. Sbe va cybfr sbe treer pynve jvq gur qnex angher bs zl jbex ur erprvirq gb abg punatr.",
                    ];
                @endphp
                <div id="tab-arkham" class="sandika-tab-content hidden space-y-4">
                    <div class="arkham-terminal p-6 rounded-3xl space-y-4">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-white/10 pb-4">
                            <div>
                                <h2 class="text-sm font-bold text-amber-400 font-mono uppercase tracking-wider flex items-center gap-2">
                                    👻 AMADEUS ARKHAM SPIRITS & WRAITH CIPHERS
                                </h2>
                                <p class="text-xs text-gray-400 mt-1">Decipher the 10 sacred Arkham Spirit ciphers using the ROT13 Tactical Tool. Deciphering unlocks full audio playback (+20 CP each).</p>
                            </div>
                            <span class="px-3 py-1 bg-amber-500/20 text-amber-300 border border-amber-500/40 rounded-full text-xs font-mono font-bold">
                                🎧 10 AUDIO TAPES
                            </span>
                        </div>

                        <!-- 10 SPIRIT CARDS - FULL-WIDTH ROW LAYOUT -->
                        <div class="flex flex-col space-y-6 w-full">
                            @for ($i = 1; $i <= 10; $i++)
                                @php
                                    $isSolved = in_array($i, $solvedArkhamIds ?? []);
                                    $cipherText = $arkhamCiphers[$i] ?? '';
                                @endphp
                                <div class="p-6 rounded-3xl bg-black/60 border border-white/15 space-y-4 relative overflow-hidden transition hover:border-amber-500/50 shadow-2xl group w-full">
                                    <!-- CARD HEADER -->
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b border-white/10 pb-4 gap-3">
                                        <div class="flex items-center gap-3.5">
                                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-500 to-rose-600 flex items-center justify-center text-white font-mono font-extrabold text-base shadow-lg shrink-0">
                                                #{{ $i }}
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-bold text-white font-mono flex items-center gap-2">
                                                    <span>Arkham Spirit Cipher #{{ $i }}</span>
                                                </h3>
                                                <span class="text-xs text-amber-400 font-mono">Reward: +20 CP + Audio Track Transmission</span>
                                            </div>
                                        </div>
                                        <div id="arkham-status-badge-{{ $i }}" class="shrink-0 whitespace-nowrap">
                                            @if($isSolved)
                                                <span class="px-3.5 py-1.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 text-xs font-mono font-bold flex items-center gap-1.5 shadow-md">
                                                    ✅ Deciphered & Unlocked
                                                </span>
                                            @else
                                                <span class="px-3.5 py-1.5 rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/40 text-xs font-mono font-bold flex items-center gap-1.5 shadow-md">
                                                    🔒 Sealed Audio Log
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- CIPHER TEXT BOX -->
                                    <div class="p-4 sm:p-5 bg-black/70 border border-amber-500/30 rounded-2xl space-y-2 shadow-inner">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-amber-400 font-mono font-bold uppercase tracking-wider flex items-center gap-1.5">
                                                <span>📜</span> ROT13 Encrypted Transmission Cipher:
                                            </span>
                                            <button onclick="navigator.clipboard.writeText('{{ addslashes($cipherText) }}'); alert('Ciphertext copied to clipboard! Open Tactical Tools -> ROT13 to decipher.');" class="px-3 py-1 rounded-xl bg-indigo-600/30 hover:bg-indigo-600/60 border border-indigo-400/40 text-xs text-indigo-300 hover:text-white font-mono flex items-center gap-1.5 transition">
                                                <span>📋</span> Copy Text
                                            </button>
                                        </div>
                                        <p class="text-xs sm:text-sm font-mono text-amber-200/90 leading-relaxed select-all pt-1">
                                            {{ $cipherText }}
                                        </p>
                                    </div>

                                    <!-- DECIPHER FORM (Shown when NOT solved) -->
                                    <form class="form-arkham-spirit space-y-2.5 {{ $isSolved ? 'hidden' : '' }}" data-spirit-id="{{ $i }}" id="arkham-form-{{ $i }}">
                                        <div class="flex items-center justify-between text-xs text-gray-400 font-mono">
                                            <span>💡 Hint: Decipher above message using the <strong onclick="switchSandikaTab('tab-tools')" class="text-indigo-400 underline cursor-pointer hover:text-indigo-300">ROT13 Tool</strong></span>
                                        </div>
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <input type="text" name="answer" required placeholder="Enter plaintext deciphered message..."
                                                class="flex-1 bg-black/70 border border-white/20 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white placeholder-gray-500 focus:outline-none focus:border-amber-400 font-mono shadow-inner">
                                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-amber-500 via-orange-500 to-rose-600 hover:from-amber-400 hover:to-rose-500 text-white font-bold rounded-2xl text-xs sm:text-sm shadow-xl transition transform hover:scale-102 active:scale-98 shrink-0 flex items-center justify-center gap-2">
                                                <span>🔓</span> Decipher & Unlock (+20 CP)
                                            </button>
                                        </div>
                                    </form>

                                    <!-- RESULT & FEEDBACK CONTAINER -->
                                    <div class="arkham-result-{{ $i }} text-xs font-mono font-semibold min-h-[20px]">
                                        @if($isSolved)
                                            <span class="text-emerald-400 flex items-center gap-1">✅ Deciphered (+20 CP Awarded)</span>
                                        @endif
                                    </div>

                                    <!-- AUDIO PLAYER CONTROLS (UNLOCKED AFTER SOLVED) -->
                                    <div id="arkham-audio-card-{{ $i }}" class="{{ $isSolved ? '' : 'hidden' }} p-4 sm:p-5 bg-gradient-to-r from-indigo-950/90 via-purple-950/90 to-black/90 border border-indigo-500/40 rounded-2xl space-y-3 shadow-2xl">
                                        <div class="flex items-center justify-between text-xs sm:text-sm font-mono">
                                            <span class="text-indigo-300 font-bold flex items-center gap-2">
                                                <span class="text-base">🎙️</span>
                                                <span>Amadeus Arkham Audio Log #{{ $i }}</span>
                                            </span>
                                            <span class="text-xs text-emerald-400 font-bold px-2.5 py-0.5 rounded-full bg-emerald-500/20 border border-emerald-500/30">UNLOCKED & READY</span>
                                        </div>

                                        <!-- PLAYER BUTTONS & SEEK SLIDER -->
                                        <div class="flex items-center gap-4 pt-1">
                                            <!-- PLAY / PAUSE BUTTON -->
                                            <button onclick="toggleArkhamAudio({{ $i }})" id="arkham-play-btn-{{ $i }}" class="w-12 h-12 rounded-full bg-gradient-to-tr from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white flex items-center justify-center font-extrabold text-base shadow-xl transition transform hover:scale-105 shrink-0">
                                                ▶
                                            </button>

                                            <!-- SEEK BAR & TIME -->
                                            <div class="flex-1 space-y-1.5">
                                                <input type="range" id="arkham-seek-{{ $i }}" value="0" min="0" max="100" step="0.1" oninput="seekArkhamAudio({{ $i }}, this.value)" class="w-full h-2 bg-black/80 rounded-lg appearance-none cursor-pointer accent-indigo-400">
                                                <div class="flex justify-between text-xs text-gray-400 font-mono font-semibold">
                                                    <span id="arkham-time-curr-{{ $i }}">0:00</span>
                                                    <span id="arkham-time-dur-{{ $i }}">0:00</span>
                                                </div>
                                            </div>

                                            <!-- REPLAY BUTTON -->
                                            <button onclick="replayArkhamAudio({{ $i }})" title="Replay Audio" class="px-3.5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/10 text-gray-200 text-xs font-bold transition shrink-0 flex items-center gap-1.5 shadow">
                                                <span>🔄 Replay</span>
                                            </button>

                                            <audio id="arkham-audio-player-{{ $i }}" src="{{ asset("audio/sandika/{$i}.mp3") }}" preload="metadata" ontimeupdate="updateArkhamAudioProgress({{ $i }})" onended="onArkhamAudioEnded({{ $i }})"></audio>
                                        </div>
                                    </div>

                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- TAB 5: TACTICAL TOOLS & ROT13 -->
                <div id="tab-tools" class="sandika-tab-content hidden space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="arkham-terminal p-6 rounded-3xl space-y-3">
                            <h3 class="text-xs font-bold text-indigo-400 font-mono">🔒 ROT13 ENCODER / DECODER</h3>
                            <textarea id="rot13-input" rows="3" placeholder="Enter text to encrypt/decrypt..." class="w-full bg-black/50 border border-white/10 rounded-xl p-3 text-xs text-white placeholder-gray-600 focus:outline-none"></textarea>
                            <button id="btn-rot13-convert" class="w-full py-2.5 bg-indigo-600 text-white rounded-xl text-xs font-bold">CONVERT TEXT</button>
                            <textarea id="rot13-output" rows="3" readonly placeholder="Output ciphertext..." class="w-full bg-black/60 border border-white/10 rounded-xl p-3 text-xs text-emerald-400 focus:outline-none font-mono"></textarea>
                        </div>

                        <div class="arkham-terminal p-6 rounded-3xl space-y-3">
                            <h3 class="text-xs font-bold text-purple-400 font-mono">🎙️ VOICE LOG & FILE VAULT</h3>
                            <div id="voice-status" class="text-xs text-gray-400 min-h-[20px]"></div>
                            <button id="btn-analyze-voice" class="w-full py-2.5 bg-purple-600 text-white rounded-xl text-xs font-bold">ANALYZE VOICE LOG (+45 CP)</button>
                        </div>
                    </div>
                </div>
            @endif

        </main>

    </div>

    <!-- ADD DICTIONARY MODAL -->
    <div id="modal-dict" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
        <div class="w-full max-w-lg bg-gray-900 border border-white/20 p-6 rounded-3xl space-y-4">
            <h3 class="text-base font-bold text-white font-mono">Add Word to Lexicon</h3>
            <form id="form-add-dict" class="space-y-3">
                <select name="language" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white">
                    <option value="en">English (EN)</option>
                    <option value="de">German (DE)</option>
                </select>
                <input type="text" name="word" required placeholder="Vocabulary Word..." class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white">
                <textarea name="definition" required rows="3" placeholder="Definition..." class="w-full bg-black/50 border border-white/10 rounded-xl p-4 text-xs text-white"></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modal-dict').classList.add('hidden')" class="px-4 py-2 bg-gray-800 text-gray-300 rounded-xl text-xs">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold">Add Word (+10 CP)</button>
                </div>
            </form>
        </div>
    </div>

    <!-- POST GIT MODAL -->
    <div id="modal-git" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
        <div class="w-full max-w-lg bg-gray-900 border border-white/20 p-6 rounded-3xl space-y-4">
            <h3 class="text-base font-bold text-white font-mono">Post Git Repository Insight</h3>
            <form id="form-post-git" class="space-y-3">
                <input type="url" name="repo_url" required placeholder="https://github.com/username/repo..." class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white">
                <textarea name="description" required rows="3" placeholder="Description of repository insight..." class="w-full bg-black/50 border border-white/10 rounded-xl p-4 text-xs text-white"></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('modal-git').classList.add('hidden')" class="px-4 py-2 bg-gray-800 text-gray-300 rounded-xl text-xs">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-bold">Post Insight (+15 CP)</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchGateTab(tab) {
            const loginForm = document.getElementById('gateLoginForm');
            const regForm = document.getElementById('gateRegisterForm');
            const loginTab = document.getElementById('gateLoginTab');
            const regTab = document.getElementById('gateRegisterTab');

            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                regForm.classList.add('hidden');
                loginTab.classList.add('bg-indigo-600', 'text-white');
                loginTab.classList.remove('text-gray-400');
                regTab.classList.remove('bg-indigo-600', 'text-white');
                regTab.classList.add('text-gray-400');
            } else {
                regForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
                regTab.classList.add('bg-indigo-600', 'text-white');
                regTab.classList.remove('text-gray-400');
                loginTab.classList.remove('bg-indigo-600', 'text-white');
                loginTab.classList.add('text-gray-400');
            }
        }
    </script>

    <!-- Taskbar & Mac Window Controls -->
    @include('taskbar')
    <script src="{{ asset('js/mac-window-controls.js') }}"></script>
    <script type="module" src="{{ asset('js/sandika.js') }}"></script>
</body>
</html>
