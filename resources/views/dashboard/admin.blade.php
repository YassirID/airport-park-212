@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
    {{-- Card: Total User --}}
    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon stat-icon-cyan">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
            <span class="badge badge-cyan"><span class="badge-dot"></span>Users</span>
        </div>
        <p class="text-3xl font-bold text-white tracking-tight">{{ $totalUser }}</p>
        <p class="text-xs text-slate-500 mt-1 font-medium">Total Pengguna</p>
    </div>

    {{-- Card: Total Area --}}
    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon stat-icon-emerald">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5M10.5 21H3m13.5-18H3.545M3 21V3.545m0 0L12 9.75l9-6.205"/></svg>
            </div>
            <span class="badge badge-emerald"><span class="badge-dot"></span>Area</span>
        </div>
        <p class="text-3xl font-bold text-white tracking-tight">{{ $totalArea }}</p>
        <p class="text-xs text-slate-500 mt-1 font-medium">Area Parkir</p>
    </div>

    {{-- Card: Total Kendaraan --}}
    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon stat-icon-amber">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
            </div>
            <span class="badge badge-amber"><span class="badge-dot"></span>Kendaraan</span>
        </div>
        <p class="text-3xl font-bold text-white tracking-tight">{{ $totalKendaraan }}</p>
        <p class="text-xs text-slate-500 mt-1 font-medium">Kendaraan Terdaftar</p>
    </div>

    {{-- Card: Transaksi Aktif --}}
    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon stat-icon-purple">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
            </div>
            <span class="badge badge-purple"><span class="badge-dot"></span>Aktif</span>
        </div>
        <p class="text-3xl font-bold text-white tracking-tight">{{ $transaksiAktif }}</p>
        <p class="text-xs text-slate-500 mt-1 font-medium">Kendaraan Dalam Parkir</p>
    </div>
</div>

<div class="glass-card p-6 card-accent animate-fade-in-up delay-5">
    <div class="flex items-center gap-4 mt-1">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-400/20 to-blue-500/20 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/></svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-white">Selamat Datang, {{ auth()->user()->nama_lengkap }}</h3>
            <p class="text-sm text-slate-400 mt-0.5">Anda login sebagai <span class="text-cyan-400 font-semibold">Admin</span>. Gunakan sidebar untuk mengelola master data sistem.</p>
        </div>
    </div>
</div>
@endsection
