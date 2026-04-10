@extends('layouts.app')
@section('title', 'Dashboard Owner')
@section('page-title', 'Dashboard Eksekutif')

@section('content')
{{-- Row 1: Stat Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    {{-- Pendapatan Hari Ini --}}
    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-3">
            <div class="stat-icon stat-icon-emerald">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
            </div>
            <span class="badge badge-emerald"><span class="badge-dot"></span>Hari Ini</span>
        </div>
        <p class="text-2xl font-bold text-emerald-400 tracking-tight">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
        <div class="flex items-center gap-1.5 mt-2">
            @if($pendapatanKemarin > 0)
                @php $persen = round((($pendapatanHariIni - $pendapatanKemarin) / $pendapatanKemarin) * 100); @endphp
                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded {{ $persen >= 0 ? 'bg-emerald-500/15 text-emerald-400' : 'bg-red-500/15 text-red-400' }}">
                    {{ $persen >= 0 ? '+' : '' }}{{ $persen }}%
                </span>
                <span class="text-[10px] text-slate-600">vs kemarin</span>
            @else
                <span class="text-[10px] text-slate-600">{{ $transaksiHariIni }} transaksi</span>
            @endif
        </div>
    </div>

    {{-- Pendapatan Bulan Ini --}}
    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-3">
            <div class="stat-icon stat-icon-purple">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
            </div>
            <span class="badge badge-purple"><span class="badge-dot"></span>Bulan Ini</span>
        </div>
        <p class="text-2xl font-bold text-white tracking-tight">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
        <p class="text-[10px] text-slate-600 mt-2">{{ now()->translatedFormat('F Y') }}</p>
    </div>

    {{-- Total Transaksi --}}
    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-3">
            <div class="stat-icon stat-icon-cyan">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
            </div>
            <span class="badge badge-cyan"><span class="badge-dot"></span>Total</span>
        </div>
        <p class="text-2xl font-bold text-white tracking-tight">{{ number_format($totalTransaksi) }}</p>
        <p class="text-[10px] text-slate-600 mt-2">Seluruh transaksi</p>
    </div>

    {{-- Kendaraan Aktif --}}
    <div class="glass-card p-5 animate-fade-in-up animate-stagger">
        <div class="flex items-center justify-between mb-3">
            <div class="stat-icon stat-icon-amber">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
            </div>
            <span class="badge badge-amber"><span class="badge-dot"></span>Aktif</span>
        </div>
        <p class="text-2xl font-bold text-amber-400 tracking-tight">{{ $kendaraanAktif }}</p>
        <p class="text-[10px] text-slate-600 mt-2">Sedang parkir</p>
    </div>
</div>

{{-- Row 2: Area Capacity --}}
<div class="glass-card-static p-5 mb-6 animate-fade-in-up delay-2">
    <div class="flex items-center justify-between mb-4">
        <h4 class="text-sm font-bold text-white flex items-center gap-2">
            <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
            Status Kapasitas Area Real-time
        </h4>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-{{ min(count($areas), 4) }} gap-3">
        @foreach($areas as $area)
        @php $persen = $area->kapasitas > 0 ? round(($area->terisi / $area->kapasitas) * 100) : 0; @endphp
        <div class="bg-slate-800/40 rounded-xl p-4 border border-slate-700/30">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm font-bold text-white truncate">{{ $area->nama_area }}</p>
                <span class="text-xs font-bold {{ $persen >= 90 ? 'text-red-400' : ($persen >= 70 ? 'text-amber-400' : 'text-emerald-400') }}">{{ $persen }}%</span>
            </div>
            <div class="w-full bg-slate-700/50 rounded-full h-2 overflow-hidden mb-2">
                <div class="h-2 rounded-full transition-all duration-700 {{ $persen >= 90 ? 'bg-red-500' : ($persen >= 70 ? 'bg-amber-500' : 'bg-emerald-500') }}"
                     style="width: {{ $persen }}%"></div>
            </div>
            <p class="text-[10px] text-slate-500">{{ $area->terisi }} / {{ $area->kapasitas }} slot terisi</p>
        </div>
        @endforeach
    </div>
</div>

{{-- Row 3: Kendaraan Sedang Parkir (NEW) --}}
<div class="glass-card-static overflow-hidden mb-6 animate-fade-in-up delay-2">
    <div class="p-5 border-b border-slate-700/30 flex items-center justify-between">
        <h4 class="text-sm font-bold text-white flex items-center gap-2">
            <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
            Kendaraan Sedang Parkir
        </h4>
        <span class="badge badge-cyan"><span class="badge-dot"></span>{{ $kendaraanSedangParkir->count() }} kendaraan</span>
    </div>

    @if($kendaraanSedangParkir->count() > 0)
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Jenis</th>
                    <th>Area Parkir</th>
                    <th>Waktu Masuk</th>
                    <th>Durasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kendaraanSedangParkir as $sp)
                @php
                    $durasiMenit = $sp->waktu_masuk->diffInMinutes(now());
                    $jam = floor($durasiMenit / 60);
                    $menit = $durasiMenit % 60;
                    $isLong = $jam >= 24;
                    $isWarn = $jam >= 12 && $jam < 24;
                @endphp
                <tr>
                    <td class="text-white font-bold font-mono">{{ $sp->kendaraan->plat_nomor }}</td>
                    <td class="text-slate-300">{{ ucfirst($sp->kendaraan->jenis_kendaraan) }}</td>
                    <td class="text-slate-300">{{ $sp->areaParkir->nama_area }}</td>
                    <td class="text-slate-400 text-xs">{{ $sp->waktu_masuk->format('d/m/Y H:i') }}</td>
                    <td>
                        <span class="font-mono font-bold {{ $isLong ? 'text-red-400' : ($isWarn ? 'text-amber-400' : 'text-cyan-400') }}">
                            @if($jam >= 24)
                                {{ floor($jam / 24) }}h {{ $jam % 24 }}j {{ $menit }}m
                            @elseif($jam > 0)
                                {{ $jam }}j {{ $menit }}m
                            @else
                                {{ $menit }}m
                            @endif
                        </span>
                    </td>
                    <td>
                        @if($isLong)
                            <span class="badge badge-red"><span class="badge-dot"></span>Menginap</span>
                        @elseif($isWarn)
                            <span class="badge badge-amber"><span class="badge-dot"></span>Lama</span>
                        @else
                            <span class="badge badge-emerald"><span class="badge-dot"></span>Aktif</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="p-10 text-center">
        <p class="text-sm text-slate-500">Tidak ada kendaraan yang sedang parkir</p>
    </div>
    @endif
</div>

{{-- Row 4: Chart + Revenue Breakdown --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
    {{-- 7-Day Revenue Chart --}}
    <div class="lg:col-span-2 glass-card-static p-5 animate-fade-in-up delay-3">
        <h4 class="text-sm font-bold text-white flex items-center gap-2 mb-5">
            <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
            Tren Pendapatan 7 Hari Terakhir
        </h4>
        @php $maxPendapatan = max(1, collect($tren7Hari)->max('pendapatan')); @endphp
        <div class="flex items-end justify-between gap-2 h-44">
            @foreach($tren7Hari as $day)
            @php $heightPct = ($day['pendapatan'] / $maxPendapatan) * 100; @endphp
            <div class="flex-1 flex flex-col items-center gap-1.5 group cursor-default relative">
                {{-- Tooltip --}}
                <div class="absolute bottom-full mb-2 hidden group-hover:block z-10">
                    <div class="bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 shadow-xl text-center whitespace-nowrap">
                        <p class="text-[10px] text-slate-400">{{ $day['hari'] }}, {{ $day['tanggal'] }}</p>
                        <p class="text-sm font-bold text-emerald-400">Rp {{ number_format($day['pendapatan'], 0, ',', '.') }}</p>
                        <p class="text-[10px] text-slate-500">{{ $day['jumlah'] }} transaksi</p>
                    </div>
                </div>
                {{-- Bar --}}
                <div class="w-full rounded-lg bg-gradient-to-t from-cyan-500/80 to-cyan-400/60 transition-all duration-500 group-hover:from-cyan-400 group-hover:to-cyan-300 group-hover:shadow-lg group-hover:shadow-cyan-500/20"
                     style="height: {{ max(4, $heightPct) }}%; min-height: 4px;"></div>
                <span class="text-[10px] text-slate-500 font-medium">{{ $day['hari'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Revenue by Vehicle Type --}}
    <div class="glass-card-static p-5 animate-fade-in-up delay-4">
        <h4 class="text-sm font-bold text-white flex items-center gap-2 mb-5">
            <svg class="w-4 h-4 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"/></svg>
            Pendapatan per Jenis
        </h4>
        @php $totalJenis = max(1, $pendapatanPerJenis->sum('total')); @endphp
        <div class="space-y-4">
            @forelse($pendapatanPerJenis as $p)
            @php
                $pctJenis = round(($p->total / $totalJenis) * 100);
                $color = match($p->jenis_kendaraan) { 'motor' => 'cyan', 'mobil' => 'emerald', 'bus' => 'amber', default => 'slate' };
            @endphp
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-sm font-semibold text-white">{{ ucfirst($p->jenis_kendaraan) }}</span>
                    <span class="text-xs text-{{ $color }}-400 font-bold">{{ $pctJenis }}%</span>
                </div>
                <div class="w-full bg-slate-700/50 rounded-full h-2.5 overflow-hidden">
                    <div class="h-2.5 rounded-full bg-{{ $color }}-500 transition-all duration-700" style="width: {{ $pctJenis }}%"></div>
                </div>
                <div class="flex justify-between mt-1">
                    <span class="text-[10px] text-slate-500">{{ $p->jumlah }} kendaraan</span>
                    <span class="text-[10px] text-slate-400 font-semibold">Rp {{ number_format($p->total, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <p class="text-sm text-slate-500 text-center py-8">Belum ada data bulan ini</p>
            @endforelse
        </div>
    </div>
</div>

{{-- Row 5: Peak Hours + Popular Areas --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-6">
    {{-- Peak Hours --}}
    <div class="glass-card-static p-5 animate-fade-in-up delay-5">
        <h4 class="text-sm font-bold text-white flex items-center gap-2 mb-4">
            <svg class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Analitik Jam Sibuk
            <span class="text-[10px] text-slate-600 font-normal ml-1">(Bulan Ini)</span>
        </h4>
        @php $maxJam = max(1, collect($jamSibukData)->max('jumlah')); @endphp
        <div class="flex items-end gap-[3px] h-28">
            @foreach($jamSibukData as $j)
            @php
                $hPct = ($j['jumlah'] / $maxJam) * 100;
                $isHot = $j['jumlah'] >= ($maxJam * 0.7);
            @endphp
            <div class="flex-1 rounded-t transition-all duration-300 cursor-default group relative
                {{ $isHot ? 'bg-gradient-to-t from-amber-500 to-amber-400 shadow-sm shadow-amber-500/20' : 'bg-slate-700/60 hover:bg-slate-600/60' }}"
                 style="height: {{ max(2, $hPct) }}%;" title="{{ $j['jam'] }} — {{ $j['jumlah'] }} kendaraan">
                <div class="absolute bottom-full mb-1 left-1/2 -translate-x-1/2 hidden group-hover:block z-10">
                    <div class="bg-slate-800 border border-slate-700 rounded px-2 py-1 shadow-xl text-center whitespace-nowrap">
                        <p class="text-[10px] text-white font-bold">{{ $j['jam'] }}</p>
                        <p class="text-[10px] text-slate-400">{{ $j['jumlah'] }} kendaraan</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="flex justify-between mt-2">
            <span class="text-[10px] text-slate-600">00:00</span>
            <span class="text-[10px] text-slate-600">06:00</span>
            <span class="text-[10px] text-slate-600">12:00</span>
            <span class="text-[10px] text-slate-600">18:00</span>
            <span class="text-[10px] text-slate-600">23:00</span>
        </div>
        @php $peakHours = collect($jamSibukData)->sortByDesc('jumlah')->take(3); @endphp
        @if($peakHours->first()['jumlah'] > 0)
        <div class="mt-4 pt-3 border-t border-slate-700/30">
            <p class="text-[10px] text-slate-500 uppercase font-bold tracking-widest mb-2">Top 3 Jam Tersibuk</p>
            <div class="flex gap-2">
                @foreach($peakHours as $ph)
                <span class="text-xs px-2.5 py-1 rounded-lg bg-amber-500/10 text-amber-400 font-bold border border-amber-500/20">
                    {{ $ph['jam'] }} <span class="text-amber-500/60 font-normal">({{ $ph['jumlah'] }})</span>
                </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- Popular Areas --}}
    <div class="glass-card-static p-5 animate-fade-in-up delay-5">
        <h4 class="text-sm font-bold text-white flex items-center gap-2 mb-4">
            <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
            Area Terpopuler
            <span class="text-[10px] text-slate-600 font-normal ml-1">(Bulan Ini)</span>
        </h4>
        @php $maxAreaTx = max(1, $areaTerpopuler->max('total_transaksi')); @endphp
        <div class="space-y-3">
            @forelse($areaTerpopuler as $idx => $a)
            <div class="flex items-center gap-3">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0
                    {{ $idx === 0 ? 'bg-amber-500/20 text-amber-400' : ($idx === 1 ? 'bg-slate-600/40 text-slate-300' : 'bg-slate-700/40 text-slate-500') }}">
                    {{ $idx + 1 }}
                </span>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-semibold text-white truncate">{{ $a->nama_area }}</span>
                        <span class="text-xs text-emerald-400 font-bold ml-2">Rp {{ number_format($a->total_pendapatan, 0, ',', '.') }}</span>
                    </div>
                    <div class="w-full bg-slate-700/50 rounded-full h-1.5 overflow-hidden">
                        <div class="h-1.5 rounded-full bg-emerald-500 transition-all duration-700" style="width: {{ ($a->total_transaksi / $maxAreaTx) * 100 }}%"></div>
                    </div>
                    <p class="text-[10px] text-slate-500 mt-0.5">{{ $a->total_transaksi }} transaksi</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-slate-500 text-center py-8">Belum ada data bulan ini</p>
            @endforelse
        </div>
    </div>
</div>

{{-- Row 6: Overnight Vehicles --}}
@if($kendaraanMenginap->count() > 0)
<div class="glass-card-static overflow-hidden animate-fade-in-up delay-6">
    <div class="p-5 border-b border-slate-700/30 flex items-center justify-between">
        <h4 class="text-sm font-bold text-white flex items-center gap-2">
            <svg class="w-4 h-4 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/></svg>
            Kendaraan Menginap
            <span class="text-[10px] text-slate-600 font-normal ml-1">(Parkir &gt; 24 jam)</span>
        </h4>
        <span class="badge badge-purple"><span class="badge-dot"></span>{{ $kendaraanMenginap->count() }} kendaraan</span>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Jenis</th>
                    <th>Area</th>
                    <th>Masuk</th>
                    <th>Durasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kendaraanMenginap as $m)
                @php $durasi = $m->waktu_masuk->diffInHours(now()); @endphp
                <tr>
                    <td class="text-white font-bold font-mono">{{ $m->kendaraan->plat_nomor }}</td>
                    <td class="text-slate-300">{{ ucfirst($m->kendaraan->jenis_kendaraan) }}</td>
                    <td class="text-slate-300">{{ $m->areaParkir->nama_area }}</td>
                    <td class="text-slate-400 text-xs">{{ $m->waktu_masuk->format('d/m/Y H:i') }}</td>
                    <td class="text-purple-400 font-bold">{{ floor($durasi / 24) }}h {{ $durasi % 24 }}j</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
