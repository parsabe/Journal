<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}{{ $user->username ? ' (@' . $user->username . ')' : '' }} | {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Benutzerprofil' : 'User Profile' }} - Parsa Besharat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <style>
        html, body {
            height: 100vh;
            overflow: hidden;
        }
        .animate-tab-fade {
            animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Custom Profile Container Scrollbar & Smooth Touch/Wheel Scrolling */
        .custom-profile-scroll {
            overflow-y: scroll !important;
            -webkit-overflow-scrolling: touch !important;
            touch-action: pan-y !important;
            scrollbar-width: thin;
            scrollbar-color: rgba(129, 140, 248, 0.7) rgba(0, 0, 0, 0.4);
        }
        .custom-profile-scroll::-webkit-scrollbar {
            width: 10px !important;
            display: block !important;
        }
        .custom-profile-scroll::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 10px;
        }
        .custom-profile-scroll::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #6366f1, #a855f7);
            border-radius: 10px;
            border: 2px solid rgba(0, 0, 0, 0.3);
        }
        .custom-profile-scroll::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #818cf8, #c084fc);
        }
    </style>
</head>
<body class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-3 lg:p-6 h-screen w-screen overflow-hidden relative">

    <!-- MAIN CONTAINER -->
    <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[90vh] max-h-[920px] z-10 transition-all duration-700 shadow-2xl border border-white/10 animate-page-zoom-in">

        @include('top-header-controls')
        @include('sidebar')

        @php
            $defaultAvatar = $user->email === 'parsabe99@gmail.com' ? 'images/profile.jpg' : 'images/default-avatar.svg';
            $avatarsList = is_array($user->avatars_gallery) && count($user->avatars_gallery) > 0 
                ? $user->avatars_gallery 
                : [];
            if ($user->avatar && !in_array($user->avatar, $avatarsList)) {
                array_unshift($avatarsList, $user->avatar);
            }
            if (count($avatarsList) === 0) {
                $avatarsList = [$user->avatar ?: $defaultAvatar];
            }
            $activeAvatarPath = $user->avatar ?: $defaultAvatar;
            $isProfileOwner = Auth::check() && Auth::id() === $user->id;
        @endphp

        <!-- MAIN PROFILE CONTENT CONTAINER (INNER CONTAINER SCROLLING ONLY) -->
        <main id="profile-scroll-area" class="flex-1 min-h-0 h-full flex flex-col custom-profile-scroll relative p-6 pt-12 lg:p-8 lg:pt-14 bg-black/30 space-y-6 pb-36">
            
            <!-- INSTAGRAM PROFILE CARD -->
            <div class="p-6 rounded-3xl bg-black/50 border border-white/15 shadow-2xl space-y-5">
                <!-- TOP HEADER: AVATAR ON LEFT, NAME & STATS ON RIGHT -->
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                    <!-- AVATAR -->
                    <div class="relative group cursor-pointer shrink-0" onclick="openTelegramAvatarViewer(0)" title="Click to view full profile pictures (Telegram Style)">
                        <img id="mainProfileAvatarImg" src="{{ asset($activeAvatarPath) }}" 
                            class="w-24 h-24 sm:w-28 sm:h-28 rounded-full border-4 border-gray-900 object-cover shadow-2xl transition transform group-hover:scale-105 group-hover:brightness-110">
                        <div class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition backdrop-blur-[2px] pointer-events-none">
                            <span class="text-white text-base">🔍</span>
                            <span class="text-white text-[10px] font-bold drop-shadow">View</span>
                        </div>
                    </div>

                    <!-- NAME & STATS -->
                    @php
                        $rankTitle = strtolower($sandikaRank->rank_title ?? 'captain');
                        if ($user->email === 'parsabe99@gmail.com' || str_contains($rankTitle, 'bossman')) {
                            $rankImg = 'images/ranks/bossman.jpg';
                        } elseif (str_contains($rankTitle, 'admiral')) {
                            $rankImg = 'images/ranks/admiral.jpg';
                        } elseif (str_contains($rankTitle, 'lieutenant')) {
                            $rankImg = 'images/ranks/lieutenant.png';
                        } elseif (str_contains($rankTitle, 'sergeant') || str_contains($rankTitle, 'sergent')) {
                            $rankImg = 'images/ranks/sergent.jpg';
                        } elseif (str_contains($rankTitle, 'captain')) {
                            $rankImg = 'images/ranks/captain.jpg';
                        } elseif (str_contains($rankTitle, 'soldier')) {
                            $rankImg = 'images/ranks/soldier.jpg';
                        } else {
                            $rankImg = 'images/ranks/rookie.jpg';
                        }
                    @endphp
                    <div class="flex-1 space-y-4 text-center sm:text-left w-full">
                        <!-- NAME & BADGES -->
                        <div>
                            <div class="flex items-center justify-center sm:justify-start gap-2">
                                <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight">
                                    {{ $user->name }}
                                </h1>
                                @if($user->email === 'parsabe99@gmail.com')
                                    <!-- OWNER GREEN VERIFIED CHECKMARK BADGE -->
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-emerald-500 text-white font-bold text-xs shadow-[0_0_12px_rgba(16,185,129,0.8)] border border-emerald-300" title="Verified Bossman Owner • Ancient Persian Heritage">✓</span>
                                @else
                                    <img src="{{ asset('images/ranks/verification.png') }}" class="w-6 h-6 object-contain inline-block drop-shadow-[0_0_10px_rgba(59,130,246,0.8)]" title="Verified Sandika Agent" alt="Verified">
                                @endif
                                <img src="{{ asset($rankImg) }}" class="w-7 h-7 rounded-full object-cover border-2 border-amber-400/80 shadow inline-block" title="{{ $sandikaRank->rank_title ?? 'Sandika Rank' }}" alt="Rank Badge">
                            </div>
                            <p class="text-xs font-mono text-gray-400 font-semibold pt-0.5">
                                @({{ $user->username ?? 'user' }})
                            </p>
                        </div>

                        <!-- INSTAGRAM STATS ROW (1. Posts -> 2. Followers -> 3. Following -> 4. Journals -> 5. CP) -->
                        <div class="flex items-center justify-around sm:justify-start sm:space-x-8 text-center pt-2 sm:pt-0 border-t sm:border-t-0 border-white/10">
                            <!-- 1. POSTS -->
                            <button onclick="switchProfileTab('posts')" class="flex flex-col items-center group cursor-pointer">
                                <span class="text-base sm:text-lg font-bold text-white group-hover:text-indigo-400 transition">{{ count($posts) }}</span>
                                <span class="text-xs text-gray-300 font-medium">Posts</span>
                            </button>

                            <!-- 2. FOLLOWERS -->
                            <button onclick="openFollowersModal()" class="flex flex-col items-center group cursor-pointer">
                                <span class="text-base sm:text-lg font-bold text-white group-hover:text-blue-400 transition">{{ $followersCount }}</span>
                                <span class="text-xs text-gray-300 font-medium">Follower</span>
                            </button>

                            <!-- 3. FOLLOWING -->
                            <button onclick="openFollowingModal()" class="flex flex-col items-center group cursor-pointer">
                                <span class="text-base sm:text-lg font-bold text-white group-hover:text-purple-400 transition">{{ $followingCount }}</span>
                                <span class="text-xs text-gray-300 font-medium">Gefolgt</span>
                            </button>

                            <!-- 4. JOURNALS -->
                            <button onclick="switchProfileTab('journals')" class="flex flex-col items-center group cursor-pointer">
                                <span class="text-base sm:text-lg font-bold text-white group-hover:text-pink-400 transition">{{ count($articles) }}</span>
                                <span class="text-xs text-gray-300 font-medium">Journale</span>
                            </button>

                            <!-- 5. SANDIKA CP -->
                            <button onclick="switchProfileTab('progress')" class="flex flex-col items-center group cursor-pointer">
                                <span class="text-base sm:text-lg font-bold text-amber-400 group-hover:text-amber-300 transition">{{ $user->email === 'parsabe99@gmail.com' ? '∞' : ($sandikaRank->xp ?? 0) }}</span>
                                <span class="text-xs text-gray-300 font-medium">CP</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- BIO BELOW -->
                <div class="space-y-1 pt-1">
                    <p class="text-xs sm:text-sm text-gray-200 leading-relaxed font-sans font-medium">
                        {{ $user->bio ?? 'No bio added yet.' }}
                    </p>
                </div>

                <!-- FULL WIDTH ACTION BUTTON -->
                <button onclick="toggleProfileModal()" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 text-white font-bold rounded-xl text-xs shadow-lg transition flex items-center justify-center gap-2 border border-indigo-400/40 cursor-pointer">
                    <span>⚙️</span>
                    <span>{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Profil bearbeiten' : 'Edit Profile' }}</span>
                </button>

                <!-- STORY HIGHLIGHTS BUBBLES TRAY DIRECTLY UNDER BIO / ACTION BUTTON -->
                <div class="flex items-center space-x-4 overflow-x-auto pt-2 pb-1 chat-scroll">
                    <!-- + NEW ARCHIVE BUBBLE -->
                    <div onclick="openCreateArchiveModal()" class="flex flex-col items-center space-y-1 cursor-pointer shrink-0 group">
                        <div class="w-16 h-16 rounded-full border-2 border-dashed border-white/40 hover:border-pink-500 flex items-center justify-center bg-white/5 group-hover:bg-pink-500/20 transition">
                            <span class="text-xl text-gray-300 group-hover:text-white font-bold">+</span>
                        </div>
                        <span class="text-[11px] font-semibold text-gray-400 group-hover:text-white transition">New</span>
                    </div>

                    @foreach($archives as $arc)
                        <div onclick="viewStoryArchive({{ json_encode($arc) }})" class="flex flex-col items-center space-y-1 cursor-pointer shrink-0 group relative">
                            <div class="p-[2px] rounded-full bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 shadow-md group-hover:scale-105 transition">
                                <img src="{{ asset($arc->cover_image) }}" class="w-16 h-16 rounded-full object-cover border-2 border-gray-900">
                            </div>
                            <span class="text-[11px] font-semibold text-gray-200 truncate max-w-[70px]">{{ $arc->title }}</span>
                            <button onclick="event.stopPropagation(); deleteStoryArchive({{ $arc->id }})" title="Delete Archive" class="absolute -top-1 -right-1 w-5 h-5 bg-rose-600 hover:bg-rose-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow">✕</button>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- SEPARATED TAB BUTTONS (POSTS / JOURNALS / PROGRESS) -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2 border-b border-white/10 pb-2 overflow-x-auto">
                    <button onclick="switchProfileTab('posts')" id="tabBtnPosts" class="px-4 py-2 rounded-2xl text-xs font-bold transition flex items-center gap-2 bg-indigo-600 text-white shadow-lg border border-indigo-400/40">
                        <span>📱</span>
                        <span>{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Posts' : 'Beiträge' }} ({{ count($posts) }})</span>
                    </button>

                    <button onclick="switchProfileTab('journals')" id="tabBtnJournals" class="px-4 py-2 rounded-2xl text-xs font-bold transition flex items-center gap-2 bg-white/10 hover:bg-white/20 text-gray-300 border border-white/10">
                        <span>📔</span>
                        <span>{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Journale' : 'Journals' }} ({{ count($articles) }})</span>
                    </button>

                    <button onclick="switchProfileTab('progress')" id="tabBtnProgress" class="px-4 py-2 rounded-2xl text-xs font-bold transition flex items-center gap-2 bg-white/10 hover:bg-white/20 text-gray-300 border border-white/10">
                        <span>⚔️</span>
                        <span>Sandika & Nigma {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Fortschritt' : 'Progress' }}</span>
                    </button>
                </div>

                <!-- 1. POSTS TAB CONTENT (INSTAGRAM 3x3 GRID TEMPLATE) -->
                <div id="tabContentPosts" class="animate-tab-fade space-y-4">
                    @if(count($posts) > 0)
                        <div class="grid grid-cols-3 gap-1.5 sm:gap-2.5 md:gap-3">
                            @foreach($posts as $p)
                                <div class="aspect-square bg-black/60 rounded-xl sm:rounded-2xl overflow-hidden relative group cursor-pointer border border-white/10 shadow-md">
                                    @if($p['media_url'] && $p['media_type'] === 'image')
                                        <img src="{{ $p['media_url'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    @elseif($p['media_url'] && $p['media_type'] === 'video')
                                        <video src="{{ $p['media_url'] }}" class="w-full h-full object-cover"></video>
                                        <span class="absolute top-2 right-2 text-white text-xs bg-black/60 px-1.5 py-0.5 rounded">▶</span>
                                    @else
                                        <div class="w-full h-full p-3 flex flex-col justify-between bg-gradient-to-br from-slate-900 via-indigo-950 to-purple-950 text-[11px] text-gray-200 font-sans leading-snug">
                                            <p class="line-clamp-4 italic text-gray-300 font-medium">"{{ Str::limit($p['content'], 80) }}"</p>
                                            <span class="text-[9px] font-mono text-indigo-400 self-end">@({{ $p['username'] }})</span>
                                        </div>
                                    @endif

                                    <!-- HOVER OVERLAY (INSTAGRAM LIKES & COMMENTS COUNTER) -->
                                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center gap-3 sm:gap-5 transition duration-200 text-white font-bold text-xs sm:text-sm">
                                        <span class="flex items-center gap-1">
                                            ❤️ <span>{{ $p['likes_count'] ?? 0 }}</span>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            💬 <span>{{ count($p['comments'] ?? []) }}</span>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 rounded-3xl bg-black/40 border border-white/10 text-center text-gray-400 text-xs font-mono">
                            No posts published yet.
                        </div>
                    @endif
                </div>

                <!-- 2. JOURNALS TAB CONTENT -->
                <div id="tabContentJournals" class="hidden animate-tab-fade space-y-4">
                    @if(count($articles) > 0)
                        <div class="space-y-3">
                            @foreach($articles as $art)
                                <div class="p-4 rounded-3xl bg-black/50 border border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs">
                                    <div class="space-y-1 overflow-hidden flex-1">
                                        <h4 class="font-bold text-white text-sm truncate">{{ $art->title }}</h4>
                                        <p class="text-[10px] text-indigo-400 font-mono">{{ $art->created_at->format('M d, Y') }} • Published Journal</p>
                                    </div>
                                    <div class="flex items-center space-x-2 shrink-0">
                                        <a href="/publications/articles/{{ $art->slug }}" class="px-3 py-1.5 bg-indigo-600/40 hover:bg-indigo-600 text-indigo-200 hover:text-white rounded-xl font-semibold transition">
                                            View ➔
                                        </a>
                                        <button onclick="openEditArticleModal({{ $art->id }}, '{{ addslashes($art->title) }}', '{{ addslashes(str_replace(["\r", "\n"], [' ', ' '], $art->content)) }}')" class="px-3 py-1.5 bg-blue-600/40 hover:bg-blue-600 text-blue-200 hover:text-white rounded-xl font-semibold transition">
                                            ✏️ Edit
                                        </button>
                                        <button onclick="deleteUserArticle({{ $art->id }})" class="px-3 py-1.5 bg-rose-600/40 hover:bg-rose-600 text-rose-200 hover:text-white rounded-xl font-semibold transition">
                                            🗑️ Delete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 rounded-3xl bg-black/40 border border-white/10 text-center text-gray-400 text-xs font-mono space-y-2">
                            <p>No journals published yet.</p>
                        </div>
                    @endif
                </div>

                <!-- 3. SANDIKA & NIGMA PROGRESS TAB CONTENT -->
                <div id="tabContentProgress" class="hidden animate-tab-fade space-y-6">
                    <!-- SANDIKA AGENT PROGRESS CARD -->
                    <div class="p-6 rounded-3xl bg-gradient-to-br from-amber-950/40 via-black/60 to-purple-950/40 border border-amber-500/30 shadow-2xl space-y-5">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-amber-500/20 pb-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset($rankImg) }}" class="w-12 h-12 rounded-full border-2 border-amber-400/80 object-cover shadow-xl">
                                <div>
                                    <h3 class="font-extrabold text-white text-base tracking-wide flex items-center gap-2">
                                        <span>Sandika Cyber Intelligence Matrix</span>
                                        <img src="{{ asset('images/ranks/verification.png') }}" class="w-5 h-5 object-contain inline-block drop-shadow" title="Verified Sandika Agent">
                                    </h3>
                                    <p class="text-xs text-amber-300 font-mono">Agent Rank: <strong>{{ $user->email === 'parsabe99@gmail.com' ? 'Bossman 👑' : ($sandikaRank->rank_title ?? 'Captain') }}</strong> (Level {{ $user->email === 'parsabe99@gmail.com' ? 99 : ($sandikaRank->level ?? 1) }})</p>
                                </div>
                            </div>
                            <a href="{{ route('sandika') }}" class="px-4 py-2 bg-gradient-to-r from-amber-500 to-rose-600 hover:from-amber-400 hover:to-rose-500 text-white font-bold rounded-2xl text-xs shadow-lg transition transform hover:scale-105 active:scale-95 flex items-center gap-2 border border-white/20">
                                <span>Launch Sandika Portal</span>
                                <span>➔</span>
                            </a>
                        </div>

                        <!-- CP PROGRESS BAR -->
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-mono">
                                <span class="text-gray-300">Combat Power (CP / XP): <strong class="text-amber-400">{{ $user->email === 'parsabe99@gmail.com' ? '∞' : ($sandikaRank->xp ?? 0) }} CP</strong></span>
                                <span class="text-amber-400 font-bold">Level {{ $user->email === 'parsabe99@gmail.com' ? 99 : ($sandikaRank->level ?? 1) }}</span>
                            </div>
                            <div class="w-full h-3 bg-black/60 rounded-full overflow-hidden border border-amber-500/30 p-0.5">
                                <div class="h-full bg-gradient-to-r from-amber-500 via-rose-500 to-purple-600 rounded-full transition-all duration-500" style="width: {{ $user->email === 'parsabe99@gmail.com' ? '100%' : min(100, max(15, (($sandikaRank->xp ?? 0) / 200) * 100)) . '%' }};"></div>
                            </div>
                        </div>

                        <!-- STATS GRID -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                            <div class="p-3.5 rounded-2xl bg-black/40 border border-white/10 space-y-1">
                                <span class="text-amber-400 text-xs font-bold block">📖 Stories</span>
                                <span class="text-xl font-extrabold text-white">{{ $sandikaStoriesCount }}</span>
                                <span class="text-[10px] text-gray-400 block font-mono">Published</span>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-black/40 border border-white/10 space-y-1">
                                <span class="text-pink-400 text-xs font-bold block">📚 Lexicon</span>
                                <span class="text-xl font-extrabold text-white">{{ $sandikaDictCount }}</span>
                                <span class="text-[10px] text-gray-400 block font-mono">Words Contributed</span>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-black/40 border border-white/10 space-y-1">
                                <span class="text-indigo-400 text-xs font-bold block">💻 Git Insights</span>
                                <span class="text-xl font-extrabold text-white">{{ $sandikaGitCount }}</span>
                                <span class="text-[10px] text-gray-400 block font-mono">Repositories Logged</span>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-black/40 border border-white/10 space-y-1">
                                <span class="text-purple-400 text-xs font-bold block">👻 Arkham Solves</span>
                                <span class="text-xl font-extrabold text-white">{{ $sandikaArkhamCount }}</span>
                                <span class="text-[10px] text-gray-400 block font-mono">Spirits Exorcised</span>
                            </div>
                        </div>
                    </div>

                    <!-- 1. 💻 GIT INSIGHTS (EDITABLE BY USER) -->
                    <div class="p-6 rounded-3xl bg-black/50 border border-white/10 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <h4 class="font-extrabold text-white text-sm font-mono flex items-center gap-2">
                                <span>💻 GIT INSIGHTS & REPOSITORIES LOGGED</span>
                                <span class="px-2.5 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 text-xs border border-indigo-500/40">Editable</span>
                            </h4>
                            <span class="text-xs text-gray-400 font-mono">{{ count($userGit) }} Contributed</span>
                        </div>

                        @if(count($userGit) > 0)
                            <div class="space-y-3">
                                @foreach($userGit as $g)
                                    <div class="p-4 rounded-2xl bg-black/60 border border-white/10 space-y-2 text-xs">
                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                                            <a href="{{ $g->repo_url }}" target="_blank" class="font-bold text-emerald-400 hover:underline flex items-center gap-1.5 truncate max-w-md">
                                                <span>🔗</span> {{ $g->repo_url }}
                                            </a>
                                            <div class="flex items-center gap-2 shrink-0">
                                                <span class="text-[10px] font-mono text-amber-400 font-bold">+{{ $g->cp_awarded ?? 15 }} CP</span>
                                                <button onclick="openEditGitInsightModal(this)" 
                                                    data-id="{{ $g->id }}" 
                                                    data-repo="{{ e($g->repo_url) }}" 
                                                    data-desc="{{ e($g->description) }}"
                                                    class="px-3 py-1 bg-indigo-600/40 hover:bg-indigo-600 text-indigo-200 hover:text-white rounded-xl text-xs font-bold transition flex items-center gap-1 cursor-pointer">
                                                    <span>✏️</span> Edit
                                                </button>
                                                <button onclick="deleteGitInsight({{ $g->id }})" 
                                                    class="px-3 py-1 bg-rose-600/40 hover:bg-rose-600 text-rose-200 hover:text-white rounded-xl text-xs font-bold transition flex items-center gap-1 cursor-pointer">
                                                    <span>🗑️</span> Delete
                                                </button>
                                            </div>
                                        </div>
                                        <p class="text-gray-300 leading-relaxed font-sans">{{ $g->description }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 text-center text-xs text-gray-400 font-mono italic bg-white/5 rounded-2xl">
                                No Git insights logged yet. Visit Sandika Portal to log repositories!
                            </div>
                        @endif
                    </div>

                    <!-- 2. 👻 AMADEUS ARKHAM SPIRITS SOLVED (READ-ONLY WITH AUDIO PLAYERS) -->
                    @php
                        $solvedSpiritIds = $userArkham->pluck('spirit_id')->toArray();
                    @endphp
                    <div class="p-6 rounded-3xl bg-black/50 border border-white/10 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <h4 class="font-extrabold text-white text-sm font-mono flex items-center gap-2">
                                <span>👻 AMADEUS ARKHAM SPIRITS SOLVED (AUDIO LOGS)</span>
                            </h4>
                            <span class="text-xs text-amber-400 font-mono font-bold">{{ count($solvedSpiritIds) }} / 10 Solved</span>
                        </div>

                        <div class="flex flex-col space-y-4 w-full">
                            @for ($i = 1; $i <= 10; $i++)
                                @php
                                    $isSolved = in_array($i, $solvedSpiritIds);
                                @endphp
                                <div class="p-4 rounded-2xl bg-black/60 border border-white/10 space-y-3 w-full">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-amber-500 to-rose-600 flex items-center justify-center text-white font-mono font-bold text-xs shadow">
                                                #{{ $i }}
                                            </div>
                                            <div>
                                                <h5 class="text-xs font-bold text-white font-mono">Arkham Spirit Cipher #{{ $i }}</h5>
                                                <span class="text-[10px] text-amber-400 font-mono">Reward: +20 CP + Audio Track</span>
                                            </div>
                                        </div>
                                        <div>
                                            @if($isSolved)
                                                <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 text-[10px] font-mono font-bold">
                                                    ✅ Deciphered (+20 CP)
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-full bg-gray-800 text-gray-400 border border-white/10 text-[10px] font-mono">
                                                    🔒 Sealed Audio Log
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($isSolved)
                                        <!-- FULL AUDIO PLAYER FOR SOLVED SPIRITS -->
                                        <div id="arkham-profile-audio-card-{{ $i }}" class="p-3 bg-gradient-to-r from-indigo-950/80 via-purple-950/80 to-black/80 border border-indigo-500/40 rounded-xl space-y-2">
                                            <div class="flex items-center gap-3">
                                                <button onclick="toggleArkhamAudio({{ $i }})" id="arkham-play-btn-{{ $i }}" class="w-9 h-9 rounded-full bg-indigo-600 hover:bg-indigo-500 text-white flex items-center justify-center font-bold text-xs shadow shrink-0">
                                                    ▶
                                                </button>
                                                <div class="flex-1 space-y-1">
                                                    <input type="range" id="arkham-seek-{{ $i }}" value="0" min="0" max="100" step="0.1" oninput="seekArkhamAudio({{ $i }}, this.value)" class="w-full h-1.5 bg-black/80 rounded-lg appearance-none cursor-pointer accent-indigo-400">
                                                    <div class="flex justify-between text-[10px] text-gray-400 font-mono">
                                                        <span id="arkham-time-curr-{{ $i }}">0:00</span>
                                                        <span id="arkham-time-dur-{{ $i }}">0:00</span>
                                                    </div>
                                                </div>
                                                <button onclick="replayArkhamAudio({{ $i }})" title="Replay Audio" class="p-2 rounded-xl bg-white/10 hover:bg-white/20 text-gray-200 text-xs font-bold shrink-0">
                                                    🔄
                                                </button>
                                                <audio id="arkham-audio-player-{{ $i }}" src="{{ asset("audio/sandika/{$i}.mp3") }}" preload="metadata" ontimeupdate="updateArkhamAudioProgress({{ $i }})" onended="onArkhamAudioEnded({{ $i }})"></audio>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- 3. 📖 PUBLISHED STORIES HUB -->
                    <div class="p-6 rounded-3xl bg-black/50 border border-white/10 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <h4 class="font-extrabold text-white text-sm font-mono flex items-center gap-2">
                                <span>📖 PUBLISHED STORIES HUB</span>
                            </h4>
                            <span class="text-xs text-amber-400 font-mono">{{ count($userStories) }} Published</span>
                        </div>

                        @if(count($userStories) > 0)
                            <div class="space-y-3">
                                @foreach($userStories as $st)
                                    <div class="p-4 rounded-2xl bg-black/60 border border-white/10 space-y-2 text-xs">
                                        <div class="flex items-center justify-between">
                                            <h5 class="font-bold text-white text-sm">{{ $st->title }}</h5>
                                            <span class="text-[10px] font-mono text-amber-400 font-bold">+{{ $st->cp_awarded ?? 10 }} CP</span>
                                        </div>
                                        <p class="text-gray-300 leading-relaxed font-sans line-clamp-3">{{ $st->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 text-center text-xs text-gray-400 font-mono italic bg-white/5 rounded-2xl">
                                No stories published yet.
                            </div>
                        @endif
                    </div>

                    <!-- 4. 📚 LEXICON DICTIONARY CONTRIBUTIONS -->
                    <div class="p-6 rounded-3xl bg-black/50 border border-white/10 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <h4 class="font-extrabold text-white text-sm font-mono flex items-center gap-2">
                                <span>📚 LEXICON DICTIONARY CONTRIBUTIONS</span>
                            </h4>
                            <span class="text-xs text-pink-400 font-mono">{{ count($userDict) }} Entries</span>
                        </div>

                        @if(count($userDict) > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($userDict as $d)
                                    <div class="p-4 rounded-2xl bg-black/60 border border-white/10 space-y-1 text-xs">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-white uppercase font-mono">{{ $d->word }}</span>
                                            <span class="px-2 py-0.5 rounded-md bg-indigo-600/30 text-indigo-300 text-[10px] font-mono uppercase font-bold">{{ $d->language ?? 'en' }}</span>
                                        </div>
                                        <p class="text-gray-300 leading-relaxed font-sans text-[11px]">{{ $d->definition }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 text-center text-xs text-gray-400 font-mono italic bg-white/5 rounded-2xl">
                                No dictionary words contributed yet.
                            </div>
                        @endif
                    </div>

                    <!-- 5. NIGMA RIDDLER PROGRESS CARD -->
                    <div class="p-6 rounded-3xl bg-gradient-to-br from-emerald-950/40 via-black/60 to-cyan-950/40 border border-emerald-500/30 shadow-2xl space-y-5">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-emerald-500/20 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-2xl shadow-lg">
                                    🧩
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-white text-base tracking-wide flex items-center gap-2">
                                        <span>Nigma Cryptographic Archive</span>
                                    </h3>
                                    <p class="text-xs text-emerald-300 font-mono">Riddler Decryption Solves</p>
                                </div>
                            </div>
                            <a href="{{ route('nigma') }}" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-bold rounded-2xl text-xs shadow-lg transition transform hover:scale-105 active:scale-95 flex items-center gap-2 border border-white/20">
                                <span>Enter Nigma Riddler Vault</span>
                                <span>➔</span>
                            </a>
                        </div>

                        <!-- NIGMA SOLVES PROGRESS BAR -->
                        @php
                            $nigmaPercent = round(($nigmaSolvedCount / max(1, $nigmaTotalRiddles)) * 100);
                        @endphp
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-mono">
                                <span class="text-gray-300">Decryption Progress: <strong class="text-emerald-400">{{ $nigmaSolvedCount }} of {{ $nigmaTotalRiddles }} Riddles Solved</strong></span>
                                <span class="text-emerald-400 font-bold">{{ $nigmaPercent }}%</span>
                            </div>
                            <div class="w-full h-3 bg-black/60 rounded-full overflow-hidden border border-emerald-500/30 p-0.5">
                                <div class="h-full bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500 rounded-full transition-all duration-500" style="width: {{ max(5, $nigmaPercent) }}%;"></div>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-black/40 border border-white/10 flex items-center justify-between text-xs font-mono">
                            <span class="text-gray-300">Solving riddles in Nigma awards <strong class="text-emerald-300">+15 CP</strong> to your Sandika Agent rank!</span>
                            <span class="text-emerald-400 font-bold">Total CP Earned: +{{ $nigmaSolvedCount * 15 }} CP</span>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- FULL COMPLETE USER PROFILE CUSTOMIZER MODAL -->
    <div id="profileModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-6 rounded-3xl w-full max-w-lg shadow-2xl text-xs chat-scroll max-h-[90vh] overflow-y-auto animate-scale-up space-y-4">
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span>⚙️ Profile Settings & Customizer Suite</span>
                </h3>
                <button onclick="toggleProfileModal()" class="text-gray-400 hover:text-white text-sm font-bold">✕</button>
            </div>

            <form id="profileForm" onsubmit="saveProfileSettings(event)" class="space-y-4">
                @csrf
                
                <!-- HEADER COVER PREVIEW & UPLOAD -->
                <div class="relative w-full h-28 rounded-2xl overflow-hidden bg-gradient-to-r from-indigo-900 via-purple-900 to-slate-900 border border-white/10 group">
                    <img id="profileHeaderPreview" src="{{ $user->header_banner ? asset($user->header_banner) : '' }}" 
                        class="w-full h-full object-cover {{ $user->header_banner ? '' : 'hidden' }}">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <label class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 rounded-xl font-semibold text-white cursor-pointer transition text-[11px] shadow-lg">
                            🖼️ Change Cover Banner
                            <input type="file" name="header_banner" accept="image/*" onchange="previewHeaderImage(event)" class="hidden">
                        </label>
                    </div>
                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded-md bg-black/60 backdrop-blur-sm text-[9px] text-gray-300 font-mono">Cover Banner</span>
                </div>

                <!-- AVATAR & USERNAME SECTION -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <img id="profileAvatarPreview" src="{{ $user->avatar_url }}" class="w-16 h-16 rounded-full border-2 border-blue-500 object-cover shadow-lg">
                        <label class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-blue-600 hover:bg-blue-500 flex items-center justify-center text-white cursor-pointer shadow">
                            📷
                            <input type="file" name="avatar" accept="image/*" onchange="previewAvatarImage(event)" class="hidden">
                        </label>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-white text-sm">{{ $user->name }}</h4>
                        <p class="text-[11px] text-gray-400 font-mono">{{ $user->username ? '@' . $user->username : $user->email }}</p>
                    </div>
                </div>

                <!-- BATCH MULTI AVATARS / HEADERS UPLOAD -->
                <div class="grid grid-cols-2 gap-2 pt-2 border-t border-white/10">
                    <label class="px-3 py-2 bg-blue-600/30 hover:bg-blue-600/50 border border-blue-500/40 text-blue-200 rounded-xl text-center font-semibold cursor-pointer transition">
                        + Add Avatars
                        <input type="file" name="multiple_avatars[]" multiple accept="image/*" onchange="saveProfileSettings(event)" class="hidden">
                    </label>
                    <label class="px-3 py-2 bg-purple-600/30 hover:bg-purple-600/50 border border-purple-500/40 text-purple-200 rounded-xl text-center font-semibold cursor-pointer transition">
                        + Add Headers
                        <input type="file" name="multiple_headers[]" multiple accept="image/*" onchange="saveProfileSettings(event)" class="hidden">
                    </label>
                </div>

                <!-- NAME & USERNAME -->
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-gray-400 mb-1">First Name <span class="text-rose-400">*</span></label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" required class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-2 text-white">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-1">Last Name <span class="text-rose-400">*</span></label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" required class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-2 text-white">
                    </div>
                </div>

                <div>
                    <label class="block text-gray-400 mb-1">@Username <span class="text-rose-400">*</span></label>
                    <input type="text" name="username" value="{{ $user->username }}" required class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-2 text-white">
                </div>

                <div>
                    <label class="block text-gray-400 mb-1">Bio / Headline <span class="text-[10px] text-gray-500 font-normal">(Optional)</span></label>
                    <textarea name="bio" rows="2" placeholder="Tell us about yourself (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-2 text-white resize-none">{{ $user->bio }}</textarea>
                </div>

                <!-- PRIVACY SETTINGS -->
                <div class="space-y-2 pt-2 border-t border-white/10">
                    <label class="block font-bold text-gray-300">🛡️ Account Privacy</label>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-gray-400 text-[10px] mb-1">Visibility</label>
                            <select name="account_privacy" class="w-full bg-black/40 border border-white/20 rounded-xl px-2.5 py-1.5 text-white">
                                <option value="public" {{ $user->account_privacy === 'public' ? 'selected' : '' }}>🌐 Public</option>
                                <option value="private" {{ $user->account_privacy === 'private' ? 'selected' : '' }}>🔒 Private</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-400 text-[10px] mb-1">Story Privacy</label>
                            <select name="story_privacy" class="w-full bg-black/40 border border-white/20 rounded-xl px-2.5 py-1.5 text-white">
                                <option value="public" {{ $user->story_privacy === 'public' ? 'selected' : '' }}>🌐 Everyone</option>
                                <option value="followers" {{ $user->story_privacy === 'followers' ? 'selected' : '' }}>👥 Followers Only</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SOCIAL LINKS -->
                <div class="space-y-2 pt-2 border-t border-white/10">
                    <label class="block font-bold text-gray-300">Social Media Links <span class="text-[10px] text-gray-500 font-normal">(Optional)</span></label>
                    <input type="text" name="social_linkedin" value="{{ $user->social_links['linkedin'] ?? '' }}" placeholder="LinkedIn URL (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-1.5 text-white">
                    <input type="text" name="social_github" value="{{ $user->social_links['github'] ?? '' }}" placeholder="GitHub URL (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-1.5 text-white">
                    <input type="text" name="social_twitter" value="{{ $user->social_links['twitter'] ?? '' }}" placeholder="Twitter URL (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-1.5 text-white">
                    <input type="text" name="social_website" value="{{ $user->social_links['website'] ?? '' }}" placeholder="Website URL (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-1.5 text-white">
                </div>

                <div class="flex justify-end space-x-2 pt-3 border-t border-white/10">
                    <button type="button" onclick="toggleProfileModal()" class="px-4 py-2 bg-gray-800 text-gray-300 rounded-xl">Cancel</button>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white font-bold rounded-xl shadow-lg">Save All Settings</button>
                </div>
            </form>
        </div>
    </div>

    <!-- FOLLOWERS MODAL -->
    <div id="followersModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-6 rounded-3xl w-full max-w-md shadow-2xl text-xs space-y-4 animate-scale-up">
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span>👥 Followers ({{ count($followersUsers) }})</span>
                </h3>
                <button onclick="closeFollowersModal()" class="text-gray-400 hover:text-white text-base font-bold">✕</button>
            </div>
            <div id="followersListContainer" class="space-y-3 max-h-80 overflow-y-auto chat-scroll p-1">
                @forelse($followersUsers as $f)
                    <div class="p-3 rounded-2xl bg-black/60 border border-white/10 flex items-center justify-between gap-3 hover:border-indigo-500/40 transition">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <img src="{{ $f->avatar_url }}" class="w-11 h-11 rounded-full object-cover border border-white/20 shadow shrink-0">
                            <div class="truncate">
                                <h4 class="font-bold text-white text-xs truncate">{{ $f->name }}</h4>
                                <p class="text-[11px] text-gray-400 font-mono truncate">@({{ $f->username ?? 'user' }})</p>
                            </div>
                        </div>
                        <a href="/user/{{ $f->id }}/profile" class="px-3 py-1.5 bg-indigo-600/40 hover:bg-indigo-600 text-indigo-200 hover:text-white rounded-xl text-xs font-bold transition shrink-0">
                            View Profile
                        </a>
                    </div>
                @empty
                    <div class="p-8 text-center text-xs font-mono text-gray-400 italic bg-white/5 rounded-2xl">
                        No followers found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- FOLLOWING MODAL -->
    <div id="followingModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-6 rounded-3xl w-full max-w-md shadow-2xl text-xs space-y-4 animate-scale-up">
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span>✨ Following ({{ count($followingUsers) }})</span>
                </h3>
                <button onclick="closeFollowingModal()" class="text-gray-400 hover:text-white text-base font-bold">✕</button>
            </div>
            <div id="followingListContainer" class="space-y-3 max-h-80 overflow-y-auto chat-scroll p-1">
                @forelse($followingUsers as $fg)
                    <div class="p-3 rounded-2xl bg-black/60 border border-white/10 flex items-center justify-between gap-3 hover:border-purple-500/40 transition">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <img src="{{ $fg->avatar_url }}" class="w-11 h-11 rounded-full object-cover border border-white/20 shadow shrink-0">
                            <div class="truncate">
                                <h4 class="font-bold text-white text-xs truncate">{{ $fg->name }}</h4>
                                <p class="text-[11px] text-gray-400 font-mono truncate">@({{ $fg->username ?? 'user' }})</p>
                            </div>
                        </div>
                        <a href="/user/{{ $fg->id }}/profile" class="px-3 py-1.5 bg-purple-600/40 hover:bg-purple-600 text-purple-200 hover:text-white rounded-xl text-xs font-bold transition shrink-0">
                            Following
                        </a>
                    </div>
                @empty
                    <div class="p-8 text-center text-xs font-mono text-gray-400 italic bg-white/5 rounded-2xl">
                        No following found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('taskbar')
    <script src="{{ asset('js/mac-window-controls.js') }}"></script>
    <script>
        function toggleProfileModal() {
            const modal = document.getElementById('profileModal');
            if (modal) modal.classList.toggle('hidden');
        }

        function switchProfileTab(tab) {
            const btnPosts = document.getElementById('tabBtnPosts');
            const btnJournals = document.getElementById('tabBtnJournals');
            const btnProgress = document.getElementById('tabBtnProgress');

            const contentPosts = document.getElementById('tabContentPosts');
            const contentJournals = document.getElementById('tabContentJournals');
            const contentProgress = document.getElementById('tabContentProgress');

            if (btnPosts) btnPosts.className = "px-4 py-2 rounded-2xl text-xs font-bold transition flex items-center gap-2 bg-white/10 hover:bg-white/20 text-gray-300 border border-white/10";
            if (btnJournals) btnJournals.className = "px-4 py-2 rounded-2xl text-xs font-bold transition flex items-center gap-2 bg-white/10 hover:bg-white/20 text-gray-300 border border-white/10";
            if (btnProgress) btnProgress.className = "px-4 py-2 rounded-2xl text-xs font-bold transition flex items-center gap-2 bg-white/10 hover:bg-white/20 text-gray-300 border border-white/10";

            if (contentPosts) contentPosts.classList.add('hidden');
            if (contentJournals) contentJournals.classList.add('hidden');
            if (contentProgress) contentProgress.classList.add('hidden');

            if (tab === 'posts' && contentPosts) {
                if (btnPosts) btnPosts.className = "px-4 py-2 rounded-2xl text-xs font-bold transition flex items-center gap-2 bg-indigo-600 text-white shadow-lg border border-indigo-400/40";
                contentPosts.classList.remove('hidden');
            } else if (tab === 'journals' && contentJournals) {
                if (btnJournals) btnJournals.className = "px-4 py-2 rounded-2xl text-xs font-bold transition flex items-center gap-2 bg-pink-600 text-white shadow-lg border border-pink-400/40";
                contentJournals.classList.remove('hidden');
            } else if (tab === 'progress' && contentProgress) {
                if (btnProgress) btnProgress.className = "px-4 py-2 rounded-2xl text-xs font-bold transition flex items-center gap-2 bg-amber-600 text-white shadow-lg border border-amber-400/40";
                contentProgress.classList.remove('hidden');
            }
        }

        async function saveProfileSettings(e) {
            if (e && e.preventDefault) e.preventDefault();
            const form = document.getElementById('profileForm');
            if (!form) return;
            const formData = new FormData(form);

            try {
                const res = await fetch('/chat/profile', {
                    method: 'POST',
                    headers: { 
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                const data = await res.json();
                if (res.ok && data.status === 'success') {
                    if (window.showToast) window.showToast(data.message || 'Profile settings saved!', 'success');
                    else alert(data.message || 'Profile settings saved!');
                    setTimeout(() => location.reload(), 600);
                } else {
                    let errMsg = data.message || 'Error saving profile settings.';
                    if (data.errors) {
                        errMsg = Object.values(data.errors).flat().join('\n');
                    }
                    if (window.showToast) window.showToast(errMsg, 'error');
                    else alert(errMsg);
                }
            } catch (err) {
                console.error(err);
                alert('Network error while saving settings.');
            }
        }

        function previewHeaderImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.getElementById('profileHeaderPreview');
                    if (img) {
                        img.src = e.target.result;
                        img.classList.remove('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        function previewAvatarImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.getElementById('profileAvatarPreview');
                    if (img) img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        async function selectAvatarFromGallery(path) {
            const formData = new FormData();
            formData.append('avatar_path', path);
            try {
                const res = await fetch('/user/profile/select-avatar', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                    body: formData
                });
                const data = await res.json();
                if (data.status === 'success') {
                    if (window.showToast) window.showToast('Avatar updated!', 'success');
                    location.reload();
                }
            } catch (e) { console.error(e); }
        }

        async function selectHeaderFromGallery(path) {
            const formData = new FormData();
            formData.append('header_path', path);
            try {
                const res = await fetch('/user/profile/select-header', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                    body: formData
                });
                const data = await res.json();
                if (data.status === 'success') {
                    if (window.showToast) window.showToast('Cover Header updated!', 'success');
                    location.reload();
                }
            } catch (e) { console.error(e); }
        }

        function openFollowersModal() {
            document.getElementById('followersModal').classList.remove('hidden');
        }
        function closeFollowersModal() {
            document.getElementById('followersModal').classList.add('hidden');
        }
        function openFollowingModal() {
            document.getElementById('followingModal').classList.remove('hidden');
        }
        function closeFollowingModal() {
            document.getElementById('followingModal').classList.add('hidden');
        }

        async function deleteUserArticle(id) {
            if (!confirm('Are you sure you want to delete this journal?')) return;
            try {
                const res = await fetch(`/user/articles/${id}/delete`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
                });
                const data = await res.json();
                if (data.status === 'success') {
                    if (window.showToast) window.showToast('Journal deleted successfully.', 'success');
                    location.reload();
                }
            } catch (e) { console.error(e); }
        }

        function openCreateArchiveModal() {
            document.getElementById('createArchiveModal').classList.remove('hidden');
        }
        function closeCreateArchiveModal() {
            document.getElementById('createArchiveModal').classList.add('hidden');
        }
        function closeViewArchiveModal() {
            document.getElementById('viewArchiveModal').classList.add('hidden');
        }

        async function submitCreateArchive(e) {
            e.preventDefault();
            const form = document.getElementById('createArchiveForm');
            const formData = new FormData(form);

            try {
                const res = await fetch('/user/story-archives/create', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                    body: formData
                });
                const data = await res.json();
                if (data.status === 'success') {
                    if (window.showToast) window.showToast(data.message || 'Story Archive Highlight created!', 'success');
                    closeCreateArchiveModal();
                    location.reload();
                } else {
                    if (window.showToast) window.showToast(data.message || 'Error creating archive.', 'error');
                }
            } catch (err) { console.error(err); }
        }

        function viewStoryArchive(arc) {
            if (!arc) return;
            document.getElementById('archiveViewerTitle').innerText = arc.title || 'Story Archive';
            document.getElementById('archiveViewerCover').src = arc.cover_image ? '/' + arc.cover_image.replace(/^\//, '') : assetBaseUrl + '/' + @json($defaultAvatar);
            
            const container = document.getElementById('archiveViewerMediaContainer');
            const items = arc.story_items || [];
            document.getElementById('archiveViewerCount').innerText = `${items.length} Story Media Items`;

            if (items.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-6 space-y-2">
                        <img src="/${arc.cover_image}" class="w-full max-h-64 object-cover rounded-2xl border border-white/10 shadow-md">
                        <p class="text-xs text-gray-300 font-bold">${arc.title}</p>
                    </div>
                `;
            } else {
                container.innerHTML = items.map(item => `
                    <div class="rounded-2xl overflow-hidden border border-white/10 shadow-md">
                        ${item.type === 'video' ? `<video src="/${item.url}" controls class="w-full max-h-72 rounded-2xl"></video>` : `<img src="/${item.url}" class="w-full max-h-72 object-cover rounded-2xl">`}
                    </div>
                `).join('');
            }

            document.getElementById('viewArchiveModal').classList.remove('hidden');
        }

        async function deleteStoryArchive(id) {
            if (!confirm('Are you sure you want to delete this Story Archive?')) return;
            try {
                const res = await fetch(`/user/story-archives/${id}/delete`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
                });
                const data = await res.json();
                if (data.status === 'success') {
                    if (window.showToast) window.showToast('Story Archive deleted.', 'success');
                    location.reload();
                }
            } catch (e) { console.error(e); }
        }
    </script>

    <!-- CREATE STORY ARCHIVE MODAL -->
    <div id="createArchiveModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-6 rounded-3xl w-full max-w-md shadow-2xl text-xs space-y-4 animate-scale-up">
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span>📸 {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Story-Archiv Highlight Erstellen' : 'Create Story Archive Highlight' }}</span>
                </h3>
                <button onclick="closeCreateArchiveModal()" class="text-gray-400 hover:text-white text-base font-bold">✕</button>
            </div>

            <form id="createArchiveForm" onsubmit="submitCreateArchive(event)" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-300 font-semibold mb-1">Archive Title</label>
                    <input type="text" name="title" required placeholder="e.g. Travels ✈️, AI Research 🤖, Memories..." class="w-full bg-black/50 border border-white/20 rounded-xl px-3.5 py-2 text-white text-xs focus:outline-none focus:border-pink-500">
                </div>

                <div>
                    <label class="block text-gray-300 font-semibold mb-1">Cover Thumbnail Image (Optional)</label>
                    <input type="file" name="cover_image" accept="image/*" class="w-full text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-pink-600/30 file:text-pink-300 hover:file:bg-pink-600/50">
                </div>

                <div>
                    <label class="block text-gray-300 font-semibold mb-1">Story Photos / Videos (Multiple)</label>
                    <input type="file" name="multiple_media[]" multiple accept="image/*,video/*" class="w-full text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/30 file:text-indigo-300 hover:file:bg-indigo-600/50">
                </div>

                <div>
                    <label class="block text-gray-300 font-semibold mb-1">Visibility</label>
                    <select name="visibility" class="w-full bg-black/50 border border-white/20 rounded-xl px-3 py-2 text-xs text-gray-200 focus:outline-none focus:border-pink-500">
                        <option value="public">🌐 Public (Everyone)</option>
                        <option value="private">🔒 Private (Only Me)</option>
                    </select>
                </div>

                <div class="flex items-center justify-end space-x-2 pt-3 border-t border-white/10">
                    <button type="button" onclick="closeCreateArchiveModal()" class="px-4 py-2 bg-gray-800 text-gray-300 rounded-xl font-semibold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-gradient-to-r from-amber-500 via-rose-500 to-purple-600 text-white font-bold rounded-xl shadow-lg hover:opacity-90 transition">Create Archive</button>
                </div>
            </form>
        </div>
    </div>

    <!-- VIEW STORY ARCHIVE MODAL -->
    <div id="viewArchiveModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-xl z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-6 rounded-3xl w-full max-w-lg shadow-2xl text-xs space-y-4 animate-scale-up relative">
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
                <div class="flex items-center space-x-3">
                    <img id="archiveViewerCover" src="{{ asset($defaultAvatar) }}" class="w-9 h-9 rounded-full border border-pink-500 object-cover">
                    <div>
                        <h3 id="archiveViewerTitle" class="text-sm font-bold text-white">Archive Title</h3>
                        <p id="archiveViewerCount" class="text-[10px] text-gray-400 font-mono">0 Story Media Items</p>
                    </div>
                </div>
    <!-- EDIT GIT INSIGHT MODAL -->
    <div id="editGitInsightModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-6 rounded-3xl w-full max-w-md shadow-2xl text-xs space-y-4 animate-scale-up">
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span>✏️ Edit Git Insight</span>
                </h3>
                <button onclick="closeEditGitInsightModal()" class="text-gray-400 hover:text-white text-base font-bold">✕</button>
            </div>

            <form id="editGitInsightForm" onsubmit="submitUpdateGitInsight(event)" class="space-y-4">
                @csrf
                <input type="hidden" id="edit_git_insight_id">
                <div>
                    <label class="block text-gray-300 font-semibold mb-1">Repository URL</label>
                    <input type="url" id="edit_git_repo_url" required placeholder="https://github.com/username/repo..." class="w-full bg-black/50 border border-white/20 rounded-xl px-3.5 py-2 text-white text-xs focus:outline-none focus:border-indigo-500 font-mono">
                </div>

                <div>
                    <label class="block text-gray-300 font-semibold mb-1">Description / Key Insight</label>
                    <textarea id="edit_git_description" required rows="4" placeholder="Description of repository insight..." class="w-full bg-black/50 border border-white/20 rounded-xl p-3 text-white text-xs focus:outline-none focus:border-indigo-500"></textarea>
                </div>

                <div class="flex items-center justify-end space-x-2 pt-3 border-t border-white/10">
                    <button type="button" onclick="closeEditGitInsightModal()" class="px-4 py-2 bg-gray-800 text-gray-300 rounded-xl font-semibold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl shadow-lg transition">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditGitInsightModal(btn) {
            const id = btn.getAttribute('data-id');
            const repoUrl = btn.getAttribute('data-repo');
            const description = btn.getAttribute('data-desc');

            document.getElementById('edit_git_insight_id').value = id;
            document.getElementById('edit_git_repo_url').value = repoUrl;
            document.getElementById('edit_git_description').value = description;
            document.getElementById('editGitInsightModal').classList.remove('hidden');
        }

        function closeEditGitInsightModal() {
            document.getElementById('editGitInsightModal').classList.add('hidden');
        }

        async function submitUpdateGitInsight(e) {
            e.preventDefault();
            const id = document.getElementById('edit_git_insight_id').value;
            const repoUrl = document.getElementById('edit_git_repo_url').value;
            const description = document.getElementById('edit_git_description').value;

            try {
                const res = await fetch(`/sandika/git/${id}/update`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ repo_url: repoUrl, description: description })
                });
                const data = await res.json();
                if (data.status === 'success') {
                    if (window.showToast) window.showToast(data.message || 'Git Insight updated cleanly!', 'success');
                    else alert(data.message || 'Git Insight updated!');
                    closeEditGitInsightModal();
                    setTimeout(() => location.reload(), 500);
                } else {
                    alert(data.message || 'Error updating Git Insight.');
                }
            } catch (err) {
                console.error(err);
                alert('Network error.');
            }
        }

        async function deleteGitInsight(id) {
            if (!confirm('Are you sure you want to delete this Git Insight?')) return;
            try {
                const res = await fetch(`/sandika/git/${id}/delete`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                const data = await res.json();
                if (data.status === 'success') {
                    if (window.showToast) window.showToast(data.message || 'Git Insight deleted successfully.', 'success');
                    else alert(data.message || 'Git Insight deleted.');
                    setTimeout(() => location.reload(), 500);
                } else {
                    alert(data.message || 'Error deleting Git Insight.');
                }
            } catch (err) {
                console.error(err);
                alert('Network error.');
            }
        }

        // Profile Audio Player Script for Amadeus Arkham Solves
        let activeProfileSpiritAudioId = null;

        function toggleArkhamAudio(spiritId) {
            const audio = document.getElementById(`arkham-audio-player-${spiritId}`);
            const btn = document.getElementById(`arkham-play-btn-${spiritId}`);

            if (!audio) return;

            if (activeProfileSpiritAudioId && activeProfileSpiritAudioId !== spiritId) {
                const prevAudio = document.getElementById(`arkham-audio-player-${activeProfileSpiritAudioId}`);
                const prevBtn = document.getElementById(`arkham-play-btn-${activeProfileSpiritAudioId}`);
                if (prevAudio) prevAudio.pause();
                if (prevBtn) prevBtn.innerText = '▶';
            }

            if (audio.paused) {
                audio.play().then(() => {
                    if (btn) btn.innerText = '⏸';
                    activeProfileSpiritAudioId = spiritId;
                }).catch(err => console.log('Audio play permission:', err));
            } else {
                audio.pause();
                if (btn) btn.innerText = '▶';
            }
        }

        function seekArkhamAudio(spiritId, percent) {
            const audio = document.getElementById(`arkham-audio-player-${spiritId}`);
            if (audio && audio.duration) {
                audio.currentTime = (percent / 100) * audio.duration;
            }
        }

        function replayArkhamAudio(spiritId) {
            const audio = document.getElementById(`arkham-audio-player-${spiritId}`);
            if (audio) {
                audio.currentTime = 0;
                toggleArkhamAudio(spiritId);
            }
        }

        function updateArkhamAudioProgress(spiritId) {
            const audio = document.getElementById(`arkham-audio-player-${spiritId}`);
            const seek = document.getElementById(`arkham-seek-${spiritId}`);
            const timeCurr = document.getElementById(`arkham-time-curr-${spiritId}`);
            const timeDur = document.getElementById(`arkham-time-dur-${spiritId}`);

            if (!audio || isNaN(audio.duration)) return;

            const current = audio.currentTime;
            const duration = audio.duration;

            if (seek) seek.value = (current / duration) * 100;

            if (timeCurr) {
                const mins = Math.floor(current / 60);
                const secs = Math.floor(current % 60);
                timeCurr.innerText = `${mins}:${secs < 10 ? '0' : ''}${secs}`;
            }

            if (timeDur) {
                const mins = Math.floor(duration / 60);
                const secs = Math.floor(duration % 60);
                timeDur.innerText = `${mins}:${secs < 10 ? '0' : ''}${secs}`;
            }
        }

        function onArkhamAudioEnded(spiritId) {
            const btn = document.getElementById(`arkham-play-btn-${spiritId}`);
            if (btn) btn.innerText = '▶';
            const seek = document.getElementById(`arkham-seek-${spiritId}`);
            if (seek) seek.value = 0;
        }

        // TELEGRAM-STYLE PROFILE AVATAR VIEWER SCRIPT
        const telegramAvatarsList = @json($avatarsList);
        const currentActiveAvatarPath = @json($activeAvatarPath);
        const isProfileOwner = @json($isProfileOwner);
        const assetBaseUrl = "{{ asset('') }}".replace(/\/$/, '');
        let currentAvatarIndex = 0;

        function openTelegramAvatarViewer(startIndex = 0) {
            currentAvatarIndex = startIndex;
            const modal = document.getElementById('telegramAvatarViewerModal');
            if (modal) {
                modal.classList.remove('hidden');
                updateTelegramAvatarDisplay();
            }
            document.addEventListener('keydown', handleTelegramAvatarKeyDown);
        }

        function closeTelegramAvatarViewer() {
            const modal = document.getElementById('telegramAvatarViewerModal');
            if (modal) modal.classList.add('hidden');
            document.removeEventListener('keydown', handleTelegramAvatarKeyDown);
        }

        function handleTelegramAvatarKeyDown(e) {
            if (e.key === 'ArrowLeft') navigateTelegramAvatar(-1);
            else if (e.key === 'ArrowRight') navigateTelegramAvatar(1);
            else if (e.key === 'Escape') closeTelegramAvatarViewer();
        }

        function navigateTelegramAvatar(direction) {
            if (!telegramAvatarsList || telegramAvatarsList.length === 0) return;
            currentAvatarIndex = (currentAvatarIndex + direction + telegramAvatarsList.length) % telegramAvatarsList.length;
            updateTelegramAvatarDisplay();
        }

        function selectTelegramAvatarIndex(index) {
            currentAvatarIndex = index;
            updateTelegramAvatarDisplay();
        }

        function getFullAssetUrl(path) {
            if (!path) return assetBaseUrl + '/' + @json($defaultAvatar);
            if (path.startsWith('http://') || path.startsWith('https://')) return path;
            const cleanPath = path.startsWith('/') ? path : '/' + path;
            return assetBaseUrl + cleanPath;
        }

        function updateTelegramAvatarDisplay() {
            if (!telegramAvatarsList || telegramAvatarsList.length === 0) return;
            if (currentAvatarIndex < 0 || currentAvatarIndex >= telegramAvatarsList.length) {
                currentAvatarIndex = 0;
            }

            const path = telegramAvatarsList[currentAvatarIndex];
            const mainImg = document.getElementById('telegramAvatarMainImg');
            const counter = document.getElementById('telegramAvatarCounter');
            const setMainBtn = document.getElementById('setMainAvatarBtn');

            if (mainImg) {
                mainImg.src = getFullAssetUrl(path);
                mainImg.style.opacity = '1';
            }

            if (counter) {
                counter.innerText = `${currentAvatarIndex + 1} of ${telegramAvatarsList.length}`;
            }

            // Highlight active thumbnail
            telegramAvatarsList.forEach((_, idx) => {
                const thumb = document.getElementById(`telegramThumb-${idx}`);
                if (thumb) {
                    if (idx === currentAvatarIndex) {
                        thumb.className = 'w-14 h-14 rounded-xl object-cover border-2 border-indigo-400 scale-110 shadow-lg brightness-110';
                    } else {
                        thumb.className = 'w-14 h-14 rounded-xl object-cover border-2 border-white/20 opacity-60 hover:opacity-100 transition';
                    }
                }
            });

            // Owner main avatar status button
            if (setMainBtn) {
                const cleanPath = path ? path.replace(/^\//, '') : '';
                const cleanActive = currentActiveAvatarPath ? currentActiveAvatarPath.replace(/^\//, '') : '';

                if (cleanPath === cleanActive) {
                    setMainBtn.innerHTML = `<span>✓</span><span>Active Main Profile Picture</span>`;
                    setMainBtn.className = "px-4 py-2 bg-emerald-600/80 text-white rounded-xl text-xs font-bold shadow-lg flex items-center gap-1.5 border border-emerald-400/40 cursor-default";
                    setMainBtn.disabled = true;
                } else {
                    setMainBtn.innerHTML = `<span>⭐</span><span>Set as Main Profile Picture</span>`;
                    setMainBtn.className = "px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-xl text-xs font-bold shadow-lg transition flex items-center gap-1.5 border border-white/20 cursor-pointer";
                    setMainBtn.disabled = false;
                }
            }
        }

        async function setTelegramAvatarAsMain() {
            const path = telegramAvatarsList[currentAvatarIndex];
            const formData = new FormData();
            formData.append('avatar_path', path);

            try {
                const res = await fetch('/user/profile/select-avatar', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                    body: formData
                });
                const data = await res.json();
                if (data.status === 'success') {
                    if (window.showToast) window.showToast('Main Profile Picture updated!', 'success');
                    location.reload();
                } else {
                    alert(data.message || 'Error setting main profile picture.');
                }
            } catch (e) {
                console.error(e);
                alert('Network error.');
            }
        }
    </script>

    <!-- TELEGRAM-STYLE AVATAR LIGHTBOX VIEWER MODAL -->
    <div id="telegramAvatarViewerModal" class="hidden fixed inset-0 bg-black/95 backdrop-blur-2xl z-50 flex flex-col justify-between p-4 md:p-6 animate-fade-in select-none">
        
        <!-- TOP TOOLBAR HEADER -->
        <div class="flex items-center justify-between z-20 px-2 pt-2">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full border border-white/20 overflow-hidden bg-black/40 shadow">
                    <img src="{{ asset($activeAvatarPath) }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white leading-tight">{{ $user->name }}</h3>
                    <p id="telegramAvatarCounter" class="text-[11px] text-gray-400 font-mono">1 of {{ count($avatarsList) }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                @if($isProfileOwner)
                    <button id="setMainAvatarBtn" onclick="setTelegramAvatarAsMain()" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-xl text-xs font-bold shadow-lg transition flex items-center gap-1.5 border border-white/20">
                        <span>⭐</span>
                        <span>Set as Main Profile Picture</span>
                    </button>
                @endif
                <button onclick="closeTelegramAvatarViewer()" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white font-bold flex items-center justify-center text-lg transition">✕</button>
            </div>
        </div>

        <!-- MAIN VIEWPORT CONTAINER WITH NAVIGATION ARROWS -->
        <div class="relative flex-1 flex items-center justify-center my-4 overflow-hidden">
            <!-- PREV ARROW -->
            <button onclick="navigateTelegramAvatar(-1)" class="absolute left-2 md:left-6 z-20 w-12 h-12 rounded-full bg-black/60 hover:bg-indigo-600/80 text-white font-bold flex items-center justify-center text-xl backdrop-blur-md border border-white/20 transition transform hover:scale-110 shadow-2xl">
                ❮
            </button>

            <!-- MAIN IMAGE DISPLAY -->
            <div class="relative max-w-4xl max-h-[70vh] flex items-center justify-center p-2">
                <img id="telegramAvatarMainImg" src="{{ asset($activeAvatarPath) }}" class="max-w-full max-h-[68vh] object-contain rounded-2xl border border-white/20 shadow-[0_0_50px_rgba(0,0,0,0.8)] transition duration-300 transform scale-100">
            </div>

            <!-- NEXT ARROW -->
            <button onclick="navigateTelegramAvatar(1)" class="absolute right-2 md:right-6 z-20 w-12 h-12 rounded-full bg-black/60 hover:bg-indigo-600/80 text-white font-bold flex items-center justify-center text-xl backdrop-blur-md border border-white/20 transition transform hover:scale-110 shadow-2xl">
                ❯
            </button>
        </div>

        <!-- BOTTOM THUMBNAILS STRIP CAROUSEL (TELEGRAM STYLE) -->
        <div class="w-full flex items-center justify-center z-20 pb-2">
            <div class="flex items-center space-x-3 overflow-x-auto p-2 max-w-2xl chat-scroll bg-black/60 border border-white/10 rounded-2xl backdrop-blur-md">
                @foreach($avatarsList as $index => $avPath)
                    <div onclick="selectTelegramAvatarIndex({{ $index }})" class="cursor-pointer shrink-0 transition transform hover:scale-105 group relative">
                        <img id="telegramThumb-{{ $index }}" src="{{ asset($avPath) }}" class="w-14 h-14 rounded-xl object-cover border-2 border-white/20 group-hover:border-indigo-400 transition shadow">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
