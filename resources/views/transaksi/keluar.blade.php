@extends('layouts.app')
@section('title', 'Kendaraan Keluar')
@section('page-title', 'Kendaraan Keluar')

@section('content')
<div class="glass-card-static p-6 mb-6 animate-fade-in-up">
    <div class="flex items-center gap-4">
        <div class="stat-icon stat-icon-red">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-white">Proses Kendaraan Keluar</h3>
            <p class="text-xs text-slate-500 mt-0.5">Pilih kendaraan yang akan diproses keluar dari area parkir</p>
        </div>
    </div>
</div>

@if($transaksiAktif->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    @foreach($transaksiAktif as $i => $t)
    @php
        $durasiMenit = $t->waktu_masuk->diffInMinutes(now());
        $durasiJam = max(1, ceil($durasiMenit / 60));
        $isInap = $durasiJam > 24;

        // Hitung estimasi biaya
        $tarif = \App\Models\Tarif::where('jenis_kendaraan', $t->kendaraan->jenis_kendaraan)->first();
        $estimasi = $tarif ? $tarif->hitungBiaya($durasiMenit) : ['biaya_total' => $durasiJam * 5000, 'tipe' => 'reguler', 'durasi_jam' => $durasiJam];
    @endphp
    <div class="glass-card p-5 animate-fade-in-up animate-stagger {{ $isInap ? '!border-purple-500/30' : '' }}">
        <div class="flex items-center justify-between mb-4">
            <span class="text-lg font-bold text-white font-mono tracking-wide">{{ $t->kendaraan->plat_nomor }}</span>
            @if($isInap)
                <span class="badge badge-purple"><span class="badge-dot"></span>Inap</span>
            @else
                <span class="badge badge-amber"><span class="badge-dot"></span>Parkir</span>
            @endif
        </div>
        <div class="space-y-2.5 text-sm mb-5">
            <div class="flex justify-between items-center">
                <span class="text-slate-500 text-xs font-medium">Jenis</span>
                <span class="text-white font-medium">{{ ucfirst($t->kendaraan->jenis_kendaraan) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500 text-xs font-medium">Area</span>
                <span class="text-white font-medium">{{ $t->areaParkir->nama_area }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500 text-xs font-medium">Masuk</span>
                <span class="text-slate-300 text-xs">{{ $t->waktu_masuk->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between items-center pt-1 border-t border-slate-700/30">
                <span class="text-slate-500 text-xs font-medium">Durasi</span>
                <span class="font-bold {{ $isInap ? 'text-purple-400' : 'text-cyan-400' }}">
                    @if($isInap)
                        {{ floor($durasiJam / 24) }} hari {{ $durasiJam % 24 }} jam
                    @else
                        {{ $durasiJam }} jam
                    @endif
                </span>
            </div>
            <div class="flex justify-between items-center pt-1 border-t border-slate-700/30">
                <span class="text-slate-500 text-xs font-medium">Estimasi Biaya</span>
                <span class="text-emerald-400 font-bold">Rp {{ number_format($estimasi['biaya_total'], 0, ',', '.') }}</span>
            </div>
        </div>
        <form method="POST" action="{{ route('transaksi.prosesKeluar', $t) }}" onsubmit="return confirm('Proses kendaraan {{ $t->kendaraan->plat_nomor }} keluar?\nEstimasi biaya: Rp {{ number_format($estimasi['biaya_total'], 0, ',', '.') }}')">
            @csrf @method('PUT')
            <button type="submit" class="btn-danger w-full justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
                Proses Keluar — Rp {{ number_format($estimasi['biaya_total'], 0, ',', '.') }}
            </button>
        </form>
    </div>
    @endforeach
</div>
@else
<div class="glass-card-static p-16 text-center animate-fade-in-up delay-1">
    <div class="flex flex-col items-center gap-4">
        <div class="w-16 h-16 rounded-2xl bg-slate-800/50 flex items-center justify-center">
            <svg class="w-8 h-8 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
        </div>
        <p class="text-slate-500 text-lg font-medium">Tidak ada kendaraan yang sedang parkir</p>
    </div>
</div>
@endif
@endsection
