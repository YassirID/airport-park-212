@extends('layouts.app')
@section('title', 'Dashboard Owner')
@section('page-title', 'Dashboard Owner')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon stat-icon-cyan">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
            </div>
            <span class="badge badge-cyan"><span class="badge-dot"></span>Total</span>
        </div>
        <p class="text-3xl font-bold text-white tracking-tight">{{ $totalTransaksi }}</p>
        <p class="text-xs text-slate-500 mt-1 font-medium">Total Transaksi</p>
    </div>

    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon stat-icon-emerald">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
            </div>
            <span class="badge badge-emerald"><span class="badge-dot"></span>Hari Ini</span>
        </div>
        <p class="text-3xl font-bold text-emerald-400 tracking-tight">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
        <p class="text-xs text-slate-500 mt-1 font-medium">Pendapatan Hari Ini</p>
    </div>

    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon stat-icon-purple">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
            </div>
            <span class="badge badge-purple"><span class="badge-dot"></span>Bulan Ini</span>
        </div>
        <p class="text-3xl font-bold text-white tracking-tight">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
        <p class="text-xs text-slate-500 mt-1 font-medium">Pendapatan Bulan Ini</p>
    </div>
</div>

<div class="glass-card p-6 card-accent animate-fade-in-up delay-4">
    <div class="flex items-center gap-4 mt-1">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400/20 to-purple-500/20 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/></svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-white">Selamat Datang, {{ auth()->user()->nama_lengkap }}</h3>
            <p class="text-sm text-slate-400 mt-0.5">Anda login sebagai <span class="text-purple-400 font-semibold">Owner</span>. Gunakan menu Rekap Transaksi untuk melihat laporan pendapatan.</p>
        </div>
    </div>
</div>
@endsection
