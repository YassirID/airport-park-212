@extends('layouts.app')
@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon stat-icon-emerald">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
            </div>
            <span class="badge badge-emerald"><span class="badge-dot"></span>Aktif</span>
        </div>
        <p class="text-3xl font-bold text-white tracking-tight">{{ $transaksiAktif }}</p>
        <p class="text-xs text-slate-500 mt-1 font-medium">Kendaraan Sedang Parkir</p>
    </div>

    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-4">
            <div class="stat-icon stat-icon-cyan">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
            </div>
            <span class="badge badge-cyan"><span class="badge-dot"></span>Hari Ini</span>
        </div>
        <p class="text-3xl font-bold text-white tracking-tight">{{ $transaksiHariIni }}</p>
        <p class="text-xs text-slate-500 mt-1 font-medium">Transaksi Hari Ini</p>
    </div>
</div>

{{-- Quick Actions --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
    <a href="{{ route('transaksi.masuk') }}" class="group glass-card p-6 animate-fade-in-up delay-3 !border-emerald-500/20 hover:!border-emerald-400/40 hover:!shadow-emerald-500/10">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500/20 to-emerald-600/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-white">Kendaraan Masuk</h3>
                <p class="text-sm text-slate-400 mt-0.5">Catat kendaraan baru masuk parkir</p>
            </div>
            <svg class="w-5 h-5 text-slate-600 group-hover:text-emerald-400 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        </div>
    </a>
    <a href="{{ route('transaksi.keluar') }}" class="group glass-card p-6 animate-fade-in-up delay-4 !border-red-500/20 hover:!border-red-400/40 hover:!shadow-red-500/10">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-red-500/20 to-red-600/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-white">Kendaraan Keluar</h3>
                <p class="text-sm text-slate-400 mt-0.5">Proses kendaraan keluar & pembayaran</p>
            </div>
            <svg class="w-5 h-5 text-slate-600 group-hover:text-red-400 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        </div>
    </a>
</div>

{{-- Area Parkir Status --}}
<div class="glass-card-static p-6 animate-fade-in-up delay-5">
    <div class="flex items-center gap-3 mb-5">
        <div class="stat-icon stat-icon-cyan" style="width:2.25rem;height:2.25rem">
           <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
 <path d="M21 5L10 5M21 19L10 19M21 12L10 12M6 5C6 5.82843 5.32843 6.5 4.5 6.5C3.67157 6.5 3 5.82843 3 5C3 4.17157 3.67157 3.5 4.5 3.5C5.32843 3.5 6 4.17157 6 5ZM6 19C6 19.8284 5.32843 20.5 4.5 20.5C3.67157 20.5 3 19.8284 3 19C3 18.1716 3.67157 17.5 4.5 17.5C5.32843 17.5 6 18.1716 6 19ZM6 12C6 12.8284 5.32843 13.5 4.5 13.5C3.67157 13.5 3 12.8284 3 12C3 11.1716 3.67157 10.5 4.5 10.5C5.32843 10.5 6 11.1716 6 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
 </svg>
        </div>
        <h3 class="text-base font-bold text-white">Status Area Parkir</h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        @foreach($areaList as $area)
        <div class="bg-slate-800/40 rounded-xl p-4 border border-slate-700/30 hover:border-slate-600/50 transition-all duration-300">
            <p class="text-sm font-semibold text-white mb-3">{{ $area->nama_area }}</p>
            <div class="flex items-center justify-between text-xs text-slate-400 mb-2.5">
                <span class="font-medium">{{ $area->terisi }}/{{ $area->kapasitas }}</span>
                @if($area->isFull())
                    <span class="badge badge-red text-[10px] py-0.5 px-2"><span class="badge-dot" style="width:0.25rem;height:0.25rem"></span>Penuh</span>
                @else
                    <span class="badge badge-emerald text-[10px] py-0.5 px-2"><span class="badge-dot" style="width:0.25rem;height:0.25rem"></span>Tersedia</span>
                @endif
            </div>
            <div class="w-full bg-slate-700/50 rounded-full h-2 overflow-hidden">
                <div class="h-2 rounded-full transition-all duration-700 ease-out {{ $area->isFull() ? 'bg-gradient-to-r from-red-500 to-red-400' : ($area->terisi / max($area->kapasitas,1) > 0.7 ? 'bg-gradient-to-r from-amber-500 to-amber-400' : 'bg-gradient-to-r from-emerald-500 to-emerald-400') }}"
                     style="width: {{ min(100, ($area->terisi / max($area->kapasitas,1)) * 100) }}%"></div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
