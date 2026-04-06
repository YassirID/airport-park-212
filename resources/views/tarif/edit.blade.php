@extends('layouts.app')
@section('title', 'Edit Tarif')
@section('page-title', 'Edit Tarif')

@section('content')
<div class="max-w-2xl animate-fade-in-up">
    <div class="glass-card-static p-6 card-accent">
        <form method="POST" action="{{ route('tarif.update', $tarif) }}" class="space-y-5 mt-2">
            @csrf @method('PUT')
            <div>
                <label class="form-label">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required class="form-input">
                    <option value="motor" {{ old('jenis_kendaraan', $tarif->jenis_kendaraan) == 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="mobil" {{ old('jenis_kendaraan', $tarif->jenis_kendaraan) == 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="bus" {{ old('jenis_kendaraan', $tarif->jenis_kendaraan) == 'bus' ? 'selected' : '' }}>Bus</option>
                </select>
            </div>

            <div class="rounded-xl border border-slate-700/30 p-4 space-y-4 bg-slate-800/20">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Tarif Reguler</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                Tarif Jam Pertama (Rp)
                            </span>
                        </label>
                        <input type="number" name="tarif_per_jam" value="{{ old('tarif_per_jam', $tarif->tarif_per_jam) }}" required min="0" step="500"
                            class="form-input">
                    </div>
                    <div>
                        <label class="form-label">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                                Tarif Tambahan / Jam (Rp)
                            </span>
                        </label>
                        <input type="number" name="tarif_tambahan_per_jam" value="{{ old('tarif_tambahan_per_jam', $tarif->tarif_tambahan_per_jam) }}" required min="0" step="500"
                            class="form-input">
                        <p class="text-[10px] text-slate-600 mt-1">Biaya tiap jam setelah jam pertama</p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-purple-500/20 p-4 space-y-4 bg-purple-500/5">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Tarif Inap (Parkir &gt; 24 Jam)</p>
                <div>
                    <label class="form-label">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                            Tarif Inap / Hari (Rp)
                        </span>
                    </label>
                    <input type="number" name="tarif_inap_per_hari" value="{{ old('tarif_inap_per_hari', $tarif->tarif_inap_per_hari) }}" required min="0" step="1000"
                        class="form-input">
                    <p class="text-[10px] text-slate-600 mt-1">Dikenakan jika durasi parkir melebihi 24 jam.</p>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Perbarui
                </button>
                <a href="{{ route('tarif.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
