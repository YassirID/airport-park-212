<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TEMAN PANDARA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-950 text-white font-[Inter] min-h-screen flex items-center justify-center relative overflow-hidden">

    {{-- Animated Background Orbs --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="auth-bg-orb w-96 h-96 bg-cyan-500/8 -top-48 -right-48" style="position:absolute"></div>
        <div class="auth-bg-orb w-80 h-80 bg-blue-600/8 -bottom-40 -left-40" style="position:absolute; animation-delay:2s"></div>
        <div class="auth-bg-orb w-72 h-72 bg-indigo-500/5 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" style="position:absolute; animation-delay:4s"></div>
        <div class="auth-bg-orb w-40 h-40 bg-purple-500/5 top-1/4 left-1/4" style="position:absolute; animation-delay:1s"></div>
        {{-- Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(rgba(148,163,184,0.3) 1px, transparent 1px); background-size: 32px 32px;"></div>
    </div>

    <div class="relative z-10 w-full max-w-md px-6 animate-fade-in-up">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-2xl shadow-cyan-500/25 mb-5 animate-float">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5A1.5 1.5 0 0011.5 2 1.5 1.5 0 0010 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">TEMAN PANDARA</h1>
            <p class="text-sm text-slate-500 mt-1.5">Sistem Manajemen Parkir Bandara</p>
        </div>

        {{-- Login Card --}}
        <div class="glass-card-static p-8 shadow-2xl shadow-black/20 card-accent">
            <h2 class="text-lg font-bold text-white mb-1 mt-2">Masuk ke Akun</h2>
            <p class="text-sm text-slate-500 mb-6">Silakan masukkan kredensial Anda</p>

            @if($errors->any())
                <div class="mb-5 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm flex items-center gap-3 animate-scale-in">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9.303 3.376c-.866 1.5-2.813 1.874-1.948 3.374H14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                    <div>
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="username" class="form-label">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">

                        </div>
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="form-input pl-11"
                            placeholder="Masukkan username" required autofocus>
                    </div>
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">

                        </div>
                        <input type="password" name="password" id="password"
                            class="form-input pl-11"
                            placeholder="Masukkan password" required>
                    </div>
                </div>
                <button type="submit"
                    class="w-full py-3.5 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-semibold rounded-xl shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 transition-all duration-300 active:scale-[0.98] flex items-center justify-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                    Masuk
                </button>
            </form>

            <!-- <div class="mt-6 text-center">
                <p class="text-sm text-slate-500">Belum punya akun?
                    <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold transition-colors">Daftar di sini</a>
                </p>
            </div> -->
        </div>

        <p class="text-center text-xs text-slate-600 mt-8">© {{ date('Y') }} TEMAN PANDARA — Airport Parking Management</p>
    </div>
</body>
</html>
