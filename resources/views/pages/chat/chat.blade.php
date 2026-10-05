<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Chat Portal - Parsa Besharat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind & External App CSS -->
    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">

    <!-- Separate Chat Portal CSS -->
    <link rel="stylesheet" href="{{ asset('css/chat-portal.css') }}">
</head>

<body data-authenticated="{{ $authenticated ? 'true' : 'false' }}" class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-3 lg:p-8 min-h-screen relative overflow-x-hidden">

    <!-- MAIN FLOATING WINDOW CONTAINER (MATCHES HOMEPAGE EXACTLY) -->
    <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[88vh] z-10 transition-all duration-700 shadow-2xl border border-white/10 animate-page-zoom-in">

        @include('top-header-controls')

        <!-- SIDEBAR INTEGRATED INSIDE THE CONTAINER -->
        @include('sidebar')

        <!-- MAIN CHAT CONTENT AREA -->
        <main class="flex-1 flex flex-col overflow-hidden relative p-4 pt-14 lg:p-6 lg:pt-16 justify-between bg-black/20">

            @if (!$authenticated)
                <!-- AUTHENTICATION GATE (NO GUEST MODE) -->
                <div class="flex-1 flex flex-col items-center justify-center p-6 text-center animate-scale-up">
                    <div class="w-20 h-20 mb-4 rounded-full bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 flex items-center justify-center text-3xl shadow-2xl animate-bounce">
                        🔒
                    </div>
                    <h2 class="text-2xl font-extrabold text-white mb-1 tracking-tight">Members Only Chat Portal</h2>
                    <p class="text-xs text-gray-400 max-w-sm mb-6 font-medium">Guest access is disabled. Please log in or create an account with 2FA protection to access the chat portal.</p>

                    <div class="w-full max-w-md bg-black/40 p-6 rounded-3xl border border-white/15 shadow-2xl backdrop-blur-xl animate-fade-in">
                        <!-- Toggle Buttons -->
                        <div class="flex rounded-2xl bg-white/5 p-1 mb-5 text-xs font-semibold">
                            <button id="gateLoginTab" onclick="switchGateTab('login')" class="flex-1 py-2.5 rounded-xl bg-blue-600 text-white shadow-md transition transform active:scale-95">Log In</button>
                            <button id="gateRegisterTab" onclick="switchGateTab('register')" class="flex-1 py-2.5 rounded-xl text-gray-400 hover:text-white transition">Sign Up</button>
                        </div>

                        <!-- Login Form -->
                        <form id="gateLoginForm" method="POST" action="{{ route('login') }}" class="space-y-3.5 text-left text-xs">
                            @csrf
                            <input type="hidden" name="redirect" value="{{ url()->current() }}">
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Email Address</label>
                                <input type="email" name="email" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Password</label>
                                <input type="password" name="password" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-blue-500 transition">
                            </div>
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-xl shadow-lg transition transform active:scale-95">
                                Log In to Chat
                            </button>
                        </form>

                        <!-- Register Form -->
                        <form id="gateRegisterForm" method="POST" action="{{ route('register') }}" class="hidden space-y-3.5 text-left text-xs">
                            @csrf
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Full Name</label>
                                <input type="text" name="name" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Email Address</label>
                                <input type="email" name="email" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Password</label>
                                <input type="password" name="password" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label class="block text-gray-400 mb-1 font-medium">Confirm Password</label>
                                <input type="password" name="password_confirmation" required class="w-full bg-black/50 border border-white/15 rounded-xl px-3.5 py-2.5 text-white focus:outline-none focus:border-blue-500 transition">
                            </div>
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold rounded-xl shadow-lg transition transform active:scale-95">
                                Create Account (with 2FA)
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- AUTHENTICATED CHAT PORTAL CONTENT -->

                <!-- Header Controls Bar (Telegram Style) -->
                <header class="flex items-center justify-between px-4 py-2.5 bg-black/40 border border-white/10 rounded-2xl shrink-0 mb-3 animate-page-slide-down backdrop-blur-md">
                    <div class="flex items-center space-x-3">
                        <button id="btnBackToUsers" onclick="backToUserDirectory()" class="hidden px-3 py-1.5 rounded-full bg-blue-600/80 hover:bg-blue-600 text-white text-xs font-semibold flex items-center space-x-1 shadow-md transition transform hover:scale-105 active:scale-95">
                            <span>← Back</span>
                        </button>
                        
                        <div id="activeContactHeader" onclick="viewActiveContactProfile()" class="flex items-center space-x-3 cursor-pointer group" title="Click to view profile">
                            <div class="relative">
                                <img id="activeContactAvatar" src="{{ $user->avatar_url }}" class="w-10 h-10 rounded-full border border-white/20 object-cover shadow-md group-hover:scale-105 transition-transform">
                                <span id="activeContactDot" class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 rounded-full border-2 border-gray-900 animate-pulse"></span>
                            </div>
                            <div>
                                <h1 class="text-sm font-bold text-white flex items-center gap-1.5 group-hover:text-blue-400 transition-colors">
                                    <span id="activeContactName">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Mitglieder-Verzeichnis' : 'Members Directory' }}</span>
                                    <span id="activeContactUsername" class="text-xs font-normal text-gray-400">(@all)</span>
                                </h1>
                                <p id="activeContactStatus" class="text-[11px] text-indigo-400 font-medium">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Wählen Sie einen Benutzer aus, um zu chatten' : 'Select a user below to start chatting' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-2">
                        <button id="btnCallUser" onclick="startAudioCall()" class="hidden px-3 py-1.5 rounded-full bg-blue-600/80 hover:bg-blue-600 text-white text-xs font-semibold items-center space-x-1 shadow-md transition transform hover:scale-105 active:scale-95">
                            📞 <span>{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Anrufen' : 'Call' }}</span>
                        </button>
                        <button id="btnHeaderProfile" onclick="viewActiveContactProfile()" class="px-3 py-1.5 rounded-full bg-white/10 hover:bg-white/20 text-gray-200 text-xs font-semibold flex items-center space-x-1 transition transform hover:scale-105 active:scale-95">
                            👤 <span id="btnHeaderProfileText">View Profile</span>
                        </button>
                    </div>
                </header>

                <!-- MAIN CHAT BODY CONTAINER -->
                <div id="chatBoxContainer" class="flex-1 flex flex-col overflow-hidden relative rounded-2xl border border-white/10 bg-black/30 backdrop-blur-md">
                    
                    <!-- VIEW 1: USER DIRECTORY DIRECT SCREEN (DEFAULT) -->
                    <div id="userDirectoryScreen" class="flex-1 flex flex-col p-4 overflow-y-auto chat-scroll space-y-4">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pb-3 border-b border-white/10">
                            <div>
                                <h2 class="text-sm font-bold text-white flex items-center gap-2">
                                    <span>👥 MEMBERS DIRECTORY & ACTIVE CHATS</span>
                                </h2>
                                <p class="text-xs text-gray-400">Click any user to initiate a direct chat session</p>
                            </div>
                            <input type="text" id="searchUsersInput" onkeyup="filterUsersDirectory()" placeholder="🔍 Search members..." 
                                class="w-full sm:w-64 bg-black/50 border border-white/15 rounded-xl px-3.5 py-1.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-blue-500">
                        </div>

                        <div id="mainUsersGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                            <!-- JS dynamically injects member cards -->
                        </div>
                    </div>

                    <!-- VIEW 2: ACTIVE DIRECT CHAT SCREEN (HIDDEN UNTIL USER CLICKED) -->
                    <div id="activeChatScreen" class="hidden flex-1 flex flex-col overflow-hidden">
                        
                        <div id="messageStream" class="flex-1 p-4 overflow-y-auto space-y-3 chat-scroll">
                            <div id="loadingIndicator" class="text-center py-12 text-gray-400 text-xs flex items-center justify-center space-x-2">
                                <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                <span>Loading conversation...</span>
                            </div>
                        </div>

                        <!-- Voice Note Recording Bar -->
                        <div id="voiceRecorderBar" class="hidden px-4 py-2 bg-rose-950/90 border-t border-rose-500/30 flex items-center justify-between text-xs animate-scale-up">
                            <div class="flex items-center space-x-3">
                                <span class="w-3 h-3 rounded-full bg-rose-500 animate-ping"></span>
                                <span class="font-semibold text-rose-300">Recording Voice Note...</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button onclick="cancelVoiceRecording()" class="px-2.5 py-1 bg-gray-800 rounded-lg text-gray-300">Cancel</button>
                                <button onclick="stopAndSendVoiceRecording()" class="px-3 py-1 bg-rose-600 font-semibold rounded-lg text-white">Send Voice</button>
                            </div>
                        </div>

                        <!-- Upload Progress Bar -->
                        <div id="uploadProgressBarContainer" class="hidden px-4 py-2 bg-blue-950/80 border-t border-blue-500/30 animate-fade-in">
                            <div class="flex items-center justify-between text-xs text-blue-300 mb-1">
                                <span id="uploadStatusText">Uploading file (up to 4GB)...</span>
                                <span id="uploadPercentText">0%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-1.5 overflow-hidden">
                                <div id="uploadProgressBar" class="bg-blue-500 h-1.5 rounded-full w-0 transition-all duration-200"></div>
                            </div>
                        </div>

                        <!-- Input Bar -->
                        <div class="p-3 bg-black/40 border-t border-white/10 flex flex-col space-y-2 shrink-0">
                            <div class="flex items-center justify-between px-1 text-xs">
                                <div class="flex items-center space-x-2">
                                    <button type="button" onclick="toggleEmojiPicker()" class="p-1.5 hover:bg-white/10 rounded-full text-gray-300 hover:text-amber-400 transition transform hover:scale-110" title="Add Emojis">😊</button>
                                    <button type="button" onclick="toggleGifPicker()" class="p-1.5 hover:bg-white/10 rounded-full text-gray-300 hover:text-purple-400 font-bold transition transform hover:scale-110" title="Attach GIF">GIF</button>
                                    <label class="p-1.5 hover:bg-white/10 rounded-full text-gray-300 hover:text-blue-400 cursor-pointer transition transform hover:scale-110" title="Attach File (Up to 4GB)">
                                        📎
                                        <input type="file" id="fileAttachmentInput" onchange="handleFileSelect(event)" class="hidden">
                                    </label>
                                    <button type="button" onclick="startVoiceRecording()" class="p-1.5 hover:bg-white/10 rounded-full text-gray-300 hover:text-rose-400 transition transform hover:scale-110" title="Record Voice Note">🎙️</button>
                                    <button type="button" onclick="openVideoNoteModal()" class="p-1.5 hover:bg-white/10 rounded-full text-gray-300 hover:text-emerald-400 transition transform hover:scale-110" title="Record Video Note">📹</button>
                                    <button id="btnScheduleMsg" type="button" onclick="toggleScheduleModal()" class="p-1.5 rounded-full text-gray-400 opacity-50 cursor-not-allowed transition transform hover:scale-110" title="Type a message first to schedule" disabled>⏱️</button>
                                </div>

                                <div id="scheduledNotice" class="hidden text-amber-300 font-mono text-[11px] flex items-center gap-1">
                                    <span>Scheduled:</span><span id="scheduledTimeLabel"></span>
                                    <button onclick="clearSchedule()" class="text-rose-400 font-bold">×</button>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <textarea id="chatInput" rows="1" placeholder="Type a message..."
                                    oninput="if(window.autoResizeInput) autoResizeInput(this); updateInputControlsState();"
                                    onkeydown="if(window.handleKeyPress) handleKeyPress(event);"
                                    class="flex-1 bg-white/5 border border-white/15 rounded-2xl px-4 py-2.5 text-white placeholder-gray-400 text-sm focus:outline-none focus:border-blue-500 resize-none chat-scroll transition duration-200"></textarea>
                                
                                <button id="sendMsgBtn" type="button" onclick="if(window.dispatchMessage) dispatchMessage();" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-2xl text-xs shadow-lg flex items-center space-x-1.5 transition transform active:scale-95 hover:scale-105">
                                    <span>Send</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </main>

    </div>

    <!-- NOTIFICATION TOAST POPUP (WITH SENDER AVATAR & PREVIEW) -->
    <div id="toastNotification" class="hidden fixed top-6 right-6 z-50 p-3.5 bg-gray-900/95 border border-blue-500/40 rounded-2xl shadow-2xl flex items-center space-x-3 text-xs w-80 animate-toast">
        <img id="toastAvatar" src="{{ asset('images/default-avatar.svg') }}" class="w-10 h-10 rounded-full border border-blue-400 object-cover">
        <div class="overflow-hidden flex-1">
            <h4 id="toastSender" class="font-bold text-white truncate">New Message</h4>
            <p id="toastMessage" class="text-gray-300 truncate text-[11px]">Preview...</p>
        </div>
        <button onclick="hideToastNotification()" class="text-gray-400 hover:text-white text-xs">✕</button>
    </div>

    <!-- USER PROFILE CUSTOMIZER MODAL -->
    @if ($authenticated)
        <div id="profileModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
            <div class="bg-gray-900 border border-white/20 p-6 rounded-3xl w-full max-w-md shadow-2xl text-xs chat-scroll max-h-[90vh] overflow-y-auto animate-scale-up space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <span>👤 Profile Settings & Customizer</span>
                    </h3>
                    <button onclick="toggleProfileModal()" class="text-gray-400 hover:text-white">✕</button>
                </div>

                <form id="profileForm" onsubmit="saveProfileSettings(event)" class="space-y-4">
                    <!-- HEADER BANNER PREVIEW & UPLOAD SECTION -->
                    <div class="relative w-full h-28 rounded-2xl overflow-hidden bg-gradient-to-r from-indigo-900 via-purple-900 to-slate-900 border border-white/10 group">
                        <img id="profileHeaderPreview" src="{{ $user->header_banner ? asset($user->header_banner) : '' }}" 
                            class="w-full h-full object-cover {{ $user->header_banner ? '' : 'hidden' }}">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <label class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 rounded-xl font-semibold text-white cursor-pointer transition text-[11px] shadow-lg">
                                🖼️ Change Cover Banner
                                <input type="file" name="header_banner" accept="image/*" onchange="previewHeaderImage(event)" class="hidden">
                            </label>
                        </div>
                        <span class="absolute top-2 left-2 px-2 py-0.5 rounded-md bg-black/60 backdrop-blur-sm text-[9px] text-gray-300 font-mono">Profile Header</span>
                    </div>

                    <!-- AVATAR & NAME SECTION -->
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

                    <!-- MULTIPLE PROFILE AVATARS GALLERY -->
                    @php
                        $avatarsGallery = is_array($user->avatars_gallery) ? $user->avatars_gallery : [];
                        if ($user->avatar && !in_array($user->avatar, $avatarsGallery)) {
                            $avatarsGallery[] = $user->avatar;
                        }
                    @endphp
                    <div class="space-y-1.5 pt-2 border-t border-white/10">
                        <div class="flex items-center justify-between">
                            <label class="font-bold text-gray-300">🖼️ My Profile Avatars Gallery ({{ count($avatarsGallery) }})</label>
                            <label class="px-2.5 py-1 bg-blue-600/40 hover:bg-blue-600 border border-blue-500/40 text-blue-200 hover:text-white rounded-lg text-[10px] font-bold cursor-pointer transition">
                                + Batch Add Avatars
                                <input type="file" name="multiple_avatars[]" multiple accept="image/*" onchange="document.getElementById('profileForm').requestSubmit()" class="hidden">
                            </label>
                        </div>
                        @if(count($avatarsGallery) > 0)
                            <div class="flex flex-wrap gap-2 pt-1 max-h-24 overflow-y-auto chat-scroll">
                                @foreach($avatarsGallery as $avPath)
                                    <div class="relative group border-2 {{ $user->avatar === $avPath ? 'border-blue-500 scale-105' : 'border-transparent' }} rounded-full overflow-hidden transition">
                                        <img src="{{ asset($avPath) }}" onclick="selectAvatarFromGallery('{{ addslashes($avPath) }}')" class="w-10 h-10 rounded-full object-cover cursor-pointer hover:opacity-80">
                                        <button type="button" onclick="deleteAvatarFromGallery('{{ addslashes($avPath) }}')" class="absolute inset-0 bg-red-600/80 text-white text-[9px] font-bold flex items-center justify-center opacity-0 group-hover:opacity-100 transition">✕</button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-[10px] text-gray-500 italic">No saved avatars yet. Upload photos to build your avatar gallery.</p>
                        @endif
                    </div>

                    <!-- MULTIPLE PROFILE HEADERS GALLERY -->
                    @php
                        $headersGallery = is_array($user->headers_gallery) ? $user->headers_gallery : [];
                        if ($user->header_banner && !in_array($user->header_banner, $headersGallery)) {
                            $headersGallery[] = $user->header_banner;
                        }
                    @endphp
                    <div class="space-y-1.5 pt-2 border-t border-white/10">
                        <div class="flex items-center justify-between">
                            <label class="font-bold text-gray-300">🌄 My Cover Headers Gallery ({{ count($headersGallery) }})</label>
                            <label class="px-2.5 py-1 bg-indigo-600/40 hover:bg-indigo-600 border border-indigo-500/40 text-indigo-200 hover:text-white rounded-lg text-[10px] font-bold cursor-pointer transition">
                                + Batch Add Headers
                                <input type="file" name="multiple_headers[]" multiple accept="image/*" onchange="document.getElementById('profileForm').requestSubmit()" class="hidden">
                            </label>
                        </div>
                        @if(count($headersGallery) > 0)
                            <div class="flex flex-wrap gap-2 pt-1 max-h-24 overflow-y-auto chat-scroll">
                                @foreach($headersGallery as $headPath)
                                    <div class="relative group border-2 {{ $user->header_banner === $headPath ? 'border-indigo-500 scale-105' : 'border-transparent' }} rounded-xl overflow-hidden transition">
                                        <img src="{{ asset($headPath) }}" onclick="selectHeaderFromGallery('{{ addslashes($headPath) }}')" class="w-20 h-10 rounded-lg object-cover cursor-pointer hover:opacity-80">
                                        <button type="button" onclick="deleteHeaderFromGallery('{{ addslashes($headPath) }}')" class="absolute inset-0 bg-red-600/80 text-white text-[9px] font-bold flex items-center justify-center opacity-0 group-hover:opacity-100 transition">✕ Remove</button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-[10px] text-gray-500 italic">No saved cover headers yet. Upload images to build your header gallery.</p>
                        @endif
                    </div>

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
                        <label class="block text-gray-400 mb-1">Bio / About You <span class="text-[10px] text-gray-500 font-normal">(Optional)</span></label>
                        <textarea name="bio" rows="2" placeholder="Tell us about yourself (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-2 text-white resize-none">{{ $user->bio }}</textarea>
                    </div>

                    <!-- PRIVACY & VISIBILITY CONTROLS -->
                    <div class="space-y-2 pt-2 border-t border-white/10">
                        <label class="block font-bold text-gray-300">🛡️ Account Privacy & Content Settings</label>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-gray-400 text-[10px] mb-1">Account Visibility</label>
                                <select name="account_privacy" class="w-full bg-black/40 border border-white/20 rounded-xl px-2.5 py-1.5 text-white">
                                    <option value="public" {{ $user->account_privacy === 'public' ? 'selected' : '' }}>🌐 Public (Everyone)</option>
                                    <option value="private" {{ $user->account_privacy === 'private' ? 'selected' : '' }}>🔒 Private (Approval Required)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-[10px] mb-1">Default Story Privacy</label>
                                <select name="story_privacy" class="w-full bg-black/40 border border-white/20 rounded-xl px-2.5 py-1.5 text-white">
                                    <option value="public" {{ $user->story_privacy === 'public' ? 'selected' : '' }}>🌐 Everyone</option>
                                    <option value="followers" {{ $user->story_privacy === 'followers' ? 'selected' : '' }}>👥 Followers Only</option>
                                    <option value="private" {{ $user->story_privacy === 'private' ? 'selected' : '' }}>🔒 Only Me</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2 pt-2 border-t border-white/10">
                        <label class="block font-bold text-gray-300">Social Media Links <span class="text-[10px] text-gray-500 font-normal">(Optional)</span></label>
                        <input type="text" name="social_linkedin" value="{{ $user->social_links['linkedin'] ?? '' }}" placeholder="LinkedIn URL / Handle (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-1.5 text-white">
                        <input type="text" name="social_github" value="{{ $user->social_links['github'] ?? '' }}" placeholder="GitHub URL / Handle (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-1.5 text-white">
                        <input type="text" name="social_twitter" value="{{ $user->social_links['twitter'] ?? '' }}" placeholder="Twitter / X URL / Handle (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-1.5 text-white">
                        <input type="text" name="social_website" value="{{ $user->social_links['website'] ?? '' }}" placeholder="Website URL (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-1.5 text-white">
                    </div>

                    <!-- MY PUBLISHED ARTICLES MANAGEMENT SECTION -->
                    @php
                        $userArticles = \App\Models\BlogPost::where('author_id', Auth::id())->orderBy('created_at', 'desc')->get();
                    @endphp
                    <div class="space-y-2 pt-3 border-t border-white/10">
                        <label class="block font-bold text-gray-300 flex items-center justify-between">
                            <span>✍️ My Published Articles ({{ $userArticles->count() }})</span>
                            <a href="/blog" class="text-[10px] text-blue-400 hover:underline">+ Write New</a>
                        </label>

                        @if($userArticles->count() > 0)
                            <div class="space-y-2 max-h-36 overflow-y-auto chat-scroll pr-1">
                                @foreach($userArticles as $art)
                                    <div class="p-2 bg-black/50 border border-white/10 rounded-xl flex items-center justify-between gap-2 text-xs">
                                        <div class="overflow-hidden flex-1">
                                            <p class="font-semibold text-white truncate">{{ $art->title }}</p>
                                            <p class="text-[10px] text-gray-400 font-mono">{{ $art->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div class="flex items-center space-x-1 shrink-0">
                                            <button type="button" onclick="openEditArticleModal({{ $art->id }}, '{{ addslashes($art->title) }}', '{{ addslashes(str_replace(["\r", "\n"], [' ', ' '], $art->content)) }}')" 
                                                class="px-2 py-0.5 bg-blue-600/50 hover:bg-blue-600 rounded text-[10px] font-semibold text-white transition">
                                                Edit
                                            </button>
                                            <button type="button" onclick="deleteUserArticle({{ $art->id }})" 
                                                class="px-2 py-0.5 bg-rose-600/50 hover:bg-rose-600 rounded text-[10px] font-semibold text-rose-200 transition">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-[11px] text-gray-400 italic">No published articles yet.</p>
                        @endif
                    </div>

                    <!-- TWITTER / X STYLE USER POSTS COMPOSER & FEED SECTION -->
                    <div class="space-y-3 pt-3 border-t border-white/10">
                        <label class="block font-bold text-white flex items-center justify-between text-xs">
                            <span>🐦 My Twitter / X Profile Feed</span>
                            <span class="text-[10px] text-gray-400 font-mono">Publish thoughts, photos & videos</span>
                        </label>

                        <!-- POST COMPOSER BOX -->
                        <div class="p-3 bg-black/50 border border-white/15 rounded-2xl space-y-2">
                            <textarea id="myPostContent" rows="2" placeholder="What's happening? Post your thoughts, images, or videos..." 
                                class="w-full bg-white/5 border border-white/10 rounded-xl p-2.5 text-white text-xs placeholder-gray-500 focus:outline-none focus:border-blue-500 resize-none"></textarea>
                            
                            <div class="flex items-center justify-between pt-1">
                                <label class="px-2.5 py-1 bg-white/10 hover:bg-white/20 text-gray-300 rounded-lg text-[10px] font-semibold cursor-pointer transition flex items-center gap-1">
                                    <span>📷 Attach Image / Video</span>
                                    <input type="file" id="myPostMedia" accept="image/*,video/*" class="hidden" onchange="document.getElementById('postMediaSelectedText').innerText = this.files[0]?.name || ''">
                                </label>
                                <span id="postMediaSelectedText" class="text-[9px] text-amber-400 font-mono truncate max-w-[120px]"></span>

                                <button type="button" onclick="submitMyUserPost(event)" class="px-4 py-1.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-xl text-xs shadow-md transition transform active:scale-95">
                                    Post ➔
                                </button>
                            </div>
                        </div>

                        <!-- USER POSTS FEED -->
                        <div id="myUserPostsFeed" class="space-y-2 max-h-48 overflow-y-auto chat-scroll pr-1">
                            <!-- Dynamic user posts loaded via JS -->
                        </div>
                    </div>

                    <!-- ACCOUNT DELETION DANGER ZONE -->
                    <div class="space-y-2 pt-3 border-t border-rose-500/20">
                        <label class="block font-bold text-rose-400">⚠️ Account Deletion Danger Zone</label>
                        <p class="text-[11px] text-gray-400">Deleting your account will remove your profile, published articles, and messages from public view.</p>
                        <button type="button" onclick="openDeleteAccountModal()" class="w-full py-2 bg-rose-950/80 hover:bg-rose-900 text-rose-300 text-xs font-bold rounded-xl border border-rose-500/40 transition">
                            Delete My Account Completely
                        </button>
                    </div>

                    <div class="flex justify-end space-x-2 pt-3">
                        <button type="button" onclick="toggleProfileModal()" class="px-4 py-2 bg-gray-800 rounded-xl text-gray-300">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- PUBLIC USER PROFILE INSPECTOR MODAL (TWITTER/X & INSTAGRAM HYBRID) -->
        <div id="publicUserProfileModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
            <div class="bg-gray-900 border border-white/20 rounded-3xl w-full max-w-md shadow-2xl text-xs chat-scroll max-h-[90vh] overflow-y-auto animate-scale-up space-y-4 p-5 relative">
                <button onclick="closePublicProfileModal()" class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-black/60 text-gray-300 hover:text-white flex items-center justify-center backdrop-blur-sm">✕</button>

                <!-- COVER BANNER & AVATAR -->
                <div class="relative w-full h-28 rounded-2xl overflow-hidden bg-gradient-to-r from-indigo-900 via-purple-900 to-slate-900 border border-white/10">
                    <img id="publicHeaderBanner" src="" class="w-full h-full object-cover hidden">
                </div>

                <div class="flex items-end justify-between -mt-10 px-2 relative z-10">
                    <img id="publicAvatarImg" src="" class="w-20 h-20 rounded-full border-4 border-gray-900 object-cover shadow-2xl">
                    <div class="flex items-center space-x-2">
                        <a id="publicFullProfilePageBtn" href="#" target="_blank" class="px-3 py-2 rounded-xl text-xs font-bold shadow-lg transition bg-white/10 hover:bg-white/20 text-gray-200 flex items-center gap-1">
                            🔗 Full Profile
                        </a>
                        <button id="publicFollowBtn" onclick="toggleFollowUserPublic()" class="px-4 py-2 rounded-xl text-xs font-bold shadow-lg transition bg-blue-600 hover:bg-blue-500 text-white">
                            + Follow
                        </button>
                    </div>
                </div>

                <!-- USER INFO -->
                <div class="px-2 space-y-1">
                    <h3 id="publicUserName" class="text-base font-bold text-white flex items-center gap-1.5">User Name</h3>
                    <p id="publicUserHandle" class="text-xs text-gray-400 font-mono">@username</p>
                    <p id="publicUserBio" class="text-xs text-gray-300 pt-1 leading-relaxed"></p>
                </div>

                <!-- INSTAGRAM STYLE STATS COUNTERS -->
                <div class="grid grid-cols-3 gap-2 p-3 bg-black/40 border border-white/10 rounded-2xl text-center font-mono">
                    <div>
                        <span id="publicPostsCount" class="block font-bold text-white text-sm">0</span>
                        <span class="text-[9px] text-gray-400 uppercase">Posts</span>
                    </div>
                    <div>
                        <span id="publicFollowersCount" class="block font-bold text-white text-sm">0</span>
                        <span class="text-[9px] text-gray-400 uppercase">Followers</span>
                    </div>
                    <div>
                        <span id="publicFollowingCount" class="block font-bold text-white text-sm">0</span>
                        <span class="text-[9px] text-gray-400 uppercase">Following</span>
                    </div>
                </div>

                <!-- TWITTER / X POSTS FEED -->
                <div class="space-y-3 pt-2 border-t border-white/10">
                    <h4 class="font-bold text-white text-xs flex items-center justify-between">
                        <span>🐦 Posts & Activity Feed</span>
                    </h4>
                    <div id="publicUserPostsFeed" class="space-y-3">
                        <!-- User posts loaded via JS -->
                    </div>
                </div>
            </div>
        </div>

        <!-- EDIT ARTICLE MODAL -->
        <div id="editArticleModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
            <div class="bg-gray-900 border border-white/20 p-5 rounded-3xl w-full max-w-md shadow-2xl text-xs space-y-3 animate-scale-up">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-white">✍️ Edit Published Article</h3>
                    <button onclick="closeEditArticleModal()" class="text-gray-400 hover:text-white">✕</button>
                </div>
                <form id="editArticleForm" onsubmit="submitArticleEdit(event)" class="space-y-3">
                    <input type="hidden" id="editArticleId">
                    <div>
                        <label class="block text-gray-400 mb-1">Article Title</label>
                        <input type="text" id="editArticleTitle" required class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-2 text-white">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-1">Article Content</label>
                        <textarea id="editArticleContent" rows="6" required class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-2 text-white resize-none"></textarea>
                    </div>
                    <div class="flex justify-end space-x-2 pt-2">
                        <button type="button" onclick="closeEditArticleModal()" class="px-4 py-2 bg-gray-800 rounded-xl text-gray-300">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl">Save Article</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ACCOUNT SELF DELETION SURVEY MODAL -->
        <div id="deleteAccountModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
            <div class="bg-gray-900 border border-rose-500/30 p-6 rounded-3xl w-full max-w-md shadow-2xl text-xs space-y-4 animate-scale-up">
                <div class="flex items-center justify-between border-b border-rose-500/20 pb-3">
                    <h3 class="text-sm font-bold text-rose-400 flex items-center gap-2">
                        <span>⚠️ Delete Account & All Content</span>
                    </h3>
                    <button onclick="closeDeleteAccountModal()" class="text-gray-400 hover:text-white">✕</button>
                </div>

                <div class="p-3 rounded-xl bg-rose-950/60 border border-rose-500/30 text-rose-200 leading-relaxed text-[11px]">
                    <strong>Warning:</strong> Deleting your account will immediately remove your profile, login access, published articles, and messages from public view.
                </div>

                <form id="deleteAccountForm" onsubmit="submitAccountDeletion(event)" class="space-y-3">
                    <div>
                        <label class="block font-bold text-gray-300 mb-2">Please tell us why you are deleting your account:</label>
                        <div class="space-y-1.5 text-gray-300">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="deletion_reason" value="No longer need the service" checked class="text-rose-600">
                                <span>No longer using the platform</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="deletion_reason" value="Privacy & data concerns" class="text-rose-600">
                                <span>Privacy & data removal concerns</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="deletion_reason" value="Creating a new account" class="text-rose-600">
                                <span>Creating a new profile/account</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="deletion_reason" value="Found alternative service" class="text-rose-600">
                                <span>Found another alternative service</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="deletion_reason" value="Other reason" class="text-rose-600">
                                <span>Other reason</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-400 mb-1">Additional details (Optional):</label>
                        <textarea id="deletionCustomReason" rows="2" placeholder="Help us improve (Optional)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-2 text-white resize-none"></textarea>
                    </div>

                    <div class="flex justify-end space-x-2 pt-2">
                        <button type="button" onclick="closeDeleteAccountModal()" class="px-4 py-2 bg-gray-800 rounded-xl text-gray-300">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-500 text-white font-bold rounded-xl shadow-lg">Confirm Account Deletion</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- ADD INSTAGRAM STORY MODAL -->
    <div id="addStoryModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-5 rounded-3xl w-full max-w-sm shadow-2xl text-xs space-y-3 animate-scale-up">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-white">📸 Post 24-Hour Story</h3>
                <button onclick="toggleAddStoryModal()" class="text-gray-400 hover:text-white">✕</button>
            </div>
            <form id="storyForm" onsubmit="submitStory(event)" class="space-y-3">
                <div>
                    <label class="block text-gray-400 mb-1">Story Type</label>
                    <select name="story_type" id="storyTypeSelect" onchange="toggleStoryTypeFields(this.value)" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-2 text-white">
                        <option value="standard">📸 Standard Story (Photo / Text)</option>
                        <option value="countdown">⏳ Countdown Event Story</option>
                        <option value="poll">📊 Interactive Poll Story</option>
                    </select>
                </div>

                <div id="countdownTargetContainer" class="hidden space-y-1">
                    <label class="block text-amber-400 font-bold text-[10px]">Countdown Target Date & Time</label>
                    <input type="datetime-local" name="countdown_target_at" class="w-full bg-black/40 border border-amber-500/40 rounded-xl px-3 py-2 text-white font-mono">
                </div>

                <div>
                    <label class="block text-gray-400 mb-1">Story Caption / Message</label>
                    <textarea name="content" rows="3" placeholder="What's on your mind?..." class="w-full bg-black/40 border border-white/20 rounded-xl p-3 text-white focus:outline-none focus:border-blue-500 resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-gray-400 mb-1">Optional Photo/Media</label>
                    <input type="file" name="media" accept="image/*,video/*" class="w-full bg-black/40 border border-white/20 rounded-xl p-2 text-white">
                </div>

                <div>
                    <label class="block text-gray-400 mb-1">Story Audience Privacy</label>
                    <select name="privacy" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-1.5 text-white">
                        <option value="public">🌐 Public (Everyone)</option>
                        <option value="followers">👥 Followers Only</option>
                        <option value="private">🔒 Private (Only Me)</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="toggleAddStoryModal()" class="px-3 py-1.5 bg-gray-800 text-gray-300 rounded-xl">Cancel</button>
                    <button type="submit" class="px-4 py-1.5 bg-blue-600 hover:bg-blue-500 font-bold text-white rounded-xl shadow-lg">Post Story</button>
                </div>
            </form>
        </div>
    </div>

    <!-- INSTAGRAM STORY PLAYER OVERLAY MODAL -->
    <div id="instagramStoryPlayerModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-xl z-50 flex items-center justify-center p-4">
        <div class="relative w-full max-w-sm bg-gray-900 border border-white/20 rounded-3xl overflow-hidden shadow-2xl animate-scale-up flex flex-col h-[75vh]">
            <!-- TOP CONTROLS & USER INFO -->
            <div class="p-3 bg-gradient-to-b from-black/80 to-transparent flex items-center justify-between z-20 shrink-0">
                <div class="flex items-center space-x-2">
                    <img id="storyPlayerUserAvatar" src="" class="w-8 h-8 rounded-full border border-amber-400 object-cover">
                    <div>
                        <span id="storyPlayerUserName" class="text-xs font-bold text-white block">User</span>
                        <span id="storyPlayerTime" class="text-[9px] text-gray-400 font-mono">Just now</span>
                    </div>
                </div>
                <button onclick="closeStoryPlayerModal()" class="text-gray-300 hover:text-white font-bold text-sm p-1">✕</button>
            </div>

            <!-- STORY PLAYER BODY & COUNTDOWN WIDGET -->
            <div id="storyPlayerBody" class="flex-1 p-4 flex flex-col justify-center relative overflow-y-auto chat-scroll z-10">
                <!-- Dynamic Story Content Injected Here -->
            </div>

            <!-- TAP LEFT / RIGHT TOUCH NAVIGATION AREAS -->
            <div onclick="prevStory()" class="absolute left-0 top-12 bottom-0 w-1/3 z-20 cursor-pointer"></div>
            <div onclick="nextStory()" class="absolute right-0 top-12 bottom-0 w-1/3 z-20 cursor-pointer"></div>

            <!-- BOTTOM NAVIGATION ARROWS -->
            <div class="p-3 bg-black/60 border-t border-white/10 flex items-center justify-between z-30 shrink-0 text-xs font-bold text-white">
                <button onclick="prevStory()" class="px-3 py-1 bg-white/10 hover:bg-white/20 rounded-xl">◀ Prev</button>
                <span class="text-[10px] text-gray-400 font-mono">Instagram Story</span>
                <button onclick="nextStory()" class="px-3 py-1 bg-blue-600 hover:bg-blue-500 rounded-xl">Next ▶</button>
            </div>
        </div>
    </div>

    <!-- EMOJI PICKER MODAL -->
    <div id="emojiPicker" class="hidden fixed bottom-24 left-6 md:left-72 z-50 p-3.5 bg-gray-900/95 border border-white/20 rounded-3xl shadow-2xl w-80 max-h-80 flex flex-col space-y-2.5 animate-scale-up backdrop-blur-xl">
        <div class="flex items-center justify-between border-b border-white/10 pb-2">
            <span class="text-xs font-bold text-gray-200 flex items-center gap-1.5">
                <span>😊 Emojis Library</span>
            </span>
            <button onclick="toggleEmojiPicker()" class="text-gray-400 hover:text-white text-xs font-bold px-1.5 py-0.5 rounded-lg hover:bg-white/10">✕</button>
        </div>
        <div id="emojiPickerGrid" class="flex-1 overflow-y-auto chat-scroll grid grid-cols-7 gap-1.5 text-xl p-1 max-h-56">
            <!-- Smileys & Emotions -->
            <button type="button" onclick="addEmoji('😊')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">😊</button>
            <button type="button" onclick="addEmoji('😂')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">😂</button>
            <button type="button" onclick="addEmoji('🤣')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🤣</button>
            <button type="button" onclick="addEmoji('😍')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">😍</button>
            <button type="button" onclick="addEmoji('🥰')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🥰</button>
            <button type="button" onclick="addEmoji('😎')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">😎</button>
            <button type="button" onclick="addEmoji('🤩')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🤩</button>
            <button type="button" onclick="addEmoji('🥳')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🥳</button>
            <button type="button" onclick="addEmoji('😏')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">😏</button>
            <button type="button" onclick="addEmoji('😜')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">😜</button>
            <button type="button" onclick="addEmoji('🤔')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🤔</button>
            <button type="button" onclick="addEmoji('🧐')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🧐</button>
            <button type="button" onclick="addEmoji('🤯')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🤯</button>
            <button type="button" onclick="addEmoji('😭')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">😭</button>
            <button type="button" onclick="addEmoji('😱')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">😱</button>
            <button type="button" onclick="addEmoji('😈')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">😈</button>

            <!-- Gestures & Hands -->
            <button type="button" onclick="addEmoji('👍')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">👍</button>
            <button type="button" onclick="addEmoji('👎')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">👎</button>
            <button type="button" onclick="addEmoji('👏')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">👏</button>
            <button type="button" onclick="addEmoji('🙌')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🙌</button>
            <button type="button" onclick="addEmoji('🙏')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🙏</button>
            <button type="button" onclick="addEmoji('🤝')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🤝</button>
            <button type="button" onclick="addEmoji('✌️')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">✌️</button>
            <button type="button" onclick="addEmoji('🤞')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🤞</button>
            <button type="button" onclick="addEmoji('🤟')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🤟</button>
            <button type="button" onclick="addEmoji('👌')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">👌</button>
            <button type="button" onclick="addEmoji('🤌')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🤌</button>
            <button type="button" onclick="addEmoji('👈')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">👈</button>
            <button type="button" onclick="addEmoji('👉')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">👉</button>
            <button type="button" onclick="addEmoji('💪')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">💪</button>

            <!-- Hearts & Symbols -->
            <button type="button" onclick="addEmoji('❤️')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">❤️</button>
            <button type="button" onclick="addEmoji('💖')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">💖</button>
            <button type="button" onclick="addEmoji('💙')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">💙</button>
            <button type="button" onclick="addEmoji('💜')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">💜</button>
            <button type="button" onclick="addEmoji('🖤')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🖤</button>
            <button type="button" onclick="addEmoji('🤍')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🤍</button>
            <button type="button" onclick="addEmoji('🔥')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🔥</button>
            <button type="button" onclick="addEmoji('✨')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">✨</button>
            <button type="button" onclick="addEmoji('🌟')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🌟</button>
            <button type="button" onclick="addEmoji('💯')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">💯</button>
            <button type="button" onclick="addEmoji('🎉')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🎉</button>
            <button type="button" onclick="addEmoji('🚀')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🚀</button>
            <button type="button" onclick="addEmoji('💡')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">💡</button>
            <button type="button" onclick="addEmoji('👑')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">👑</button>

            <!-- Tech, Activities & Fun -->
            <button type="button" onclick="addEmoji('💎')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">💎</button>
            <button type="button" onclick="addEmoji('🎯')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🎯</button>
            <button type="button" onclick="addEmoji('🏆')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🏆</button>
            <button type="button" onclick="addEmoji('💰')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">💰</button>
            <button type="button" onclick="addEmoji('🤖')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🤖</button>
            <button type="button" onclick="addEmoji('💻')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">💻</button>
            <button type="button" onclick="addEmoji('📱')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">📱</button>
            <button type="button" onclick="addEmoji('🎮')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🎮</button>
            <button type="button" onclick="addEmoji('☕')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">☕</button>
            <button type="button" onclick="addEmoji('🍺')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🍺</button>
            <button type="button" onclick="addEmoji('🍕')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🍕</button>
            <button type="button" onclick="addEmoji('🍟')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🍟</button>
            <button type="button" onclick="addEmoji('🍔')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">🍔</button>
            <button type="button" onclick="addEmoji('⚔️')" class="hover:scale-125 transition p-1 rounded hover:bg-white/10">⚔️</button>
        </div>
    </div>

    <!-- GIF PICKER -->
    <div id="gifPicker" class="hidden fixed bottom-24 left-10 md:left-72 z-50 p-4 bg-gray-900 border border-white/20 rounded-2xl shadow-2xl w-72 animate-scale-up">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-bold text-gray-300">Choose GIF</span>
            <button onclick="toggleGifPicker()" class="text-gray-400 hover:text-white text-xs">✕</button>
        </div>
        <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto chat-scroll">
            <img src="https://media.giphy.com/media/26bgQ8u0e1bBf90aY/giphy.gif" onclick="sendGif('https://media.giphy.com/media/26bgQ8u0e1bBf90aY/giphy.gif')" class="w-full h-20 object-cover rounded-lg cursor-pointer hover:opacity-80 transition transform hover:scale-105">
            <img src="https://media.giphy.com/media/l0HlHFRbmaZtBRhXG/giphy.gif" onclick="sendGif('https://media.giphy.com/media/l0HlHFRbmaZtBRhXG/giphy.gif')" class="w-full h-20 object-cover rounded-lg cursor-pointer hover:opacity-80 transition transform hover:scale-105">
            <img src="https://media.giphy.com/media/3o7TKSjRrfIPjeiVyM/giphy.gif" onclick="sendGif('https://media.giphy.com/media/3o7TKSjRrfIPjeiVyM/giphy.gif')" class="w-full h-20 object-cover rounded-lg cursor-pointer hover:opacity-80 transition transform hover:scale-105">
        </div>
    </div>

    <!-- SCHEDULE MODAL -->
    <div id="scheduleModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-5 rounded-2xl w-full max-w-sm shadow-2xl animate-scale-up">
            <h3 class="text-sm font-bold text-white mb-2">⏱️ Schedule Message Delivery</h3>
            <input type="datetime-local" id="scheduleDateTime" class="w-full bg-black/40 border border-white/20 rounded-xl px-3 py-2 text-white text-xs mb-4 focus:outline-none">
            <div class="flex justify-end space-x-2">
                <button onclick="toggleScheduleModal()" class="px-3 py-1.5 bg-gray-800 text-xs rounded-xl text-gray-300">Cancel</button>
                <button onclick="applySchedule()" class="px-4 py-1.5 bg-amber-600 hover:bg-amber-500 text-xs font-semibold text-white rounded-xl">Set Schedule</button>
            </div>
        </div>
    </div>

    <!-- VIDEO NOTE MODAL -->
    <div id="videoNoteModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-5 rounded-2xl w-full max-w-md shadow-2xl text-center animate-scale-up">
            <h3 class="text-sm font-bold text-white mb-3">📹 Record Video Note</h3>
            <div class="relative mb-3 bg-black rounded-xl overflow-hidden aspect-video flex items-center justify-center">
                <video id="videoPreview" autoplay muted class="w-full h-full object-cover"></video>
            </div>
            <div class="flex items-center justify-center space-x-3">
                <button id="recordVideoBtn" onclick="startVideoRecording()" class="px-4 py-2 bg-emerald-600 text-xs font-semibold rounded-xl text-white">Start Recording</button>
                <button id="stopVideoBtn" onclick="stopVideoRecording()" class="hidden px-4 py-2 bg-rose-600 text-xs font-semibold rounded-xl text-white">Stop & Send</button>
                <button onclick="closeVideoNoteModal()" class="px-3 py-2 bg-gray-800 text-xs rounded-xl text-gray-300">Close</button>
            </div>
        </div>
    </div>

    <!-- SETTINGS & PRIVACY CONTROLS MODAL -->
    <div id="settingsModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-6 rounded-3xl w-full max-w-lg shadow-2xl animate-scale-up space-y-4 max-h-[85vh] overflow-y-auto chat-scroll text-xs">
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span>⚙️ Chat Settings, Privacy & Security Controls</span>
                </h3>
                <button onclick="toggleSettingsModal()" class="text-gray-400 hover:text-white">✕</button>
            </div>

            <!-- ⏱️ AUTO-DELETE MESSAGES TIMER -->
            <div class="space-y-2 p-3 bg-black/40 border border-white/10 rounded-2xl">
                <label class="font-bold text-amber-300 flex items-center gap-1.5">
                    <span>⏱️ Auto-Delete Messages Expiration Timer</span>
                </label>
                <p class="text-[11px] text-gray-400">Automatically expire and purge chat messages across sessions based on scheduled timer.</p>
                <select id="autoDeleteTimerSelect" onchange="saveAutoDeleteTimer(this.value)" class="w-full bg-black/60 border border-white/20 rounded-xl px-3 py-2 text-white">
                    <option value="off">Off (Messages Persist)</option>
                    <option value="15h">15 Hours</option>
                    <option value="24h">24 Hours (1 Day)</option>
                </select>
            </div>

            <!-- 🔒 GRANULAR PRIVACY CONTROLS -->
            <div class="space-y-3 p-3 bg-black/40 border border-white/10 rounded-2xl">
                <label class="font-bold text-indigo-300 flex items-center gap-1.5">
                    <span>🔒 Granular Privacy & Access Controls</span>
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <div>
                        <label class="block text-gray-400 text-[10px] mb-1">Text & Voice Messages Privacy</label>
                        <select id="msgPrivacySelect" class="w-full bg-black/60 border border-white/20 rounded-xl px-2.5 py-1.5 text-white">
                            <option value="everyone">🌐 Everyone</option>
                            <option value="contacts">👥 My Contacts</option>
                            <option value="private">🔒 Only Me / Custom</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-[10px] mb-1">Voice & Video Calls Privacy</label>
                        <select id="callsPrivacySelect" class="w-full bg-black/60 border border-white/20 rounded-xl px-2.5 py-1.5 text-white">
                            <option value="everyone">🌐 Everyone</option>
                            <option value="contacts">👥 My Contacts</option>
                            <option value="nobody">🚫 Nobody</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-[10px] mb-1">Forwarding & Quotes Privacy</label>
                        <select id="forwardPrivacySelect" class="w-full bg-black/60 border border-white/20 rounded-xl px-2.5 py-1.5 text-white">
                            <option value="allow">✅ Allowed</option>
                            <option value="disallow">🚫 Restricted</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-[10px] mb-1">Last Seen & Online Availability</label>
                        <select id="lastSeenSelect" class="w-full bg-black/60 border border-white/20 rounded-xl px-2.5 py-1.5 text-white">
                            <option value="visible">🟢 Show Online Status</option>
                            <option value="hidden">🙈 Hide Online Status</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- 🎨 THEMES & AUDIO NOTIFICATIONS -->
            <div class="space-y-3 p-3 bg-black/40 border border-white/10 rounded-2xl">
                <label class="font-bold text-blue-300 flex items-center gap-1.5">
                    <span>🎨 Theme Presets & Audio Notifications</span>
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <div>
                        <label class="block text-gray-400 text-[10px] mb-1">Theme Preset</label>
                        <select id="themeSelect" onchange="changeTheme(this.value)" class="w-full bg-black/60 border border-white/20 rounded-xl px-3 py-2 text-white">
                            <option value="sapphire">Deep Sapphire (Default)</option>
                            <option value="cyberpunk">Cyberpunk Neon</option>
                            <option value="emerald">Emerald Mint</option>
                            <option value="sunset">Sunset Rose</option>
                            <option value="light">Light Pearl</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between pt-4">
                        <span class="text-gray-300">Audio Chime FX:</span>
                        <input type="checkbox" id="soundToggle" checked class="rounded border-gray-600 bg-gray-800 text-blue-600 w-4 h-4">
                    </div>
                </div>
            </div>

            <!-- 🛡️ SECURITY & DANGER ZONE -->
            <div class="space-y-2 p-3 bg-rose-950/30 border border-rose-500/20 rounded-2xl">
                <label class="font-bold text-rose-300 flex items-center gap-1.5">
                    <span>🛡️ Security & Local Cache Purge</span>
                </label>
                <div class="flex items-center justify-between text-gray-300 text-[11px]">
                    <span>Biometric Lock (Passcode / Face ID):</span>
                    <span class="text-emerald-400 font-bold">Enabled</span>
                </div>
                <div class="flex items-center justify-between text-gray-300 text-[11px]">
                    <span>Two-Step Verification (2FA):</span>
                    <span class="text-blue-400 font-bold">Enforced (Active)</span>
                </div>
                <button type="button" onclick="wipeLocalChatCaches()" class="w-full py-2 bg-rose-900/60 hover:bg-rose-800 text-rose-200 rounded-xl border border-rose-500/30 font-bold transition mt-1">
                    🧹 Wipe Local Message Caches & Session Credentials
                </button>
            </div>

            <div class="flex justify-end pt-2">
                <button onclick="toggleSettingsModal()" class="px-5 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-bold">Save & Apply Controls</button>
            </div>
        </div>
    </div>

    <!-- AUDIO CALL MODAL -->
    <div id="audioCallModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-6 rounded-2xl w-full max-w-xs shadow-2xl text-center animate-scale-up">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-3xl shadow-xl animate-bounce">📞</div>
            <h3 class="text-base font-bold text-white">Audio Call</h3>
            <p id="callStatus" class="text-xs text-emerald-400 my-2 animate-pulse">Connecting Peer-to-Peer...</p>
            <div class="flex items-center justify-center space-x-4 mt-6">
                <button onclick="endAudioCall()" class="p-3 bg-rose-600 rounded-full text-white font-bold transform hover:scale-110 transition">📵</button>
            </div>
        </div>
    </div>

    <!-- Taskbar & Mac Window Controls -->
    @include('taskbar')
    <script src="{{ asset('js/mac-window-controls.js') }}"></script>
    <script type="module" src="{{ asset('js/chat-portal.js') }}"></script>
</body>
</html>
