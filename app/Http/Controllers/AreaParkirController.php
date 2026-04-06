<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class AreaParkirController extends Controller
{
    public function index()
    {
        $areas = AreaParkir::orderBy('created_at', 'desc')->paginate(10);
        return view('area-parkir.index', compact('areas'));
    }

    public function create()
    {
        return view('area-parkir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        AreaParkir::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi' => 0,
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Tambah Area Parkir',
            'keterangan' => 'Menambahkan area: ' . $request->nama_area,
        ]);

        return redirect()->route('area-parkir.index')->with('success', 'Area parkir berhasil ditambahkan.');
    }

    public function edit(AreaParkir $area_parkir)
    {
        return view('area-parkir.edit', ['area' => $area_parkir]);
    }

    public function update(Request $request, AreaParkir $area_parkir)
    {
        $request->validate([
            'nama_area' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $area_parkir->update([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Edit Area Parkir',
            'keterangan' => 'Mengedit area: ' . $area_parkir->nama_area,
        ]);

        return redirect()->route('area-parkir.index')->with('success', 'Area parkir berhasil diperbarui.');
    }

    public function destroy(AreaParkir $area_parkir)
    {
        $nama = $area_parkir->nama_area;
        $area_parkir->delete();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Hapus Area Parkir',
            'keterangan' => 'Menghapus area: ' . $nama,
        ]);

        return redirect()->route('area-parkir.index')->with('success', 'Area parkir berhasil dihapus.');
    }
}
