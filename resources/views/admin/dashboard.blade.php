<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARSABE Executive Data Analytics Platform</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Orbitron:wght@600;800&display=swap" rel="stylesheet">

    <!-- Tailwind & External Assets -->
    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js Library for Power BI Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-exec.css') }}">
</head>

<body class="antialiased min-h-screen p-4 lg:p-8 bg-slate-950 text-slate-100 font-['Outfit',sans-serif]">

    <div class="max-w-7xl mx-auto space-y-6 animate-page-fade-in">

        <!-- EXECUTIVE HEADER BAR -->
        <header class="exec-card p-6 rounded-3xl flex flex-col md:flex-row items-center justify-between gap-4 border border-indigo-500/20 shadow-2xl">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-500 via-purple-600 to-pink-500 flex items-center justify-center text-2xl shadow-xl animate-pulse">
                    📊
                </div>
                <div>
                    <h1 class="text-xl font-extrabold text-white tracking-wide flex items-center gap-2">
                        PARSABE EXECUTIVE ANALYTICS CORE
                        <span class="text-[10px] uppercase font-mono px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">ONLINE & LIVE</span>
                    </h1>
                    <p class="text-xs text-slate-400 font-medium">Real-Time Traffic, Member Management, Analytics & Governance Platform</p>
                </div>
            </div>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <input type="text" id="dashboard-search" onkeyup="filterDashboardTables()" placeholder="🔍 Search records, members, articles..."
                    class="bg-slate-900/90 border border-slate-700/80 rounded-xl px-4 py-2 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 w-full md:w-64 transition">
                
                <a href="/" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl text-xs font-semibold border border-slate-700 transition flex items-center gap-1.5 shrink-0">
                    <span>Exit Core</span>
                </a>
            </div>
        </header>

        <!-- FLASH NOTIFICATION ALERTS -->
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-semibold flex items-center justify-between animate-page-slide-down">
                <span>✅ {{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white font-bold">✕</button>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-2xl bg-rose-500/20 border border-rose-500/30 text-rose-300 text-xs font-semibold animate-page-slide-down">
                ⚠️ {{ $errors->first() }}
            </div>
        @endif

        <!-- POWER BI STYLE KPI CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- KPI 1: TRAFFIC & IMPRESSIONS -->
            <div class="exec-card p-5 rounded-2xl flex items-center justify-between border border-white/10 hover:border-indigo-500/40 transition group">
                <div>
                    <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Total Impressions</span>
                    <span class="text-3xl font-extrabold text-white mt-1 block tracking-tight">{{ number_format($totalVisits) }}</span>
                    <span class="text-[11px] text-emerald-400 font-semibold mt-1 inline-flex items-center gap-1">
                        📈 +16.4% this month
                    </span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-500/20 border border-blue-500/30 text-blue-400 flex items-center justify-center text-xl shadow-lg group-hover:scale-110 transition-transform">
                    🌐
                </div>
            </div>

            <!-- KPI 2: REGISTERED MEMBERS & AUDIT -->
            <div class="exec-card p-5 rounded-2xl flex items-center justify-between border border-white/10 hover:border-indigo-500/40 transition group">
                <div>
                    <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Registered Members</span>
                    <span class="text-3xl font-extrabold text-white mt-1 block tracking-tight">{{ $users->count() }}</span>
                    <span class="text-[11px] text-rose-400 font-semibold mt-1 inline-flex items-center gap-1">
                        ⚠️ {{ $deletedUsersCount }} deleted accounts audited
                    </span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-purple-500/20 border border-purple-500/30 text-purple-400 flex items-center justify-center text-xl shadow-lg group-hover:scale-110 transition-transform">
                    👤
                </div>
            </div>

            <!-- KPI 3: ARTICLES & MODERATION -->
            <div class="exec-card p-5 rounded-2xl flex items-center justify-between border border-white/10 hover:border-indigo-500/40 transition group">
                <div>
                    <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Published Articles</span>
                    <span class="text-3xl font-extrabold text-white mt-1 block tracking-tight">{{ $articles->count() }}</span>
                    <span class="text-[11px] text-amber-400 font-semibold mt-1 inline-flex items-center gap-1">
                        ✍️ {{ $deletedArticlesCount }} moderated articles
                    </span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-500/20 border border-amber-500/30 text-amber-400 flex items-center justify-center text-xl shadow-lg group-hover:scale-110 transition-transform">
                    📝
                </div>
            </div>

            <!-- KPI 4: CS RATING SCORE -->
            <div class="exec-card p-5 rounded-2xl flex items-center justify-between border border-white/10 hover:border-indigo-500/40 transition group">
                <div>
                    <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">CS Feedback Score</span>
                    <span class="text-3xl font-extrabold text-white mt-1 block tracking-tight">★ {{ $avgRating }} / 5.0</span>
                    <span class="text-[11px] text-pink-400 font-semibold mt-1 inline-flex items-center gap-1">
                        💬 {{ $feedbacks->count() }} ratings logged
                    </span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-pink-500/20 border border-pink-500/30 text-pink-400 flex items-center justify-center text-xl shadow-lg group-hover:scale-110 transition-transform">
                    ⭐
                </div>
            </div>
        </div>

        <!-- POWER BI CHARTS GRID (2x2) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- CHART 1: TRAFFIC & IMPRESSIONS TREND -->
            <div class="exec-card p-6 rounded-3xl border border-white/10 shadow-xl space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2">
                            <span>📈 Website Traffic & Page Visits Trend</span>
                        </h2>
                        <p class="text-xs text-slate-400">Daily visits over the past 7 days</p>
                    </div>
                    <span class="text-[10px] font-mono px-2 py-1 rounded bg-indigo-500/20 text-indigo-300">Live Analytics</span>
                </div>
                <div class="h-64 relative">
                    <canvas id="trafficTrendChart"></canvas>
                </div>
            </div>

            <!-- CHART 2: TOP VISITED PAGES DISTRIBUTION -->
            <div class="exec-card p-6 rounded-3xl border border-white/10 shadow-xl space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2">
                            <span>🍩 Visited Pages Traffic Breakdown</span>
                        </h2>
                        <p class="text-xs text-slate-400">Visits distribution across portal pages</p>
                    </div>
                    <span class="text-[10px] font-mono px-2 py-1 rounded bg-purple-500/20 text-purple-300">Distribution</span>
                </div>
                <div class="h-64 relative flex items-center justify-center">
                    <canvas id="pageDistributionChart"></canvas>
                </div>
            </div>

            <!-- CHART 3: MEMBER GROWTH & PORTAL MESSAGES -->
            <div class="exec-card p-6 rounded-3xl border border-white/10 shadow-xl space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2">
                            <span>📊 Member Signups & Chat Engagement</span>
                        </h2>
                        <p class="text-xs text-slate-400">Monthly account creation & chat volume</p>
                    </div>
                    <span class="text-[10px] font-mono px-2 py-1 rounded bg-emerald-500/20 text-emerald-300">Engagement</span>
                </div>
                <div class="h-64 relative">
                    <canvas id="memberActivityChart"></canvas>
                </div>
            </div>

            <!-- CHART 4: CS FEEDBACK RATINGS BREAKDOWN -->
            <div class="exec-card p-6 rounded-3xl border border-white/10 shadow-xl space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2">
                            <span>⭐ Campus Specialist Ratings Breakdown</span>
                        </h2>
                        <p class="text-xs text-slate-400">Rating distribution from 1 to 5 stars</p>
                    </div>
                    <span class="text-[10px] font-mono px-2 py-1 rounded bg-amber-500/20 text-amber-300">Feedback</span>
                </div>
                <div class="h-64 relative">
                    <canvas id="ratingsBreakdownChart"></canvas>
                </div>
            </div>
        </div>

        <!-- DYNAMIC DATA TABLES SECTION (TABBED POWER BI STYLE VIEW) -->
        <section class="exec-card rounded-3xl p-6 border border-white/10 shadow-2xl space-y-6">
            <!-- TAB NAVIGATION BUTTONS -->
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-800 pb-4">
                <div class="flex flex-wrap rounded-2xl bg-slate-900 p-1 border border-slate-800 text-xs font-semibold gap-1">
                    <button onclick="switchTab('analytics')" id="tabBtn-analytics" class="px-4 py-2 rounded-xl bg-indigo-600 text-white shadow-md transition">
                        🌐 Page Analytics
                    </button>
                    <button onclick="switchTab('members')" id="tabBtn-members" class="px-4 py-2 rounded-xl text-slate-400 hover:text-white transition">
                        👥 Members & Audit ({{ $users->count() }})
                    </button>
                    <button onclick="switchTab('articles')" id="tabBtn-articles" class="px-4 py-2 rounded-xl text-slate-400 hover:text-white transition">
                        ✍️ Articles Moderation ({{ $articles->count() }})
                    </button>
                    <button onclick="switchTab('contacts')" id="tabBtn-contacts" class="px-4 py-2 rounded-xl text-slate-400 hover:text-white transition">
                        📬 Contact Inquiries ({{ $contacts->count() }})
                    </button>
                    <button onclick="switchTab('feedbacks')" id="tabBtn-feedbacks" class="px-4 py-2 rounded-xl text-slate-400 hover:text-white transition">
                        💬 CS Feedbacks ({{ $feedbacks->count() }})
                    </button>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('parsa.feedback.export_csv') }}" 
                       id="btnExportFeedbackTop"
                       class="hidden px-3.5 py-1.5 bg-emerald-600/20 hover:bg-emerald-600 text-emerald-300 hover:text-white rounded-xl text-xs font-semibold border border-emerald-500/30 transition items-center gap-1.5 shadow-sm">
                        <span>📥</span>
                        <span>Export CS Feedback (CSV)</span>
                    </a>
                    @if($contacts->count() > 0)
                        <form action="{{ route('parsa.contacts.purge-all') }}" method="POST" onsubmit="return confirm('Purge all contact messages?');">
                            @csrf
                            <button type="submit" class="px-3.5 py-1.5 bg-rose-500/20 hover:bg-rose-500/30 text-rose-300 rounded-xl text-xs font-semibold border border-rose-500/30 transition flex items-center gap-1">
                                <span>🗑️ Purge All Contacts</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- TAB 1: VISITED PAGES ANALYTICS TABLE -->
            <div id="tabView-analytics" class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="exec-table-header text-xs text-slate-400 uppercase tracking-wider">
                            <th class="p-3.5 rounded-l-xl">Page Title</th>
                            <th class="p-3.5">URL Path</th>
                            <th class="p-3.5">Category</th>
                            <th class="p-3.5">Impressions</th>
                            <th class="p-3.5">Unique Visitors</th>
                            <th class="p-3.5 rounded-r-xl text-right">Growth Trend</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-xs">
                        @foreach($pageAnalytics as $p)
                            <tr class="exec-row hover:bg-slate-900/60 transition" data-searchable="{{ strtolower($p['name'] . ' ' . $p['route'] . ' ' . $p['category']) }}">
                                <td class="p-3.5 font-bold text-white flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                    {{ $p['name'] }}
                                </td>
                                <td class="p-3.5 font-mono text-indigo-400">{{ $p['route'] }}</td>
                                <td class="p-3.5">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-slate-800 text-slate-300 border border-slate-700">
                                        {{ $p['category'] }}
                                    </span>
                                </td>
                                <td class="p-3.5 font-bold text-slate-200">{{ number_format($p['visits']) }}</td>
                                <td class="p-3.5 text-slate-400">{{ number_format($p['uniques']) }}</td>
                                <td class="p-3.5 text-right font-bold text-emerald-400">{{ $p['trend'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- TAB 2: REGISTERED MEMBERS TABLE (WITH DELETED ACCOUNT AUDIT) -->
            <div id="tabView-members" class="hidden overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="exec-table-header text-xs text-slate-400 uppercase tracking-wider">
                            <th class="p-3.5 rounded-l-xl">Member Name</th>
                            <th class="p-3.5">Email Address</th>
                            <th class="p-3.5">@Username</th>
                            <th class="p-3.5">Bio / Info</th>
                            <th class="p-3.5">Joined Date</th>
                            <th class="p-3.5 rounded-r-xl text-right">Status / Audit Trail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-xs">
                        @forelse($users as $u)
                            <tr class="exec-row hover:bg-slate-900/60 transition {{ $u->trashed() ? 'bg-rose-950/20' : '' }}" data-searchable="{{ strtolower($u->name . ' ' . $u->email . ' ' . $u->username) }}">
                                <td class="p-3.5 font-bold text-white flex items-center gap-3">
                                    <img src="{{ $u->avatar ? asset($u->avatar) : asset('images/profile.jpg') }}" class="w-8 h-8 rounded-full border border-indigo-500/40 object-cover">
                                    <div>
                                        <div class="font-bold text-white">{{ $u->name }}</div>
                                        @if($u->email === 'parsabe99@gmail.com')
                                            <span class="text-[9px] font-bold uppercase px-1.5 py-0.2 rounded bg-amber-500/20 text-amber-300 border border-amber-500/30">Owner Admin</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-3.5 font-mono text-slate-300">{{ $u->email }}</td>
                                <td class="p-3.5 font-mono text-indigo-400">{{ $u->username ? '@' . $u->username : '-' }}</td>
                                <td class="p-3.5 text-slate-400 max-w-xs truncate">{{ $u->bio ?: 'No bio provided' }}</td>
                                <td class="p-3.5 text-slate-400">{{ $u->created_at->format('M d, Y') }}</td>
                                <td class="p-3.5 text-right">
                                    @if($u->trashed())
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30">
                                            DELETED ACCOUNT
                                        </span>
                                        @if($u->deleted_reason)
                                            <div class="text-[10px] text-rose-400 font-mono mt-0.5 max-w-xs ml-auto truncate" title="{{ $u->deleted_reason }}">Reason: {{ $u->deleted_reason }}</div>
                                        @endif
                                    @else
                                        <div class="flex items-center justify-end gap-2">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">Active</span>
                                            @if($u->email !== 'parsabe99@gmail.com' && $u->id !== auth()->id())
                                                <button onclick="openDeleteUserModal({{ $u->id }}, '{{ addslashes($u->name) }}', '{{ addslashes($u->email) }}')"
                                                        class="px-2.5 py-1 bg-rose-500/20 hover:bg-rose-500/40 text-rose-300 border border-rose-500/40 rounded-lg font-bold text-[11px] transition flex items-center gap-1 shadow-sm">
                                                    <span>🗑️ Delete</span>
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-500">No registered members found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- TAB 3: PUBLISHED ARTICLES MODERATION TABLE -->
            <div id="tabView-articles" class="hidden overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="exec-table-header text-xs text-slate-400 uppercase tracking-wider">
                            <th class="p-3.5 rounded-l-xl">Article Title</th>
                            <th class="p-3.5">Author</th>
                            <th class="p-3.5">Published Date</th>
                            <th class="p-3.5">Status / Policy Audit</th>
                            <th class="p-3.5 rounded-r-xl text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-xs">
                        @forelse($articles as $art)
                            <tr class="exec-row hover:bg-slate-900/60 transition {{ $art->trashed() ? 'bg-rose-950/20' : '' }}" data-searchable="{{ strtolower($art->title . ' ' . ($art->author->name ?? 'Unknown')) }}">
                                <td class="p-3.5 font-bold text-white max-w-xs truncate">{{ $art->title }}</td>
                                <td class="p-3.5 text-indigo-400 font-mono">{{ $art->author->name ?? 'Deleted Author' }}</td>
                                <td class="p-3.5 text-slate-400">{{ $art->created_at->format('M d, Y H:i') }}</td>
                                <td class="p-3.5">
                                    @if($art->trashed())
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30">
                                            DELETED {{ $art->deleted_by_admin ? '(BY ADMIN)' : '(BY USER)' }}
                                        </span>
                                        @if($art->deleted_reason)
                                            <div class="text-[10px] text-slate-400 font-mono mt-0.5">Reason: {{ $art->deleted_reason }}</div>
                                        @endif
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">PUBLIC LIVE</span>
                                    @endif
                                </td>
                                <td class="p-3.5 text-right space-x-1.5">
                                    <button onclick="openAdminReadArticleModal({{ $art->id }})" 
                                        class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg text-[11px] font-semibold border border-slate-700 transition">
                                        📖 Read Article
                                    </button>
                                    @if(!$art->trashed())
                                        <button onclick="openAdminDeleteArticleModal({{ $art->id }}, '{{ addslashes($art->title) }}', '{{ addslashes($art->author->name ?? 'Author') }}')" 
                                            class="px-2.5 py-1 bg-rose-500/20 hover:bg-rose-500/40 text-rose-300 rounded-lg text-[11px] font-semibold border border-rose-500/30 transition">
                                            🗑️ Delete & Notify Author
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-500">No blog articles recorded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- TAB 4: CONTACT SUBMISSIONS TABLE -->
            <div id="tabView-contacts" class="hidden overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="exec-table-header text-xs text-slate-400 uppercase tracking-wider">
                            <th class="p-3.5 rounded-l-xl">Sender Name</th>
                            <th class="p-3.5">Email Address</th>
                            <th class="p-3.5">Message Content</th>
                            <th class="p-3.5">Received Date</th>
                            <th class="p-3.5 rounded-r-xl text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-xs">
                        @forelse($contacts as $c)
                            <tr class="exec-row hover:bg-slate-900/60 transition" data-searchable="{{ strtolower($c->name . ' ' . $c->email . ' ' . $c->message) }}">
                                <td class="p-3.5 font-bold text-white">{{ $c->name }}</td>
                                <td class="p-3.5 font-mono text-indigo-300">{{ $c->email }}</td>
                                <td class="p-3.5 text-slate-300 max-w-sm whitespace-normal">{{ $c->message }}</td>
                                <td class="p-3.5 text-slate-400">{{ $c->created_at->format('M d, H:i') }}</td>
                                <td class="p-3.5 text-right space-x-1.5">
                                    <button onclick="openReplyModal('contact', {{ $c->id }}, '{{ addslashes($c->name) }}', '{{ addslashes($c->email) }}')" 
                                        class="px-2.5 py-1 bg-indigo-600/30 hover:bg-indigo-600 text-indigo-200 hover:text-white rounded-lg text-[11px] font-semibold border border-indigo-500/30 transition">
                                        ✉️ Reply
                                    </button>
                                    <form action="{{ route('parsa.contact.delete', $c->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete contact submission?');">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1 bg-rose-500/20 hover:bg-rose-500/40 text-rose-300 rounded-lg text-[11px] font-semibold border border-rose-500/30 transition">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-500">No contact inquiries recorded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- TAB 5: CS FEEDBACK TABLE -->
            <div id="tabView-feedbacks" class="hidden space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-slate-900/60 p-4 rounded-2xl border border-slate-800/80">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-lg">
                            💬
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-white uppercase tracking-wider">CS Feedback Directory</h3>
                            <p class="text-[11px] text-slate-400">Total of {{ $feedbacks->count() }} responses & reviews logged</p>
                        </div>
                    </div>
                    <a href="{{ route('parsa.feedback.export_csv') }}" 
                       class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold transition flex items-center justify-center gap-2 shadow-lg shadow-emerald-900/20 shrink-0">
                        <span>📥</span>
                        <span>Export to CSV</span>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="exec-table-header text-xs text-slate-400 uppercase tracking-wider">
                                <th class="p-3.5 rounded-l-xl">Student / Specialist</th>
                                <th class="p-3.5">Star Rating</th>
                                <th class="p-3.5">Feedback Message</th>
                                <th class="p-3.5">Submission Date</th>
                                <th class="p-3.5 rounded-r-xl text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 text-xs">
                            @forelse($feedbacks as $f)
                                <tr class="exec-row hover:bg-slate-900/60 transition" data-searchable="{{ strtolower(($f->student->name ?? 'Student') . ' ' . ($f->feedback ?? $f->comment)) }}">
                                    <td class="p-3.5 font-bold text-white">
                                        <div>{{ $f->student->name ?? 'Campus Specialist' }}</div>
                                        <div class="text-[10px] text-slate-500 font-normal font-mono">{{ $f->email ?? ($f->student->email ?? '') }}</div>
                                    </td>
                                    <td class="p-3.5 text-amber-400 font-bold">★ {{ $f->rating ?? 5 }}/5</td>
                                    <td class="p-3.5 text-slate-300 max-w-sm whitespace-normal">{{ $f->feedback ?? $f->comment }}</td>
                                    <td class="p-3.5 text-slate-400">{{ $f->created_at->format('M d, H:i') }}</td>
                                    <td class="p-3.5 text-right space-x-1.5">
                                        <button onclick="openReplyModal('feedback', {{ $f->id }}, '{{ addslashes($f->student->name ?? 'Student') }}', '{{ addslashes($f->email ?? ($f->student->email ?? '')) }}')" 
                                            class="px-2.5 py-1 bg-indigo-600/30 hover:bg-indigo-600 text-indigo-200 hover:text-white rounded-lg text-[11px] font-semibold border border-indigo-500/30 transition">
                                            ✉️ Reply
                                        </button>
                                        <form action="{{ route('parsa.feedback.delete', $f->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete feedback submission?');">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1 bg-rose-500/20 hover:bg-rose-500/40 text-rose-300 rounded-lg text-[11px] font-semibold border border-rose-500/30 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-slate-500">No CS feedback submissions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- SYSTEM GOVERNANCE & POLICIES CONTROL PANEL -->
        <section class="exec-card rounded-3xl p-6 border border-white/10 shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                <div>
                    <h2 class="text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2">
                        🛡️ System Governance & Security Policies
                    </h2>
                    <p class="text-xs text-slate-400">Live operational controls & active platform policies</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800 flex items-center justify-between">
                    <div>
                        <span class="text-xs text-slate-300 font-bold block">2FA Security</span>
                        <span class="text-[10px] text-emerald-400 font-semibold uppercase">Enforced & Active</span>
                    </div>
                    <span class="text-xl">🔒</span>
                </div>

                <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800 flex items-center justify-between">
                    <div>
                        <span class="text-xs text-slate-300 font-bold block">Guest Chat Mode</span>
                        <span class="text-[10px] text-rose-400 font-semibold uppercase">Disabled (Members Only)</span>
                    </div>
                    <span class="text-xl">🚫</span>
                </div>

                <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800 flex items-center justify-between">
                    <div>
                        <span class="text-xs text-slate-300 font-bold block">Local AI Engine</span>
                        <span class="text-[10px] text-indigo-400 font-semibold uppercase">Ollama Qwen 2.5 Active</span>
                    </div>
                    <span class="text-xl">🤖</span>
                </div>

                <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800 flex items-center justify-between">
                    <div>
                        <span class="text-xs text-slate-300 font-bold block">Rate Limiting</span>
                        <span class="text-[10px] text-amber-400 font-semibold uppercase">5 Requests / Min</span>
                    </div>
                    <span class="text-xl">⏱️</span>
                </div>
            </div>
        </section>

    </div>

    <!-- INLINE EMAIL REPLY MODAL -->
    <div id="replyModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-white/20 p-6 rounded-3xl w-full max-w-md shadow-2xl text-xs space-y-4 animate-page-zoom-in">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    ✉️ Reply to <span id="replyRecipientName" class="text-indigo-400">User</span>
                </h3>
                <button onclick="closeReplyModal()" class="text-slate-400 hover:text-white">✕</button>
            </div>

            <form id="replyForm" method="POST" action="" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-slate-400 mb-1">Recipient Email</label>
                    <input type="text" id="replyRecipientEmail" readonly class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-slate-300 font-mono">
                </div>

                <div>
                    <label class="block text-slate-400 mb-1">Your Email Reply Message</label>
                    <textarea name="reply" rows="5" required placeholder="Type your response here..." class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white placeholder-slate-500 resize-none focus:outline-none focus:border-indigo-500"></textarea>
                </div>

                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="closeReplyModal()" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-xl font-semibold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl shadow-lg">Send Email Reply</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ADMIN ARTICLE DELETION REASON MODAL -->
    <div id="adminDeleteArticleModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-rose-500/30 p-6 rounded-3xl w-full max-w-md shadow-2xl text-xs space-y-4 animate-page-zoom-in">
            <div class="flex items-center justify-between border-b border-rose-500/20 pb-3">
                <h3 class="text-sm font-bold text-rose-400 flex items-center gap-2">
                    <span>🗑️ Admin Delete Article & Notify Author</span>
                </h3>
                <button onclick="closeAdminDeleteArticleModal()" class="text-slate-400 hover:text-white">✕</button>
            </div>

            <form id="adminDeleteArticleForm" method="POST" action="" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-slate-400 mb-1">Target Article Title</label>
                    <input type="text" id="adminDeleteArticleTitle" readonly class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-white font-bold">
                </div>

                <div>
                    <label class="block text-slate-300 font-bold mb-1.5">Select Policy Violation Reason (Sent to Author):</label>
                    <div class="space-y-1.5 text-slate-300">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="reason" value="Violation of Community Guidelines" checked class="text-rose-500">
                            <span>Violation of Community Guidelines</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="reason" value="Inappropriate Content / Spam" class="text-rose-500">
                            <span>Inappropriate Content / Spam</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="reason" value="Copyright / Intellectual Property Violation" class="text-rose-500">
                            <span>Copyright / Intellectual Property Violation</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="reason" value="Unverified Information / Misinformation" class="text-rose-500">
                            <span>Unverified Information / Misinformation</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="reason" value="Other Policy Reason" class="text-rose-500">
                            <span>Other Policy Reason</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-slate-400 mb-1">Additional Policy Details (Optional):</label>
                    <textarea name="custom_reason" rows="3" placeholder="Provide extra explanation for the author (Optional)" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-white resize-none focus:outline-none focus:border-rose-500"></textarea>
                </div>

                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="closeAdminDeleteArticleModal()" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-xl font-semibold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-500 text-white font-bold rounded-xl shadow-lg">Confirm Delete & Notify Author</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ADMIN USER DELETION & CLARIFICATION EMAIL MODAL -->
    <div id="adminDeleteUserModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-rose-500/30 p-6 rounded-3xl w-full max-w-md shadow-2xl text-xs space-y-4 animate-page-zoom-in">
            <div class="flex items-center justify-between border-b border-rose-500/20 pb-3">
                <h3 class="text-sm font-bold text-rose-400 flex items-center gap-2">
                    <span>🗑️ Delete User & Send Clarification Email</span>
                </h3>
                <button onclick="closeAdminDeleteUserModal()" class="text-slate-400 hover:text-white">✕</button>
            </div>

            <form id="adminDeleteUserForm" method="POST" action="" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-slate-400 mb-1">Target User</label>
                    <input type="text" id="adminDeleteUserName" readonly class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-white font-bold">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1">Target Email</label>
                    <input type="text" id="adminDeleteUserEmail" readonly class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-rose-300 font-mono">
                </div>

                <div>
                    <label class="block text-slate-300 font-bold mb-1.5">Select Deletion / Policy Reason (Emailed to User):</label>
                    <div class="space-y-1.5 text-slate-300">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="reason" value="Administrative account cleanup & security policy enforcement" checked class="text-rose-500">
                            <span>Administrative account cleanup & security policy</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="reason" value="Violation of Platform Terms of Service" class="text-rose-500">
                            <span>Violation of Terms of Service</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="reason" value="User Account Inactivity / Audit Purge" class="text-rose-500">
                            <span>Account Inactivity / Audit Purge</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="reason" value="Requested Account Termination" class="text-rose-500">
                            <span>User Requested Account Removal</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="reason" value="Custom Deletion Reason" class="text-rose-500">
                            <span>Custom Deletion Reason</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-slate-400 mb-1">Additional Clarification Details (Optional):</label>
                    <textarea name="custom_reason" rows="3" placeholder="Provide extra clarification explanation for the user (Optional)" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-white resize-none focus:outline-none focus:border-rose-500"></textarea>
                </div>

                <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/30 text-amber-300 text-[11px]">
                    <strong>📧 Notification Note:</strong> A styled HTML clarification email will automatically be sent to <span id="modalTargetEmailText" class="font-mono underline"></span> notifying them of account deletion.
                </div>

                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="closeAdminDeleteUserModal()" class="px-4 py-2 bg-slate-800 text-slate-300 rounded-xl font-semibold">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-500 text-white font-bold rounded-xl shadow-lg">Confirm Delete & Send Email</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ARTICLE READER AUDIT MODAL -->
    <div id="articleReaderModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-white/20 p-6 rounded-3xl w-full max-w-2xl shadow-2xl text-xs space-y-4 animate-page-zoom-in max-h-[85vh] flex flex-col">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3 shrink-0">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span>📖 Article Audit Reader</span>
                </h3>
                <button onclick="closeAdminReadArticleModal()" class="text-slate-400 hover:text-white">✕</button>
            </div>
            <div class="overflow-y-auto space-y-3 flex-1 pr-2">
                <h2 id="readerTitle" class="text-lg font-bold text-indigo-400"></h2>
                <p id="readerMeta" class="text-[11px] text-slate-400 font-mono"></p>
                <div id="readerDeletedNotice" class="hidden p-3 rounded-xl bg-rose-950/60 border border-rose-500/30 text-rose-300 font-mono"></div>
                <div id="readerContent" class="text-slate-200 leading-relaxed text-sm whitespace-pre-wrap pt-2 border-t border-slate-800"></div>
            </div>
            <div class="flex justify-end shrink-0 pt-2 border-t border-slate-800">
                <button onclick="closeAdminReadArticleModal()" class="px-4 py-2 bg-slate-800 text-white font-bold rounded-xl">Close Reader</button>
            </div>
        </div>
    </div>

    <!-- POWER BI CHARTS & INTERACTIVE TAB JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Chart 1: Traffic & Impressions Trend
            const ctx1 = document.getElementById('trafficTrendChart')?.getContext('2d');
            if (ctx1) {
                new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        datasets: [{
                            label: 'Daily Page Impressions',
                            data: [820, 950, 1100, 1340, 1280, 1420, 1580],
                            borderColor: '#6366f1',
                            backgroundColor: 'rgba(99, 102, 241, 0.15)',
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#818cf8',
                            pointRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } },
                            y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } }
                        }
                    }
                });
            }

            // Chart 2: Visited Pages Breakdown
            const ctx2 = document.getElementById('pageDistributionChart')?.getContext('2d');
            if (ctx2) {
                new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: ['Home', 'Chat Portal', 'Sandika', 'Projects', 'Publications', 'Nigma'],
                        datasets: [{
                            data: [1420, 890, 740, 1150, 980, 610],
                            backgroundColor: ['#6366f1', '#a855f7', '#ec4899', '#f59e0b', '#10b981', '#06b6d4'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'right', labels: { color: '#cbd5e1', font: { size: 11 } } }
                        }
                    }
                });
            }

            // Chart 3: Member Signups & Activity
            const ctx3 = document.getElementById('memberActivityChart')?.getContext('2d');
            if (ctx3) {
                new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                        datasets: [{
                            label: 'Chat Messages',
                            data: [120, 240, 310, 480],
                            backgroundColor: '#818cf8',
                            borderRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { display: false }, ticks: { color: '#94a3b8' } },
                            y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } }
                        }
                    }
                });
            }

            // Chart 4: Ratings Breakdown
            const ctx4 = document.getElementById('ratingsBreakdownChart')?.getContext('2d');
            if (ctx4) {
                new Chart(ctx4, {
                    type: 'bar',
                    indexAxis: 'y',
                    data: {
                        labels: ['5 Stars', '4 Stars', '3 Stars', '2 Stars', '1 Star'],
                        datasets: [{
                            label: 'Count',
                            data: [
                                {{ $ratingsBreakdown[5] }},
                                {{ $ratingsBreakdown[4] }},
                                {{ $ratingsBreakdown[3] }},
                                {{ $ratingsBreakdown[2] }},
                                {{ $ratingsBreakdown[1] }}
                            ],
                            backgroundColor: ['#f59e0b', '#fbbf24', '#fcd34d', '#f43f5e', '#e11d48'],
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } },
                            y: { grid: { display: false }, ticks: { color: '#94a3b8' } }
                        }
                    }
                });
            }
        });

        // Tab Switching Logic
        function switchTab(tabName) {
            const btnExportTop = document.getElementById('btnExportFeedbackTop');
            if (btnExportTop) {
                if (tabName === 'feedbacks') {
                    btnExportTop.classList.remove('hidden');
                    btnExportTop.classList.add('flex');
                } else {
                    btnExportTop.classList.add('hidden');
                    btnExportTop.classList.remove('flex');
                }
            }

            ['analytics', 'members', 'articles', 'contacts', 'feedbacks'].forEach(t => {
                const view = document.getElementById('tabView-' + t);
                const btn = document.getElementById('tabBtn-' + t);
                if (t === tabName) {
                    if (view) view.classList.remove('hidden');
                    if (btn) {
                        btn.classList.add('bg-indigo-600', 'text-white');
                        btn.classList.remove('text-slate-400');
                    }
                } else {
                    if (view) view.classList.add('hidden');
                    if (btn) {
                        btn.classList.remove('bg-indigo-600', 'text-white');
                        btn.classList.add('text-slate-400');
                    }
                }
            });
        }

        // Global Table Filtering Logic
        function filterDashboardTables() {
            const query = document.getElementById('dashboard-search')?.value.toLowerCase() || '';
            document.querySelectorAll('.exec-row').forEach(row => {
                const searchData = row.getAttribute('data-searchable') || '';
                if (searchData.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Email Reply Modal Logic
        function openReplyModal(type, id, name, email) {
            const modal = document.getElementById('replyModal');
            const form = document.getElementById('replyForm');
            const recipientName = document.getElementById('replyRecipientName');
            const recipientEmail = document.getElementById('replyRecipientEmail');

            if (recipientName) recipientName.innerText = name;
            if (recipientEmail) recipientEmail.value = email;

            if (type === 'contact') {
                form.action = '/parsa/contact/' + id + '/reply';
            } else {
                form.action = '/parsa/feedback/' + id + '/reply';
            }

            if (modal) modal.classList.remove('hidden');
        }

        function closeReplyModal() {
            const modal = document.getElementById('replyModal');
            if (modal) modal.classList.add('hidden');
        }

        // Admin Article Delete & Policy Reason Modal
        function openAdminDeleteArticleModal(id, title, authorName) {
            const modal = document.getElementById('adminDeleteArticleModal');
            const form = document.getElementById('adminDeleteArticleForm');
            const inputTitle = document.getElementById('adminDeleteArticleTitle');

            if (inputTitle) inputTitle.value = title;
            if (form) form.action = '/parsa/article/' + id + '/delete';
            if (modal) modal.classList.remove('hidden');
        }

        function closeAdminDeleteArticleModal() {
            const modal = document.getElementById('adminDeleteArticleModal');
            if (modal) modal.classList.add('hidden');
        }

        // Admin Article Reader Modal
        async function openAdminReadArticleModal(id) {
            const modal = document.getElementById('articleReaderModal');
            const titleEl = document.getElementById('readerTitle');
            const metaEl = document.getElementById('readerMeta');
            const noticeEl = document.getElementById('readerDeletedNotice');
            const contentEl = document.getElementById('readerContent');

            if (titleEl) titleEl.innerText = 'Loading article...';
            if (contentEl) contentEl.innerText = '';
            if (modal) modal.classList.remove('hidden');

            try {
                const response = await fetch('/parsa/article/' + id);
                const data = await response.json();
                if (data.status === 'success' && data.article) {
                    const art = data.article;
                    if (titleEl) titleEl.innerText = art.title;
                    if (metaEl) metaEl.innerText = 'Author: ' + (art.author ? art.author.name : 'Unknown') + ' | Published: ' + new Date(art.created_at).toLocaleDateString();

                    if (art.deleted_at && noticeEl) {
                        noticeEl.innerHTML = '⚠️ <strong>DELETED ARTICLE RECORD</strong><br>' +
                                             'Deletion Reason: ' + (art.deleted_reason || 'N/A') +
                                             (art.deleted_custom_reason ? '<br>Details: ' + art.deleted_custom_reason : '') +
                                             '<br>Deleted By: ' + (art.deleted_by_admin ? 'Admin Policy Enforcement' : 'Author Self-Deletion');
                        noticeEl.classList.remove('hidden');
                    } else if (noticeEl) {
                        noticeEl.classList.add('hidden');
                    }

                    if (contentEl) contentEl.innerText = art.content;
                }
            } catch (e) {
                console.error(e);
                if (titleEl) titleEl.innerText = 'Error loading article';
            }
        }

        function closeAdminReadArticleModal() {
            const modal = document.getElementById('articleReaderModal');
            if (modal) modal.classList.add('hidden');
        }

        function openDeleteUserModal(userId, userName, userEmail) {
            const modal = document.getElementById('adminDeleteUserModal');
            const form = document.getElementById('adminDeleteUserForm');
            const nameInput = document.getElementById('adminDeleteUserName');
            const emailInput = document.getElementById('adminDeleteUserEmail');
            const targetEmailText = document.getElementById('modalTargetEmailText');

            if (form) form.action = '/parsa/user/' + userId + '/delete';
            if (nameInput) nameInput.value = userName;
            if (emailInput) emailInput.value = userEmail;
            if (targetEmailText) targetEmailText.innerText = userEmail;

            if (modal) modal.classList.remove('hidden');
        }

        function closeAdminDeleteUserModal() {
            const modal = document.getElementById('adminDeleteUserModal');
            if (modal) modal.classList.add('hidden');
        }
    </script>
</body>
</html>
