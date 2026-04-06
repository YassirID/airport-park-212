<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TEMAN PANDARA') - Parkir Bandara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white font-[Inter] min-h-screen flex">

    {{-- Mobile Sidebar Overlay --}}
    <div id="sidebar-overlay" class="sidebar-overlay lg:hidden"></div>

    {{-- Sidebar --}}
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-[17rem] bg-slate-900/95 backdrop-blur-2xl border-r border-slate-800/80 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">
        {{-- Logo --}}
        <div class="h-16 flex items-center gap-3 px-5 border-b border-slate-800/80">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/20 animate-pulse-glow">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 19l-7-7 7-7m0 14l7-7-7-7" stroke="none"/><path fill="currentColor" d="M21 16v-2l-8-5V3.5A1.5 1.5 0 0011.5 2 1.5 1.5 0 0010 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
            </div>
            <div>
                <h1 class="text-sm font-bold text-white tracking-tight">TEMAN PANDARA</h1>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-semibold">Parking System</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-3 space-y-0.5 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                <span>Dashboard</span>
            </a>

            @if(auth()->user()->isAdmin())
                <p class="px-3 pt-5 pb-1.5 text-[10px] font-bold text-slate-600 uppercase tracking-widest">Master Data</p>
                <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                    <span>Kelola User</span>
                </a>
                <a href="{{ route('area-parkir.index') }}" class="sidebar-link {{ request()->routeIs('area-parkir.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5M10.5 21H3m13.5-18H3.545M3 21V3.545m0 0L12 9.75l9-6.205"/></svg>
                    <span>Area Parkir</span>
                </a>
                <a href="{{ route('kendaraan.index') }}" class="sidebar-link {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                    <span>Kendaraan</span>
                </a>
                <a href="{{ route('tarif.index') }}" class="sidebar-link {{ request()->routeIs('tarif.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                    <span>Tarif</span>
                </a>
                <a href="{{ route('log-aktivitas.index') }}" class="sidebar-link {{ request()->routeIs('log-aktivitas.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    <span>Log Aktivitas</span>
                </a>
            @endif

            @if(auth()->user()->isPetugas())
                <p class="px-3 pt-5 pb-1.5 text-[10px] font-bold text-slate-600 uppercase tracking-widest">Data</p>
                <a href="{{ route('kendaraan.index') }}" class="sidebar-link {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                    <span>Daftar Kendaraan</span>
                </a>
                <p class="px-3 pt-5 pb-1.5 text-[10px] font-bold text-slate-600 uppercase tracking-widest">Operasional</p>
                <a href="{{ route('transaksi.index') }}" class="sidebar-link {{ request()->routeIs('transaksi.index') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Riwayat Transaksi</span>
                </a>
                <a href="{{ route('transaksi.masuk') }}" class="sidebar-link {{ request()->routeIs('transaksi.masuk') ? 'active' : '' }}" style="{{ request()->routeIs('transaksi.masuk') ? '--tw-ring-color: rgba(16,185,129,0.2); background: rgba(16,185,129,0.12); border-color: rgba(16,185,129,0.2); color: #34d399;' : '' }}">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                    <span>Kendaraan Masuk</span>
                </a>
                <a href="{{ route('transaksi.keluar') }}" class="sidebar-link {{ request()->routeIs('transaksi.keluar') ? 'active' : '' }}" style="{{ request()->routeIs('transaksi.keluar') ? 'background: rgba(239,68,68,0.12); border-color: rgba(239,68,68,0.2); color: #f87171;' : '' }}">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
                    <span>Kendaraan Keluar</span>
                </a>
            @endif

            @if(auth()->user()->isOwner())
                <p class="px-3 pt-5 pb-1.5 text-[10px] font-bold text-slate-600 uppercase tracking-widest">Laporan</p>
                <a href="{{ route('rekap.index') }}" class="sidebar-link {{ request()->routeIs('rekap.*') ? 'active' : '' }}">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                    <span>Rekap Transaksi</span>
                </a>
            @endif
        </nav>

        {{-- User Badge --}}
        <div class="p-3 border-t border-slate-800/80">
            <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-800/40">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-xs font-bold shadow-lg shadow-cyan-500/15 flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->nama_lengkap }}</p>
                    <p class="text-[10px] text-slate-500 uppercase font-semibold tracking-wider">{{ auth()->user()->role }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" data-no-loading class="p-1.5 rounded-lg text-slate-500 hover:text-red-400 hover:bg-red-500/10 transition-all duration-200" title="Logout">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 lg:ml-[17rem]">
        {{-- Top Bar --}}
        <header class="sticky top-0 z-40 h-16 bg-slate-950/80 backdrop-blur-2xl border-b border-slate-800/60 flex items-center justify-between px-6">
            <div class="flex items-center gap-4">
                <button id="sidebar-toggle" class="lg:hidden p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800/50 transition-all">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                </button>
                <div>
                    <h2 class="text-base font-bold text-white tracking-tight">@yield('page-title', 'Dashboard')</h2>
                </div>
            </div>
            <div class="hidden sm:flex items-center gap-3">
                <div class="flex items-center gap-2 text-xs text-slate-500 bg-slate-800/40 px-3 py-1.5 rounded-lg">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span id="live-clock">{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-6 pt-4">
            @if(session('success'))
                <div class="flash-message mb-4 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center gap-3 animate-slide-down">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-emerald-500/15 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    </div>
                    <span class="flex-1">{{ session('success') }}</span>
                    <button class="flash-dismiss-btn text-emerald-500/50 hover:text-emerald-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="flash-message mb-4 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm flex items-center gap-3 animate-slide-down">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-500/15 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                    </div>
                    <span class="flex-1">{{ session('error') }}</span>
                    <button class="flash-dismiss-btn text-red-500/50 hover:text-red-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif
            @if($errors->any())
                <div class="flash-message mb-4 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm animate-slide-down">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-500/15 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                        </div>
                        <span class="font-medium">Terdapat kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 ml-11">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <main class="p-6 animate-fade-in-up">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
