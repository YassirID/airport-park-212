@extends('layouts.app')
@section('title', 'Kendaraan Masuk')
@section('page-title', 'Kendaraan Masuk')

@section('content')
{{-- Header with Area Selector --}}
<div class="glass-card-static p-5 mb-6 animate-fade-in-up">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="stat-icon stat-icon-emerald">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white">Proses Kendaraan Masuk</h3>
                <p class="text-xs text-slate-500 mt-0.5">Cari kendaraan lalu klik tombol <span class="text-emerald-400 font-semibold">Masuk</span> untuk memproses</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-xs text-slate-500 font-medium">Total: <span class="text-white font-bold">{{ $kendaraanList->count() }}</span> kendaraan</div>
        </div>
    </div>
</div>

{{-- Area Parkir Status Cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6 animate-fade-in-up delay-1">
    @foreach($areas as $area)
    <div class="bg-slate-800/40 rounded-xl p-3.5 border border-slate-700/30">
        <p class="text-xs font-semibold text-white truncate">{{ $area->nama_area }}</p>
        <div class="flex items-center justify-between mt-2">
            <span class="text-lg font-bold {{ $area->isFull() ? 'text-red-400' : 'text-emerald-400' }}">{{ $area->sisaKapasitas() }}</span>
            <span class="text-[10px] text-slate-500 font-medium">sisa slot</span>
        </div>
        <div class="w-full bg-slate-700/50 rounded-full h-1.5 mt-2 overflow-hidden">
            <div class="h-1.5 rounded-full transition-all duration-700 {{ $area->isFull() ? 'bg-red-500' : ($area->terisi / max($area->kapasitas,1) > 0.7 ? 'bg-amber-500' : 'bg-emerald-500') }}"
                 style="width: {{ min(100, ($area->terisi / max($area->kapasitas,1)) * 100) }}%"></div>
        </div>
    </div>
    @endforeach
</div>

{{-- Search & Filter Bar --}}
<div class="glass-card-static p-4 mb-5 animate-fade-in-up delay-2">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
            </div>
            <input type="text" id="search-kendaraan" placeholder="Cari plat nomor, jenis, atau pemilik..."
                class="form-input pl-11 text-sm" autocomplete="off">
        </div>
        <div class="flex gap-2">
            <button type="button" class="filter-btn active text-sm px-4 py-2.5 rounded-xl border border-slate-700/50 bg-slate-800/40 text-slate-300 hover:text-white hover:border-slate-600 transition-all font-medium" data-filter="all">
                Semua
            </button>
            <button type="button" class="filter-btn text-sm px-4 py-2.5 rounded-xl border border-slate-700/50 bg-slate-800/40 text-slate-300 hover:text-white hover:border-slate-600 transition-all font-medium" data-filter="motor">
                Motor
            </button>
            <button type="button" class="filter-btn text-sm px-4 py-2.5 rounded-xl border border-slate-700/50 bg-slate-800/40 text-slate-300 hover:text-white hover:border-slate-600 transition-all font-medium" data-filter="mobil">
                Mobil
            </button>
            <button type="button" class="filter-btn text-sm px-4 py-2.5 rounded-xl border border-slate-700/50 bg-slate-800/40 text-slate-300 hover:text-white hover:border-slate-600 transition-all font-medium" data-filter="bus">
                Bus
            </button>
        </div>
    </div>
</div>

{{-- Vehicle Table --}}
<div class="glass-card-static overflow-hidden animate-fade-in-up delay-3">
    <div class="overflow-x-auto">
        <table class="data-table" id="kendaraan-table">
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Jenis</th>
                    <th>Pemilik</th>
                    <th>Status</th>
                    <th>Area Parkir</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kendaraanList as $k)
                @php
                    $sedangParkir = $k->transaksi->where('status', 'masuk')->first();
                @endphp
                <tr class="kendaraan-row" data-plat="{{ strtolower($k->plat_nomor) }}" data-jenis="{{ $k->jenis_kendaraan }}" data-pemilik="{{ strtolower($k->pemilik ?? '') }}">
                    <td class="text-white font-bold font-mono tracking-wide text-base">{{ $k->plat_nomor }}</td>
                    <td>
                        <span class="badge
                            @if($k->jenis_kendaraan === 'motor') badge-blue
                            @elseif($k->jenis_kendaraan === 'mobil') badge-emerald
                            @else badge-amber
                            @endif">
                            <span class="badge-dot"></span>
                            {{ ucfirst($k->jenis_kendaraan) }}
                        </span>
                    </td>
                    <td class="text-slate-300">{{ $k->pemilik ?? '-' }}</td>
                    <td>
                        @if($sedangParkir)
                            <span class="badge badge-amber"><span class="badge-dot"></span>Sedang Parkir</span>
                        @else
                            <span class="badge badge-emerald"><span class="badge-dot"></span>Tersedia</span>
                        @endif
                    </td>
                    <td>
                        @if($sedangParkir)
                            <span class="text-sm text-slate-400">{{ $sedangParkir->areaParkir->nama_area ?? '-' }}</span>
                        @else
                            <form method="POST" action="{{ route('transaksi.storeMasuk') }}" class="inline masuk-form">
                                @csrf
                                <input type="hidden" name="kendaraan_id" value="{{ $k->id }}">
                                <select name="area_parkir_id" required class="form-input text-xs py-1.5 px-2.5 min-w-[140px]">
                                    @foreach($areas as $area)
                                        @if(!$area->isFull())
                                        <option value="{{ $area->id }}">{{ $area->nama_area }} ({{ $area->sisaKapasitas() }})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </form>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($sedangParkir)
                            <span class="text-xs text-slate-600 italic">Sudah di parkir</span>
                        @else
                            <button type="button" class="btn-action inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-semibold bg-emerald-500/15 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500/25 hover:border-emerald-400/40 hover:shadow-lg hover:shadow-emerald-500/10 transition-all duration-200 masuk-btn" data-plat="{{ $k->plat_nomor }}">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                                Masuk
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr id="empty-row">
                    <td colspan="6" class="text-center py-12">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-800/50 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6"/></svg>
                            </div>
                            <p class="text-slate-500 text-sm">Belum ada kendaraan terdaftar. Hubungi admin untuk menambahkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- No results message --}}
    <div id="no-results" class="hidden py-12 text-center">
        <div class="flex flex-col items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-slate-800/50 flex items-center justify-center">
                <svg class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
            </div>
            <p class="text-slate-500 text-sm">Tidak ditemukan kendaraan yang cocok</p>
        </div>
    </div>

    {{-- Result count --}}
    <div class="px-5 py-3 border-t border-slate-700/30 flex items-center justify-between">
        <span id="result-count" class="text-xs text-slate-500">Menampilkan {{ $kendaraanList->count() }} kendaraan</span>
        <a href="{{ route('transaksi.index') }}" class="text-xs text-slate-500 hover:text-cyan-400 transition-colors font-medium">← Kembali ke Riwayat</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-kendaraan');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const rows = document.querySelectorAll('.kendaraan-row');
    const noResults = document.getElementById('no-results');
    const resultCount = document.getElementById('result-count');
    let activeFilter = 'all';

    // Search functionality
    function filterTable() {
        const query = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        rows.forEach(row => {
            const plat = row.dataset.plat;
            const jenis = row.dataset.jenis;
            const pemilik = row.dataset.pemilik;

            const matchesSearch = !query || plat.includes(query) || jenis.includes(query) || pemilik.includes(query);
            const matchesFilter = activeFilter === 'all' || jenis === activeFilter;

            if (matchesSearch && matchesFilter) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        noResults.classList.toggle('hidden', visibleCount > 0);
        resultCount.textContent = `Menampilkan ${visibleCount} dari ${rows.length} kendaraan`;
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterTable);
    }

    // Filter buttons
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.style.background = '';
                b.style.borderColor = '';
                b.style.color = '';
            });
            btn.classList.add('active');
            btn.style.background = 'rgba(6,182,212,0.15)';
            btn.style.borderColor = 'rgba(6,182,212,0.3)';
            btn.style.color = '#22d3ee';
            activeFilter = btn.dataset.filter;
            filterTable();
        });
    });

    // Set initial active button style
    const initialBtn = document.querySelector('.filter-btn.active');
    if (initialBtn) {
        initialBtn.style.background = 'rgba(6,182,212,0.15)';
        initialBtn.style.borderColor = 'rgba(6,182,212,0.3)';
        initialBtn.style.color = '#22d3ee';
    }

    // Masuk button click → submit form in same row
    document.querySelectorAll('.masuk-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const row = btn.closest('tr');
            const form = row.querySelector('.masuk-form');
            const plat = btn.dataset.plat;

            if (form && confirm(`Proses kendaraan ${plat} masuk parkir?`)) {
                form.submit();
            }
        });
    });
});
</script>
@endsection
