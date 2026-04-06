@extends('layouts.app')
@section('title', 'Tambah User')
@section('page-title', 'Tambah User')

@section('content')
<div class="max-w-2xl animate-fade-in-up">
    <div class="glass-card-static p-6 card-accent">
        <form method="POST" action="{{ route('users.store') }}" class="space-y-5 mt-2">
            @csrf
            <div>
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                    class="form-input" placeholder="Masukkan nama lengkap">
            </div>
            <div>
                <label class="form-label">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                    class="form-input" placeholder="Masukkan username">
            </div>
            <div>
                <label class="form-label">Password</label>
                <input type="password" name="password" required
                    class="form-input" placeholder="Masukkan password (min 6 karakter)">
            </div>
            <div>
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="form-input" placeholder="Ulangi password">
            </div>
            <div>
                <label class="form-label">Role</label>
                <select name="role" required class="form-input">
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Simpan
                </button>
                <a href="{{ route('users.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
