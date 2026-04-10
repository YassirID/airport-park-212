@extends('layouts.app')
@section('title', 'Rekap Transaksi')
@section('page-title', 'Rekap Transaksi')

@section('content')
{{-- Filter Card --}}
<div class="glass-card-static p-5 mb-6 card-accent animate-fade-in-up">
    <form method="GET" action="{{ route('rekap.index') }}">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 mt-1">
            <div>
                <label class="form-label text-[10px]">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}" class="form-input text-sm">
            </div>
            <div>
                <label class="form-label text-[10px]">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir }}" class="form-input text-sm">
            </div>
            <div>
                <label class="form-label text-[10px]">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" class="form-input text-sm">
                    <option value="">Semua Jenis</option>
                    <option value="motor" {{ $jenisKendaraan === 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="mobil" {{ $jenisKendaraan === 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="bus" {{ $jenisKendaraan === 'bus' ? 'selected' : '' }}>Bus</option>
                </select>
            </div>
            <div>
                <label class="form-label text-[10px]">Petugas</label>
                <select name="petugas_id" class="form-input text-sm">
                    <option value="">Semua Petugas</option>
                    @foreach($petugasList as $p)
                        <option value="{{ $p->id }}" {{ $petugasId == $p->id ? 'selected' : '' }}>{{ $p->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label text-[10px]">Area Parkir</label>
                <select name="area_id" class="form-input text-sm">
                    <option value="">Semua Area</option>
                    @foreach($areaList as $a)
                        <option value="{{ $a->id }}" {{ $areaId == $a->id ? 'selected' : '' }}>{{ $a->nama_area }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label text-[10px]">Tipe Parkir</label>
                <select name="tipe" class="form-input text-sm">
                    <option value="">Semua</option>
                    <option value="inap" {{ $tipeFilter === 'inap' ? 'selected' : '' }}>Menginap (&gt;24j)</option>
                </select>
            </div>
        </div>
        <div class="flex items-center gap-3 mt-4">
            <button type="submit" class="btn-primary" data-no-loading>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/></svg>
                Filter
            </button>
            <a href="{{ route('rekap.index') }}" class="text-xs text-slate-500 hover:text-cyan-400 transition-colors font-medium">Reset Filter</a>
            <div class="flex-1"></div>
            <a href="{{ route('rekap.export-csv', request()->query()) }}" class="btn-secondary" data-no-loading>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Export CSV
            </a>
        </div>
    </form>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="glass-card p-4 animate-fade-in-up delay-1">
        <div class="flex items-center gap-3">
            <div class="stat-icon stat-icon-emerald">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 font-medium uppercase tracking-wider">Total Pendapatan</p>
                <p class="text-xl font-bold text-emerald-400">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
    <div class="glass-card p-4 animate-fade-in-up delay-1">
        <div class="flex items-center gap-3">
            <div class="stat-icon stat-icon-cyan">
                <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
 <path d="M5 13H8M2 9L4 10L5.27064 6.18807C5.53292 5.40125 5.66405 5.00784 5.90729 4.71698C6.12208 4.46013 6.39792 4.26132 6.70951 4.13878C7.06236 4 7.47705 4 8.30643 4H15.6936C16.523 4 16.9376 4 17.2905 4.13878C17.6021 4.26132 17.8779 4.46013 18.0927 4.71698C18.3359 5.00784 18.4671 5.40125 18.7294 6.18807L20 10L22 9M16 13H19M6.8 10H17.2C18.8802 10 19.7202 10 20.362 10.327C20.9265 10.6146 21.3854 11.0735 21.673 11.638C22 12.2798 22 13.1198 22 14.8V17.5C22 17.9647 22 18.197 21.9616 18.3902C21.8038 19.1836 21.1836 19.8038 20.3902 19.9616C20.197 20 19.9647 20 19.5 20H19C17.8954 20 17 19.1046 17 18C17 17.7239 16.7761 17.5 16.5 17.5H7.5C7.22386 17.5 7 17.7239 7 18C7 19.1046 6.10457 20 5 20H4.5C4.03534 20 3.80302 20 3.60982 19.9616C2.81644 19.8038 2.19624 19.1836 2.03843 18.3902C2 18.197 2 17.9647 2 17.5V14.8C2 13.1198 2 12.2798 2.32698 11.638C2.6146 11.0735 3.07354 10.6146 3.63803 10.327C4.27976 10 5.11984 10 6.8 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
 </svg>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 font-medium uppercase tracking-wider">Total Kendaraan</p>
                <p class="text-xl font-bold text-white">{{ number_format($totalKendaraan) }}</p>
            </div>
        </div>
    </div>
    <div class="glass-card p-4 animate-fade-in-up delay-2">
        <div class="flex items-center gap-3">
            <div class="stat-icon stat-icon-amber">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 font-medium uppercase tracking-wider">Rata-rata Durasi</p>
                <p class="text-xl font-bold text-white">{{ $rataRataDurasi }} <span class="text-sm text-slate-500 font-normal">jam</span></p>
            </div>
        </div>
    </div>
    <div class="glass-card p-4 animate-fade-in-up delay-2">
        <div class="flex items-center gap-3">
            <div class="stat-icon stat-icon-purple">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/></svg>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 font-medium uppercase tracking-wider">Rata-rata Biaya</p>
                <p class="text-xl font-bold text-white">Rp {{ number_format($rataRataBiaya, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Breakdown per Jenis (mini) --}}
@if($breakdownJenis->count() > 0)
<div class="flex flex-wrap gap-3 mb-5 animate-fade-in-up delay-3">
    @foreach($breakdownJenis as $bj)
    @php $color = match($bj->jenis_kendaraan) { 'motor' => 'cyan', 'mobil' => 'emerald', 'bus' => 'amber', default => 'slate' }; @endphp
    <div class="bg-{{ $color }}-500/10 border border-{{ $color }}-500/20 rounded-xl px-4 py-2.5 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-{{ $color }}-400"></span>
        <div>
            <span class="text-xs text-white font-semibold">{{ ucfirst($bj->jenis_kendaraan) }}</span>
            <span class="text-xs text-slate-500 ml-1">({{ $bj->jumlah }})</span>
        </div>
        <span class="text-xs text-{{ $color }}-400 font-bold">Rp {{ number_format($bj->total, 0, ',', '.') }}</span>
    </div>
    @endforeach
</div>
@endif

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
                    <td>
                        <span class="badge
                            @if($t->kendaraan->jenis_kendaraan === 'motor') badge-blue
                            @elseif($t->kendaraan->jenis_kendaraan === 'mobil') badge-emerald
                            @else badge-amber
                            @endif">
                            <span class="badge-dot"></span>{{ ucfirst($t->kendaraan->jenis_kendaraan) }}
                        </span>
                    </td>
                    <td class="text-slate-300">{{ $t->areaParkir->nama_area }}</td>
                    <td class="text-slate-400 text-xs">{{ $t->waktu_masuk->format('d/m/Y H:i') }}</td>
                    <td class="text-slate-400 text-xs">{{ $t->waktu_keluar->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($t->durasi_jam > 24)
                            <span class="text-purple-400 font-bold">{{ floor($t->durasi_jam / 24) }}h {{ $t->durasi_jam % 24 }}j</span>
                            <span class="badge badge-purple text-[9px] ml-1">Inap</span>
                        @else
                            <span class="text-slate-300">{{ $t->durasi_jam }} jam</span>
                        @endif
                    </td>
                    <td class="text-emerald-400 font-bold">Rp {{ number_format($t->biaya_total, 0, ',', '.') }}</td>
                    <td class="text-slate-300 text-xs">{{ $t->petugas->nama_lengkap }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-12">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-800/50 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75z"/></svg>
                            </div>
                            <p class="text-slate-500 text-sm">Tidak ada data transaksi pada filter ini</p>
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
