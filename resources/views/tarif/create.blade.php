@extends('layouts.app')
@section('title', 'Tambah Tarif')
@section('page-title', 'Tambah Tarif')

@section('content')
<div class="max-w-2xl animate-fade-in-up">
    <div class="glass-card-static p-6 card-accent">
        {{-- Info --}}
        <div class="bg-cyan-500/10 border border-cyan-500/20 rounded-xl p-4 mb-6 mt-2">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-cyan-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                <div class="text-xs text-cyan-400/80 leading-relaxed">
                    <p class="font-semibold text-cyan-300 mb-1">Skema Perhitungan Tarif</p>
                    <ul class="space-y-1 list-disc list-inside">
                        <li><span class="text-white font-medium">Jam pertama</span> → dikenakan Tarif/Jam</li>
                        <li><span class="text-white font-medium">Jam ke-2 dst</span> → dikenakan Tarif Tambahan/Jam</li>
                        <li><span class="text-white font-medium">Lebih dari 24 jam</span> → Tarif Inap/Hari × jumlah hari + sisa jam dihitung normal</li>
                    </ul>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('tarif.store') }}" class="space-y-5">
            @csrf
            <div>
                <label class="form-label">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required class="form-input">
                    <option value="" disabled selected>Pilih jenis kendaraan</option>
                    <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="bus" {{ old('jenis_kendaraan') == 'bus' ? 'selected' : '' }}>Bus</option>
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
                        <input type="number" name="tarif_per_jam" value="{{ old('tarif_per_jam') }}" required min="0" step="500"
                            class="form-input" placeholder="5000">
                    </div>
                    <div>
                        <label class="form-label">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                                Tarif Tambahan / Jam (Rp)
                            </span>
                        </label>
                        <input type="number" name="tarif_tambahan_per_jam" value="{{ old('tarif_tambahan_per_jam') }}" required min="0" step="500"
                            class="form-input" placeholder="3000">
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
                    <input type="number" name="tarif_inap_per_hari" value="{{ old('tarif_inap_per_hari') }}" required min="0" step="1000"
                        class="form-input" placeholder="50000">
                    <p class="text-[10px] text-slate-600 mt-1">Dikenakan jika durasi parkir melebihi 24 jam. Sisa jam tetap dihitung tarif reguler.</p>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Simpan
                </button>
                <a href="{{ route('tarif.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
