@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('content')
<div class="flex items-center justify-between mb-6 animate-fade-in-up">
    <p class="text-sm text-slate-500">Daftar seluruh transaksi parkir</p>
    <div class="flex gap-2">
        <a href="{{ route('transaksi.masuk') }}" class="btn-success text-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
            Masuk
        </a>
        <a href="{{ route('transaksi.keluar') }}" class="btn-danger text-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
            Keluar
        </a>
    </div>
</div>

<div class="glass-card-static overflow-hidden animate-fade-in-up delay-1">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Plat Nomor</th>
                    <th>Jenis</th>
                    <th>Area</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Durasi</th>
                    <th>Biaya</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
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
                    <td class="text-slate-400 text-xs">{{ $t->waktu_keluar ? $t->waktu_keluar->format('d/m/Y H:i') : '-' }}</td>
                    <td class="text-slate-300">{{ $t->durasi_jam ? $t->durasi_jam . ' jam' : '-' }}</td>
                    <td class="text-emerald-400 font-bold">{{ $t->biaya_total ? 'Rp ' . number_format($t->biaya_total, 0, ',', '.') : '-' }}</td>
                    <td>
                        <span class="badge {{ $t->status === 'masuk' ? 'badge-amber' : 'badge-emerald' }}">
                            <span class="badge-dot"></span>
                            {{ ucfirst($t->status) }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if($t->status === 'keluar')
                            <a href="{{ route('transaksi.struk', $t) }}" class="btn-action btn-action-view">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                Struk
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-12">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-800/50 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="text-slate-500 text-sm">Belum ada data transaksi</p>
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
