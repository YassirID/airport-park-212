@extends('layouts.app')
@section('title', 'Tambah Area Parkir')
@section('page-title', 'Tambah Area Parkir')

@section('content')
<div class="max-w-2xl animate-fade-in-up">
    <div class="glass-card-static p-6 card-accent">
        <form method="POST" action="{{ route('area-parkir.store') }}" class="space-y-5 mt-2">
            @csrf
            <div>
                <label class="form-label">Nama Area</label>
                <input type="text" name="nama_area" value="{{ old('nama_area') }}" required
                    class="form-input" placeholder="Contoh: Parkir Terminal A">
            </div>
            <div>
                <label class="form-label">Kapasitas</label>
                <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" required min="1"
                    class="form-input" placeholder="Jumlah slot parkir">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Simpan
                </button>
                <a href="{{ route('area-parkir.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
