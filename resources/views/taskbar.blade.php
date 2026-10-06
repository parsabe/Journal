<!-- MACOS / WINDOWS TASKBAR DOCK (PURE USER CHATS DOCK) -->
<div id="mac-taskbar-dock" class="fixed bottom-3 left-1/2 -translate-x-1/2 z-50 flex items-center gap-2 px-4 py-2 bg-black/60 backdrop-blur-2xl border border-white/15 rounded-full shadow-[0_10px_35px_rgba(0,0,0,0.7)] transition-all duration-300 hover:scale-105 hover:border-white/30">
    
    <a href="/chat" class="flex items-center space-x-2 border-r border-white/15 pr-2 hover:opacity-80 transition cursor-pointer" title="Open Social Chat Portal">
        <span class="text-base font-bold text-blue-400">💬</span>
        <span class="text-xs font-mono font-bold text-white hidden sm:inline">CHATS</span>
    </a>

    <!-- Dynamic macOS Chat Contacts Dock Container -->
    <div id="mac-chat-users-dock" class="flex items-center gap-2">
        <!-- JS renders chat member avatars & red unread badges -->
    </div>

    <!-- CENTRAL ACTION BUTTONS (CREATE POST & WRITE JOURNAL) -->
    @if(Auth::check())
        <div class="flex items-center gap-2 border-x border-white/15 px-2">
            <button onclick="window.openGlobalCreatePostModal ? window.openGlobalCreatePostModal() : (window.location.href='/#create-post')" 
                class="px-3.5 py-1.5 bg-gradient-to-r from-orange-500 via-rose-600 to-pink-600 hover:from-orange-400 hover:to-pink-500 text-white font-bold rounded-full text-xs shadow-lg transition transform hover:scale-105 active:scale-95 flex items-center gap-1.5 border border-white/20">
                <span>➕</span>
                <span>{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Beitrag Erstellen' : 'Create Post' }}</span>
            </button>

            <button type="button" onclick="openWriteBlogModal()" 
                class="px-3.5 py-1.5 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold rounded-full text-xs shadow-lg transition transform hover:scale-105 active:scale-95 flex items-center gap-1.5 border border-white/20">
                <span>✍️</span>
                <span>{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Journal Schreiben' : 'Write Journal' }}</span>
            </button>
        </div>
    @endif

    <!-- Restore Window Trigger -->
    <button onclick="window.restoreMacWindow && window.restoreMacWindow()" title="Restore / Focus Active Window"
            class="p-2.5 rounded-2xl hover:bg-white/10 text-white transition-all group relative flex items-center justify-center">
        <span class="text-xl group-hover:scale-125 transition-transform">🗔</span>
        <span class="absolute -top-9 px-2.5 py-1 bg-black/80 text-[10px] font-bold text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-lg border border-white/10">
            {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Fenster-Fokus' : 'Window Focus' }}
        </span>
    </button>

    <!-- Hans Zimmer Soundtrack Controller (Play / Pause Only) -->
    <button id="taskbar-audio-toggle" type="button" onclick="event.stopPropagation(); window.toggleMainSoundtrack && window.toggleMainSoundtrack(event)" title="Hans Zimmer - Organ Variation (Play / Pause)"
            class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-mono transition-all transform hover:scale-105 active:scale-95 group ml-1">
        <span id="taskbar-audio-icon" class="text-sm">🎵</span>
        <span class="hidden md:inline font-bold">HANS ZIMMER</span>
        <span id="taskbar-audio-state" class="text-[10px] text-orange-400 font-bold uppercase">[PLAY]</span>
    </button>
</div>

<!-- GLOBAL RICH TEXT JOURNAL EDITOR MODAL SUITE -->
<div id="write-blog-modal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-[100] flex items-center justify-center p-4">
    <div class="bg-gray-900/95 border border-white/20 p-6 rounded-3xl w-full max-w-2xl shadow-2xl space-y-4 animate-scale-up backdrop-blur-xl">
        <div class="flex items-center justify-between pb-3 border-b border-white/10">
            <h2 class="text-base font-bold text-white uppercase tracking-wider flex items-center gap-2">
                📝 {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Neues Journal Veröffentlichen' : 'Publish New Journal' }}
            </h2>
            <button onclick="closeWriteBlogModal()" class="text-gray-400 hover:text-white text-xs font-bold p-1">✕ {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Schließen' : 'Close' }}</button>
        </div>

        @auth
            <form id="blog-form" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Journal-Titel' : 'Journal Title' }}</label>
                    <input type="text" name="title" required placeholder="{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Journal-Titel eingeben...' : 'Enter journal title...' }}"
                        class="w-full bg-black/50 border border-white/15 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500">
                </div>

                <!-- Rich Text Editor Toolbar -->
                <div class="space-y-1">
                    <label class="block text-xs font-medium text-gray-400">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Formatierungs-Werkzeuge' : 'Formatting Tools' }}</label>
                    <div class="rich-editor-toolbar flex flex-wrap gap-1.5 p-2 bg-black/60 border border-white/10 rounded-xl">
                        <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs font-bold" data-cmd="bold"><b>B</b></button>
                        <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs italic" data-cmd="italic"><i>I</i></button>
                        <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs underline" data-cmd="underline"><u>U</u></button>
                        <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs font-mono" data-cmd="formatBlock" data-val="h2">H2</button>
                        <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs font-mono" data-cmd="formatBlock" data-val="h3">H3</button>
                        <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs" data-cmd="insertUnorderedList">• Bullet List</button>
                        <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs" data-cmd="insertTable">📊 Insert Table</button>
                        <button type="button" class="rich-tool-btn px-3 py-1 bg-white/10 hover:bg-white/20 text-white rounded-lg text-xs" data-cmd="createLink">🔗 Link</button>
                    </div>
                </div>

                <!-- Content Editable Area -->
                <div class="space-y-1">
                    <label class="block text-xs font-medium text-gray-400">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Journal-Inhalt' : 'Journal Content' }}</label>
                    <div id="rich-editor-area" contenteditable="true"
                        class="w-full min-h-[160px] max-h-[280px] bg-black/50 border border-white/15 rounded-xl p-4 text-xs text-slate-200 focus:outline-none focus:border-indigo-500 overflow-y-auto">
                        {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Schreibe hier deinen Journal-Inhalt...' : 'Write your rich text journal content here...' }}
                    </div>
                </div>
                <input type="hidden" name="content" id="blog-content-input">

                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2 border-t border-white/10">
                    <div>
                        <label class="block text-[11px] font-medium text-gray-400 mb-1">Cover Image (Optional)</label>
                        <input type="file" name="cover_image" class="text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/30 file:text-indigo-300 hover:file:bg-indigo-600/50">
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold text-xs rounded-xl shadow-lg hover:opacity-90 active:scale-95 transition-all">
                        {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'JOURNAL VERÖFFENTLICHEN' : 'PUBLISH JOURNAL' }}
                    </button>
                </div>
            </form>
        @else
            <div class="py-8 text-center space-y-4">
                <div class="w-16 h-16 mx-auto rounded-full bg-indigo-600/20 border border-indigo-500/40 flex items-center justify-center text-2xl text-indigo-400 animate-pulse">
                    🔑
                </div>
                <h3 class="text-base font-bold text-white">Sign In to Publish Journals</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto">Please log in to access the rich text editor suite and publish your research journals.</p>
                <a href="{{ route('login') }}" class="inline-block px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg transition">
                    Sign In Now
                </a>
            </div>
        @endauth
    </div>
</div>

<script type="module" src="{{ asset('js/blog.js') }}"></script>

<!-- GLOBAL TWITTER / INSTAGRAM STYLE CREATE POST MODAL -->
@if(Auth::check())
    <div id="globalCreatePostModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-gray-900 border border-white/20 p-6 rounded-3xl w-full max-w-lg shadow-2xl text-xs space-y-4 animate-scale-up">
            
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
                <div class="flex items-center space-x-3">
                    <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('images/profile.jpg') }}" class="w-10 h-10 rounded-full border border-white/20 object-cover shadow-md">
                    <div>
                        <h3 class="text-sm font-bold text-white flex items-center gap-1.5">
                            <span>{{ Auth::user()->name }}</span>
                            <span class="text-xs font-mono text-gray-400 font-normal">@({{ Auth::user()->username ?? 'user' }})</span>
                        </h3>
                        <p class="text-[10px] text-pink-400 font-mono">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Neuen öffentlichen Beitrag erstellen' : 'Create Community Post' }}</p>
                    </div>
                </div>
                <button onclick="closeGlobalCreatePostModal()" class="text-gray-400 hover:text-white text-base font-bold">✕</button>
            </div>

            <form id="globalQuickPostForm" onsubmit="submitGlobalPost(event)" class="space-y-4">
                @csrf
                <div>
                    <textarea id="globalPostContent" rows="4" placeholder="{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Was gibt es Neues? Teile Gedanken, Fotos, Videos...' : 'What\'s happening? Share thoughts, photos, videos...' }}" 
                        class="w-full bg-black/50 border border-white/20 rounded-2xl p-3.5 text-white text-xs placeholder-gray-400 focus:outline-none focus:border-pink-500 resize-none font-sans"></textarea>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-gray-300 font-semibold mb-1.5">📷 {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Foto / Video (Optional)' : 'Photo / Video (Optional)' }}</label>
                        <label class="w-full px-3.5 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 text-gray-200 rounded-xl text-xs font-semibold cursor-pointer transition flex items-center justify-between">
                            <span id="globalMediaName" class="truncate max-w-[150px]">{{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Datei auswählen...' : 'Choose file...' }}</span>
                            <span>📁</span>
                            <input type="file" id="globalPostMedia" accept="image/*,video/*" class="hidden" onchange="document.getElementById('globalMediaName').innerText = this.files[0]?.name || 'Choose file...'">
                        </label>
                    </div>

                    <div>
                        <label class="block text-gray-300 font-semibold mb-1.5">🔒 {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Sichtbarkeit' : 'Privacy Settings' }}</label>
                        <select id="globalPostPrivacy" class="w-full bg-black/50 border border-white/20 rounded-xl px-3 py-2.5 text-xs text-gray-200 focus:outline-none focus:border-pink-500">
                            <option value="public">🌐 {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Öffentlich' : 'Public' }}</option>
                            <option value="followers">👥 {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Nur Follower' : 'Followers Only' }}</option>
                            <option value="private">🔒 {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Privat' : 'Private' }}</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-300 font-semibold mb-1.5">⏱️ {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Geplante Veröffentlichung (Optional)' : 'Schedule Release (Optional)' }}</label>
                    <input type="datetime-local" id="globalPostScheduledAt" class="w-full bg-black/50 border border-white/20 rounded-xl px-3.5 py-2.5 text-xs text-gray-300 font-mono focus:outline-none focus:border-pink-500">
                </div>

                <div class="flex items-center justify-end space-x-3 pt-3 border-t border-white/10">
                    <button type="button" onclick="closeGlobalCreatePostModal()" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-xl font-semibold transition">
                        {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Abbrechen' : 'Cancel' }}
                    </button>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-orange-500 via-rose-600 to-pink-600 hover:from-orange-400 hover:to-pink-500 text-white font-bold rounded-xl text-xs shadow-xl transition transform active:scale-95">
                        {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Veröffentlichen ➔' : 'Post ➔' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openGlobalCreatePostModal() {
            const modal = document.getElementById('globalCreatePostModal');
            if (modal) modal.classList.remove('hidden');
        }
        window.openGlobalCreatePostModal = openGlobalCreatePostModal;

        function closeGlobalCreatePostModal() {
            const modal = document.getElementById('globalCreatePostModal');
            if (modal) modal.classList.add('hidden');
        }
        window.closeGlobalCreatePostModal = closeGlobalCreatePostModal;

        async function submitGlobalPost(e) {
            e.preventDefault();
            const content = document.getElementById('globalPostContent')?.value || '';
            const mediaFile = document.getElementById('globalPostMedia')?.files[0];
            const privacy = document.getElementById('globalPostPrivacy')?.value || 'public';
            const scheduledAt = document.getElementById('globalPostScheduledAt')?.value || '';

            if (!content && !mediaFile) {
                if (window.showToast) window.showToast('Please enter post text or attach a photo/video.', 'error');
                return;
            }

            const formData = new FormData();
            if (content) formData.append('content', content);
            if (mediaFile) formData.append('media', mediaFile);
            if (privacy) formData.append('privacy', privacy);
            if (scheduledAt) formData.append('scheduled_at', scheduledAt);

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                const res = await fetch('/user/posts/create', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                });
                const data = await res.json();
                if (data.status === 'success') {
                    if (window.showToast) window.showToast(data.message || 'Post published! (+15 Sandika CPs earned)', 'success');
                    if (document.getElementById('globalPostContent')) document.getElementById('globalPostContent').value = '';
                    if (document.getElementById('globalPostMedia')) document.getElementById('globalPostMedia').value = '';
                    if (document.getElementById('globalMediaName')) document.getElementById('globalMediaName').innerText = 'Choose file...';
                    closeGlobalCreatePostModal();
                    if (window.fetchHomePublicFeed) window.fetchHomePublicFeed();
                    else location.reload();
                } else {
                    if (window.showToast) window.showToast(data.message || 'Error creating post.', 'error');
                    else alert(data.message || 'Error creating post.');
                }
            } catch (err) {
                console.error(err);
            }
        }
    </script>
@endif
<script src="{{ asset('js/rank-notifier.js') }}"></script>

<!-- Taskbar Soundtrack Audio Controller Script -->
<script>
    function toggleMainSoundtrack(e) {
        if (e && typeof e.stopPropagation === 'function') {
            e.stopPropagation();
        }
        if (window.spacetimeAudio && typeof window.spacetimeAudio.togglePlayPause === 'function') {
            window.spacetimeAudio.togglePlayPause();
            syncTaskbarAudioState();
            return;
        }
        const audio = document.getElementById('bgMusic');
        if (!audio) return;
        if (audio.paused) {
            audio.play().then(() => syncTaskbarAudioState()).catch(() => {});
        } else {
            audio.pause();
            syncTaskbarAudioState();
        }
    }
    window.toggleMainSoundtrack = toggleMainSoundtrack;

    function syncTaskbarAudioState() {
        let isPlaying = false;
        if (window.spacetimeAudio && window.spacetimeAudio.audioElement) {
            isPlaying = !window.spacetimeAudio.audioElement.paused;
        } else {
            const audio = document.getElementById('bgMusic');
            isPlaying = audio ? !audio.paused : false;
        }

        const stateEl = document.getElementById('taskbar-audio-state');
        const iconEl = document.getElementById('taskbar-audio-icon');
        const btn = document.getElementById('taskbar-audio-toggle');
        if (!stateEl || !iconEl) return;

        if (isPlaying) {
            stateEl.textContent = '[PAUSE]';
            stateEl.className = 'text-[10px] text-emerald-400 font-bold uppercase';
            iconEl.textContent = '🎵';
            if (btn) {
                btn.classList.add('border-emerald-500/40', 'bg-emerald-500/15');
                btn.classList.remove('border-white/20', 'bg-white/10');
            }
        } else {
            stateEl.textContent = '[PLAY]';
            stateEl.className = 'text-[10px] text-orange-400 font-bold uppercase';
            iconEl.textContent = '▶';
            if (btn) {
                btn.classList.remove('border-emerald-500/40', 'bg-emerald-500/15');
                btn.classList.add('border-white/20', 'bg-white/10');
            }
        }
    }
    window.syncTaskbarAudioState = syncTaskbarAudioState;

    document.addEventListener('DOMContentLoaded', () => {
        const audio = document.getElementById('bgMusic');
        if (audio) {
            audio.addEventListener('play', syncTaskbarAudioState);
            audio.addEventListener('pause', syncTaskbarAudioState);
            audio.addEventListener('playing', syncTaskbarAudioState);
        }
        const toggleBtn = document.getElementById('taskbar-audio-toggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }
        syncTaskbarAudioState();
    });
</script>

