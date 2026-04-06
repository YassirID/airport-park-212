@extends('layouts.app')
@section('title', 'Struk Parkir')
@section('page-title', 'Struk Parkir')

@section('content')
@php
    $tarif = \App\Models\Tarif::where('jenis_kendaraan', $transaksi->kendaraan->jenis_kendaraan)->first();
    $durasiMenit = $transaksi->waktu_masuk->diffInMinutes($transaksi->waktu_keluar);
    $billing = $tarif ? $tarif->hitungBiaya($durasiMenit) : null;
@endphp

<div class="max-w-md mx-auto animate-fade-in-up">
    <div class="bg-white text-slate-800 rounded-2xl shadow-2xl shadow-black/30 overflow-hidden" id="struk">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-600 p-7 text-center text-white animate-gradient relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(rgba(255,255,255,0.3) 1px, transparent 1px); background-size: 20px 20px;"></div>
            <div class="relative">
                <div class="w-12 h-12 mx-auto bg-white/20 rounded-xl flex items-center justify-center mb-3 backdrop-blur-sm">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5A1.5 1.5 0 0011.5 2 1.5 1.5 0 0010 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
                </div>
                <h2 class="text-xl font-bold tracking-tight">TEMAN PANDARA</h2>
                <p class="text-sm opacity-75 mt-0.5">Sistem Parkir Bandara</p>
            </div>
        </div>

        {{-- Ticket Number --}}
        <div class="bg-slate-50 px-6 py-3.5 text-center border-b border-dashed border-slate-300">
            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">No. Transaksi</p>
            <p class="text-lg font-bold text-slate-800 font-mono mt-0.5">#TRX-{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}</p>
        </div>

        {{-- Details --}}
        <div class="p-6 space-y-3.5">
            <div class="flex justify-between text-sm">
                <span class="text-slate-400 font-medium">Plat Nomor</span>
                <span class="font-bold font-mono text-slate-800">{{ $transaksi->kendaraan->plat_nomor }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-400 font-medium">Jenis Kendaraan</span>
                <span class="font-semibold text-slate-700">{{ ucfirst($transaksi->kendaraan->jenis_kendaraan) }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-400 font-medium">Area Parkir</span>
                <span class="font-semibold text-slate-700">{{ $transaksi->areaParkir->nama_area }}</span>
            </div>
            <div class="border-t border-dashed border-slate-200 my-1"></div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-400 font-medium">Waktu Masuk</span>
                <span class="font-semibold text-slate-700">{{ $transaksi->waktu_masuk->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-400 font-medium">Waktu Keluar</span>
                <span class="font-semibold text-slate-700">{{ $transaksi->waktu_keluar->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-400 font-medium">Durasi</span>
                <span class="font-bold text-slate-800">
                    @if($billing && $billing['tipe'] === 'inap')
                        {{ $billing['jumlah_hari'] }} hari {{ $billing['sisa_jam'] }} jam
                    @else
                        {{ $transaksi->durasi_jam }} Jam
                    @endif
                </span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-400 font-medium">Petugas</span>
                <span class="font-semibold text-slate-700">{{ $transaksi->petugas->nama_lengkap }}</span>
            </div>
        </div>

        {{-- Billing Breakdown --}}
        @if($billing && $tarif)
        <div class="px-6 pb-5">
            <div class="bg-slate-50 rounded-xl p-4 space-y-2.5 border border-slate-200">
                <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-3">Rincian Biaya</p>

                @if($billing['tipe'] === 'inap')
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Tarif Inap ({{ $billing['jumlah_hari'] }} hari × Rp {{ number_format($tarif->tarif_inap_per_hari, 0, ',', '.') }})</span>
                        <span class="font-semibold text-slate-700">Rp {{ number_format($billing['biaya_inap'], 0, ',', '.') }}</span>
                    </div>
                    @if($billing['sisa_jam'] > 0)
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Sisa {{ $billing['sisa_jam'] }} jam (1 jam × Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}{{ $billing['sisa_jam'] > 1 ? ' + ' . ($billing['sisa_jam'] - 1) . ' jam × Rp ' . number_format($tarif->tarif_tambahan_per_jam ?: $tarif->tarif_per_jam, 0, ',', '.') : '' }})</span>
                        <span class="font-semibold text-slate-700">Rp {{ number_format($billing['biaya_sisa'], 0, ',', '.') }}</span>
                    </div>
                    @endif
                @else
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Jam pertama (× Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }})</span>
                        <span class="font-semibold text-slate-700">Rp {{ number_format($billing['biaya_jam_pertama'], 0, ',', '.') }}</span>
                    </div>
                    @if($billing['durasi_jam'] > 1)
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Tambahan {{ $billing['durasi_jam'] - 1 }} jam (× Rp {{ number_format($tarif->tarif_tambahan_per_jam ?: $tarif->tarif_per_jam, 0, ',', '.') }})</span>
                        <span class="font-semibold text-slate-700">Rp {{ number_format($billing['biaya_tambahan'], 0, ',', '.') }}</span>
                    </div>
                    @endif
                @endif
            </div>
        </div>
        @endif

        {{-- Total --}}
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 p-6 text-center">
            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1.5">Total Biaya</p>
            <p class="text-3xl font-bold text-emerald-400 tracking-tight">Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}</p>
            @if($billing && $billing['tipe'] === 'inap')
                <p class="text-xs text-purple-400 font-semibold mt-1">Tarif Inap ({{ $billing['jumlah_hari'] }} hari {{ $billing['sisa_jam'] }} jam)</p>
            @endif
        </div>

        {{-- Footer --}}
        <div class="p-4 text-center bg-slate-50 border-t border-slate-200">
            <p class="text-xs text-slate-400 font-medium">Terima kasih telah menggunakan layanan kami</p>
            <p class="text-xs text-slate-400 mt-0.5">{{ $transaksi->waktu_keluar->format('d F Y, H:i') }} WIB</p>
        </div>
    </div>

    {{-- Print Button --}}
    <div class="flex gap-3 justify-center mt-6">
        <button onclick="window.print()" class="btn-primary" data-no-loading>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
            Cetak Struk
        </button>
        <a href="{{ route('transaksi.index') }}" class="btn-secondary">Kembali</a>
    </div>
</div>
@endsection
