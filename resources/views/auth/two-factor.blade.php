<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication Setup & Verification - Parsa</title>

    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
</head>

<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center p-4 antialiased">
    <div class="w-full max-w-md bg-gray-900/95 border border-white/20 p-8 rounded-3xl backdrop-blur-xl shadow-2xl">
        <div class="text-center mb-6">
            <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 flex items-center justify-center text-2xl shadow-lg ring-4 ring-blue-500/20">
                🔐
            </div>
            <h1 class="text-xl font-bold tracking-tight text-white">Two-Factor Authentication</h1>
            <p class="text-xs text-gray-400 mt-1">Securing account access for <span class="text-emerald-400 font-semibold">{{ $user->email }}</span></p>
        </div>

        @if ($isSetup)
            <div class="mb-6 p-4 bg-blue-950/80 border border-blue-500/40 rounded-2xl text-xs space-y-4 shadow-inner">
                <div class="flex items-center gap-2 font-bold text-blue-300">
                    <span class="text-base">📱</span>
                    <span>2FA Setup Required (Shown Only Once Upon Sign-Up)</span>
                </div>
                <p class="text-gray-300 leading-relaxed">
                    Scan the QR code below using your Authenticator app (e.g. Google Authenticator, 1Password, Authy, Apple Passwords) or copy the secret key below.
                </p>

                <!-- QR Code Container -->
                <div class="flex flex-col items-center justify-center p-3.5 bg-white rounded-2xl shadow-md w-fit mx-auto border border-gray-200">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode('otpauth://totp/Parsa:' . $user->email . '?secret=' . $secret . '&issuer=Parsa') }}" 
                         alt="2FA QR Code" class="w-40 h-40 rounded-lg">
                    <span class="text-[10px] text-gray-600 font-mono mt-1 font-bold">Scan to add to Auth App</span>
                </div>

                <!-- Copy Secret Key Section -->
                <div class="space-y-1.5 pt-1">
                    <label class="block text-[11px] font-semibold text-gray-300">Manual Entry Secret Key:</label>
                    <div class="flex items-center gap-2">
                        <div id="secretKeyText" class="flex-1 p-2.5 bg-black/70 border border-white/20 rounded-xl font-mono text-center text-sm tracking-widest text-amber-300 select-all overflow-x-auto">
                            {{ $secret }}
                        </div>
                        <button type="button" onclick="copySecretKey()" id="copyBtn" class="px-3.5 py-2.5 bg-blue-600 hover:bg-blue-500 active:scale-95 text-white font-bold rounded-xl transition text-xs flex items-center gap-1.5 shrink-0 shadow">
                            <span id="copyIcon">📋</span>
                            <span id="copyLabel">Copy Key</span>
                        </button>
                    </div>
                </div>
            </div>

            <script>
                function copySecretKey() {
                    const key = "{{ $secret }}";
                    navigator.clipboard.writeText(key).then(() => {
                        const copyLabel = document.getElementById('copyLabel');
                        const copyIcon = document.getElementById('copyIcon');
                        const btn = document.getElementById('copyBtn');
                        
                        copyLabel.innerText = 'Copied!';
                        copyIcon.innerText = '✅';
                        btn.classList.remove('bg-blue-600', 'hover:bg-blue-500');
                        btn.classList.add('bg-emerald-600', 'hover:bg-emerald-500');
                        
                        setTimeout(() => {
                            copyLabel.innerText = 'Copy Key';
                            copyIcon.innerText = '📋';
                            btn.classList.remove('bg-emerald-600', 'hover:bg-emerald-500');
                            btn.classList.add('bg-blue-600', 'hover:bg-blue-500');
                        }, 2500);
                    }).catch(err => {
                        console.error('Could not copy secret key: ', err);
                    });
                }
            </script>
        @endif

        @if (!$isSetup)
            <div class="mb-4 text-center">
                <button type="button" onclick="toggleQrBox()" class="text-xs text-blue-400 hover:text-blue-300 underline font-medium inline-flex items-center gap-1.5 transition">
                    <span>📱</span> Need to re-scan QR code or view manual key?
                </button>
            </div>

            <div id="reconfigQrBox" class="hidden mb-6 p-4 bg-blue-950/80 border border-blue-500/40 rounded-2xl text-xs space-y-4 shadow-inner">
                <div class="flex items-center justify-between font-bold text-blue-300">
                    <div class="flex items-center gap-2">
                        <span class="text-base">📱</span>
                        <span>Authenticator Setup & QR Code</span>
                    </div>
                    <button type="button" onclick="toggleQrBox()" class="text-gray-400 hover:text-white text-xs">✕ Close</button>
                </div>
                <p class="text-gray-300 leading-relaxed">
                    Scan the QR code below using your Authenticator app (e.g. Google Authenticator, 1Password, Authy, Apple Passwords) or copy the manual key.
                </p>

                <div class="flex flex-col items-center justify-center p-3.5 bg-white rounded-2xl shadow-md w-fit mx-auto border border-gray-200">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode('otpauth://totp/Parsa:' . $user->email . '?secret=' . $secret . '&issuer=Parsa') }}" 
                         alt="2FA QR Code" class="w-40 h-40 rounded-lg">
                    <span class="text-[10px] text-gray-600 font-mono mt-1 font-bold">Scan to add to Auth App</span>
                </div>

                <div class="space-y-1.5 pt-1">
                    <label class="block text-[11px] font-semibold text-gray-300">Manual Entry Secret Key:</label>
                    <div class="flex items-center gap-2">
                        <div id="secretKeyTextExisting" class="flex-1 p-2.5 bg-black/70 border border-white/20 rounded-xl font-mono text-center text-sm tracking-widest text-amber-300 select-all overflow-x-auto">
                            {{ $secret }}
                        </div>
                        <button type="button" onclick="copyExistingSecretKey()" id="copyExistingBtn" class="px-3.5 py-2.5 bg-blue-600 hover:bg-blue-500 active:scale-95 text-white font-bold rounded-xl transition text-xs flex items-center gap-1.5 shrink-0 shadow">
                            <span id="copyExistingIcon">📋</span>
                            <span id="copyExistingLabel">Copy Key</span>
                        </button>
                    </div>
                </div>
            </div>

            <script>
                function toggleQrBox() {
                    const box = document.getElementById('reconfigQrBox');
                    box.classList.toggle('hidden');
                }
                function copyExistingSecretKey() {
                    const key = "{{ $secret }}";
                    navigator.clipboard.writeText(key).then(() => {
                        const copyLabel = document.getElementById('copyExistingLabel');
                        const copyIcon = document.getElementById('copyExistingIcon');
                        const btn = document.getElementById('copyExistingBtn');
                        
                        copyLabel.innerText = 'Copied!';
                        copyIcon.innerText = '✅';
                        btn.classList.remove('bg-blue-600', 'hover:bg-blue-500');
                        btn.classList.add('bg-emerald-600', 'hover:bg-emerald-500');
                        
                        setTimeout(() => {
                            copyLabel.innerText = 'Copy Key';
                            copyIcon.innerText = '📋';
                            btn.classList.remove('bg-emerald-600', 'hover:bg-emerald-500');
                            btn.classList.add('bg-blue-600', 'hover:bg-blue-500');
                        }, 2500);
                    }).catch(err => {
                        console.error('Could not copy secret key: ', err);
                    });
                }
            </script>
        @endif

        @error('code')
            <div class="mb-4 p-3 bg-rose-950/80 border border-rose-500/40 rounded-xl text-xs text-rose-300">
                {{ $message }}
            </div>
        @enderror

        <form method="POST" action="{{ route('2fa.verify') }}" class="space-y-4 text-xs">
            @csrf
            <div>
                <label for="code" class="block font-medium text-gray-300 mb-1.5 text-center">
                    Enter 6-Digit Authenticator Code
                </label>
                <input type="text" id="code" name="code" required maxlength="6" autofocus placeholder="123456"
                    class="w-full bg-black/40 border border-white/20 rounded-xl px-4 py-3 text-center text-2xl font-mono tracking-widest text-white focus:outline-none focus:border-blue-500">
            </div>

            <button type="submit"
                class="w-full py-3.5 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-bold text-sm rounded-xl shadow-lg transition active:scale-95">
                Verify & Continue
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-gray-400">
            <a href="{{ route('login') }}" class="hover:underline text-gray-400">← Back to Login</a>
        </div>
    </div>
</body>

</html>