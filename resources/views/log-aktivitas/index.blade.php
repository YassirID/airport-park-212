@extends('layouts.app')
@section('title', 'Log Aktivitas')
@section('page-title', 'Log Aktivitas')

@section('content')
<p class="text-sm text-slate-500 mb-6 animate-fade-in-up">Riwayat aktivitas pengguna dalam sistem</p>

<div class="glass-card-static overflow-hidden animate-fade-in-up delay-1">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Aktivitas</th>
                    <th>Keterangan</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $i => $log)
                <tr>
                    <td class="text-slate-500">{{ $logs->firstItem() + $i }}</td>
                    <td class="text-white font-semibold">{{ $log->user->nama_lengkap ?? '-' }}</td>
                    <td>
                        <span class="badge badge-cyan">
                            <span class="badge-dot"></span>
                            {{ $log->aktivitas }}
                        </span>
                    </td>
                    <td class="text-slate-300 max-w-xs truncate">{{ $log->keterangan ?? '-' }}</td>
                    <td class="text-slate-500 text-xs">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-12">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-800/50 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </div>
                            <p class="text-slate-500 text-sm">Belum ada log aktivitas</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-slate-700/30">{{ $logs->links() }}</div>
</div>
@endsection
