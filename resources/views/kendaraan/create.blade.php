@extends('layouts.app')
@section('title', 'Tambah Kendaraan')
@section('page-title', 'Tambah Kendaraan')

@section('content')
<div class="max-w-2xl animate-fade-in-up">
    <div class="glass-card-static p-6 card-accent">
        {{-- Info Format --}}
        <div class="bg-cyan-500/10 border border-cyan-500/20 rounded-xl p-4 mb-6 mt-2">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-cyan-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                <div>
                    <p class="text-sm font-semibold text-cyan-300 mb-1">Format Plat Nomor (TNKB)</p>
                    <p class="text-xs text-cyan-400/80 leading-relaxed">Format: <span class="font-mono font-bold text-white">XX 1234 XXX</span> — Huruf depan (kode wilayah), angka (nomor registrasi), huruf belakang (seri). Contoh: <span class="font-mono text-white">B 1234 ABC</span>, <span class="font-mono text-white">D 5678 XY</span></p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('kendaraan.store') }}" class="space-y-5">
            @csrf
            <div>
                <label class="form-label">Plat Nomor (TNKB)</label>
                <div class="relative">
                    <input type="text" name="plat_nomor" id="plat_nomor" value="{{ old('plat_nomor') }}" required
                        class="form-input uppercase font-mono tracking-wider text-lg"
                        placeholder="B 1234 ABC"
                        maxlength="12"
                        autocomplete="off">
                </div>
                <p id="plat-preview" class="text-xs text-slate-500 mt-2 hidden">
                    Preview: <span id="plat-preview-text" class="font-mono text-cyan-400 font-bold"></span>
                </p>
                <p id="plat-error" class="text-xs text-red-400 mt-2 hidden"></p>
            </div>
            <div>
                <label class="form-label">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required class="form-input">
                    <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="bus" {{ old('jenis_kendaraan') == 'bus' ? 'selected' : '' }}>Bus</option>
                </select>
            </div>
            <div>
                <label class="form-label">Pemilik <span class="optional">(opsional)</span></label>
                <input type="text" name="pemilik" value="{{ old('pemilik') }}"
                    class="form-input" placeholder="Nama pemilik kendaraan">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary" id="submit-btn">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Simpan
                </button>
                <a href="{{ route('kendaraan.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('plat_nomor');
    const preview = document.getElementById('plat-preview');
    const previewText = document.getElementById('plat-preview-text');
    const errorText = document.getElementById('plat-error');

    if (!input) return;

    input.addEventListener('input', () => {
        let raw = input.value.toUpperCase().replace(/[^A-Z0-9 ]/g, '');
        input.value = raw;

        // Strip all spaces to validate
        let clean = raw.replace(/\s+/g, '');

        // Match Indonesian plate pattern
        let match = clean.match(/^([A-Z]{1,2})(\d{1,4})([A-Z]{0,3})$/);

        if (clean.length === 0) {
            preview.classList.add('hidden');
            errorText.classList.add('hidden');
            return;
        }

        if (match) {
            let formatted = match[1] + ' ' + match[2] + (match[3] ? ' ' + match[3] : '');
            previewText.textContent = formatted;
            preview.classList.remove('hidden');
            errorText.classList.add('hidden');
        } else {
            // Partial input — check if it could still be valid
            let partialLetters = clean.match(/^([A-Z]{1,2})/);
            if (partialLetters && clean.length <= 2) {
                preview.classList.add('hidden');
                errorText.classList.add('hidden');
            } else {
                errorText.textContent = 'Format tidak valid. Gunakan: Huruf (1-2) + Angka (1-4) + Huruf (1-3)';
                errorText.classList.remove('hidden');
                preview.classList.add('hidden');
            }
        }
    });

    // Auto-format on blur
    input.addEventListener('blur', () => {
        let clean = input.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
        let match = clean.match(/^([A-Z]{1,2})(\d{1,4})([A-Z]{1,3})$/);
        if (match) {
            input.value = match[1] + ' ' + match[2] + ' ' + match[3];
        }
    });
});
</script>
@endsection
