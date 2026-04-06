<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarif = Tarif::orderBy('created_at', 'desc')->paginate(10);
        return view('tarif.index', compact('tarif'));
    }

    public function create()
    {
        return view('tarif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required|string|max:50|unique:tb_tarif,jenis_kendaraan',
            'tarif_per_jam' => 'required|numeric|min:0',
            'tarif_tambahan_per_jam' => 'required|numeric|min:0',
            'tarif_inap_per_hari' => 'required|numeric|min:0',
        ]);

        Tarif::create($request->only([
            'jenis_kendaraan', 'tarif_per_jam', 'tarif_tambahan_per_jam', 'tarif_inap_per_hari'
        ]));

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Tambah Tarif',
            'keterangan' => 'Menambahkan tarif untuk: ' . $request->jenis_kendaraan,
        ]);

        return redirect()->route('tarif.index')->with('success', 'Tarif berhasil ditambahkan.');
    }

    public function edit(Tarif $tarif)
    {
        return view('tarif.edit', compact('tarif'));
    }

    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'jenis_kendaraan' => 'required|string|max:50|unique:tb_tarif,jenis_kendaraan,' . $tarif->id,
            'tarif_per_jam' => 'required|numeric|min:0',
            'tarif_tambahan_per_jam' => 'required|numeric|min:0',
            'tarif_inap_per_hari' => 'required|numeric|min:0',
        ]);

        $tarif->update($request->only([
            'jenis_kendaraan', 'tarif_per_jam', 'tarif_tambahan_per_jam', 'tarif_inap_per_hari'
        ]));

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Edit Tarif',
            'keterangan' => 'Mengedit tarif: ' . $tarif->jenis_kendaraan,
        ]);

        return redirect()->route('tarif.index')->with('success', 'Tarif berhasil diperbarui.');
    }

    public function destroy(Tarif $tarif)
    {
        $jenis = $tarif->jenis_kendaraan;
        $tarif->delete();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Hapus Tarif',
            'keterangan' => 'Menghapus tarif: ' . $jenis,
        ]);

        return redirect()->route('tarif.index')->with('success', 'Tarif berhasil dihapus.');
    }
}
