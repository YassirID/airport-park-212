@extends('layouts.app')
@section('title', 'Area Parkir')
@section('page-title', 'Area Parkir')

@section('content')
<div class="flex items-center justify-between mb-6 animate-fade-in-up">
    <p class="text-sm text-slate-500">Kelola area parkir bandara</p>
    <a href="{{ route('area-parkir.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
        Tambah Area
    </a>
</div>

<div class="glass-card-static overflow-hidden animate-fade-in-up delay-1">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Area</th>
                    <th>Kapasitas</th>
                    <th>Terisi</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($areas as $i => $area)
                <tr>
                    <td class="text-slate-500">{{ $areas->firstItem() + $i }}</td>
                    <td class="text-white font-semibold">{{ $area->nama_area }}</td>
                    <td class="text-slate-300">{{ $area->kapasitas }}</td>
                    <td class="text-slate-300">{{ $area->terisi }}</td>
                    <td>
                        <span class="badge {{ $area->isFull() ? 'badge-red' : 'badge-emerald' }}">
                            <span class="badge-dot"></span>
                            {{ $area->isFull() ? 'Penuh' : 'Tersedia (' . $area->sisaKapasitas() . ')' }}
                        </span>
                    </td>
                    <td>
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('area-parkir.edit', $area) }}" class="btn-action btn-action-edit">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('area-parkir.destroy', $area) }}" onsubmit="return confirm('Yakin hapus area ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-action-delete">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-12">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-800/50 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21"/></svg>
                            </div>
                            <p class="text-slate-500 text-sm">Belum ada data area parkir</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-slate-700/30">{{ $areas->links() }}</div>
</div>
@endsection
