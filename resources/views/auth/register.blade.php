<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TEMAN PANDARA</title>
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
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(rgba(148,163,184,0.3) 1px, transparent 1px); background-size: 32px 32px;"></div>
    </div>

    <div class="relative z-10 w-full max-w-md px-6 animate-fade-in-up">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-2xl shadow-cyan-500/25 mb-5 animate-float">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5A1.5 1.5 0 0011.5 2 1.5 1.5 0 0010 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">TEMAN PANDARA</h1>
            <p class="text-sm text-slate-500 mt-1.5">Daftar Akun Baru</p>
        </div>

        {{-- Register Card --}}
        <div class="glass-card-static p-8 shadow-2xl shadow-black/20 card-accent">
            <h2 class="text-lg font-bold text-white mb-1 mt-2">Buat Akun</h2>
            <p class="text-sm text-slate-500 mb-6">Lengkapi form di bawah untuk mendaftar</p>

            @if($errors->any())
                <div class="mb-5 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm animate-scale-in">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}"
                            class="form-input pl-11"
                            placeholder="Masukkan nama lengkap" required autofocus>
                    </div>
                </div>
                <div>
                    <label for="username" class="form-label">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="form-input pl-11"
                            placeholder="Masukkan username" required>
                    </div>
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                        </div>
                        <input type="password" name="password" id="password"
                            class="form-input pl-11"
                            placeholder="Masukkan password (min 6 karakter)" required>
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-input pl-11"
                            placeholder="Ulangi password" required>
                    </div>
                </div>
                <div>
                    <label for="role" class="form-label">Role</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <select name="role" id="role" required class="form-input pl-11 appearance-none">
                            <option value="" disabled selected>Pilih role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                            <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="w-full py-3.5 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-semibold rounded-xl shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 transition-all duration-300 active:scale-[0.98] flex items-center justify-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
                    Daftar
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-slate-500">Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold transition-colors">Masuk di sini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-xs text-slate-600 mt-8">© {{ date('Y') }} TEMAN PANDARA — Airport Parking Management</p>
    </div>
</body>
</html>
