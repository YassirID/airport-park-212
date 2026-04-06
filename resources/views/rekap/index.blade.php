@extends('layouts.app')
@section('title', 'Rekap Transaksi')
@section('page-title', 'Rekap Transaksi')

@section('content')
{{-- Filter --}}
<div class="glass-card-static p-5 mb-6 card-accent animate-fade-in-up">
    <form method="GET" action="{{ route('rekap.index') }}" class="flex flex-wrap items-end gap-4 mt-1">
        <div>
            <label class="form-label text-xs">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}" class="form-input text-sm">
        </div>
        <div>
            <label class="form-label text-xs">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir }}" class="form-input text-sm">
        </div>
        <button type="submit" class="btn-primary" data-no-loading>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/></svg>
            Filter
        </button>
    </form>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
    <div class="glass-card p-5 animate-fade-in-up delay-2">
        <div class="flex items-center gap-4">
            <div class="stat-icon stat-icon-cyan">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0"/></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-medium">Total Kendaraan Keluar</p>
                <p class="text-2xl font-bold text-white mt-0.5">{{ $totalKendaraan }}</p>
            </div>
        </div>
    </div>
    <div class="glass-card p-5 animate-fade-in-up delay-3">
        <div class="flex items-center gap-4">
            <div class="stat-icon stat-icon-emerald">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-medium">Total Pendapatan</p>
                <p class="text-2xl font-bold text-emerald-400 mt-0.5">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="glass-card-static overflow-hidden animate-fade-in-up delay-4">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Plat Nomor</th>
                    <th>Jenis</th>
                    <th>Area</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Durasi</th>
                    <th>Biaya</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $i => $t)
                <tr>
                    <td class="text-slate-500">{{ $transaksi->firstItem() + $i }}</td>
                    <td class="text-white font-semibold font-mono">{{ $t->kendaraan->plat_nomor }}</td>
                    <td class="text-slate-300">{{ ucfirst($t->kendaraan->jenis_kendaraan) }}</td>
                    <td class="text-slate-300">{{ $t->areaParkir->nama_area }}</td>
                    <td class="text-slate-400 text-xs">{{ $t->waktu_masuk->format('d/m/Y H:i') }}</td>
                    <td class="text-slate-400 text-xs">{{ $t->waktu_keluar->format('d/m/Y H:i') }}</td>
                    <td class="text-slate-300">{{ $t->durasi_jam }} jam</td>
                    <td class="text-emerald-400 font-bold">Rp {{ number_format($t->biaya_total, 0, ',', '.') }}</td>
                    <td class="text-slate-300">{{ $t->petugas->nama_lengkap }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-12">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-800/50 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75z"/></svg>
                            </div>
                            <p class="text-slate-500 text-sm">Tidak ada data transaksi pada periode ini</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-slate-700/30">{{ $transaksi->links() }}</div>
</div>
@endsection
