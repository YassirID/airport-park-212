<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::orderBy('created_at', 'desc')->paginate(10);
        return view('kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    /**
     * Format plat nomor ke format standar Indonesia: X 1234 XXX
     */
    private function formatPlatNomor(string $plat): string
    {
        // Remove all spaces and convert to uppercase
        $plat = strtoupper(preg_replace('/\s+/', '', $plat));

        // Match Indonesian plate pattern: letters + digits + letters
        if (preg_match('/^([A-Z]{1,2})(\d{1,4})([A-Z]{1,3})$/', $plat, $matches)) {
            return $matches[1] . ' ' . $matches[2] . ' ' . $matches[3];
        }

        // Return uppercase without extra spaces if pattern doesn't match
        return strtoupper(preg_replace('/\s+/', ' ', trim($plat)));
    }

    /**
     * Validate plat nomor format Indonesia
     */
    private function platValidationRules(): array
    {
        return [
            'required',
            'string',
            'min:4',
            'max:20',
            // Pattern: 1-2 huruf, spasi/tanpa spasi, 1-4 angka, spasi/tanpa spasi, 1-3 huruf
            'regex:/^[A-Za-z]{1,2}\s?\d{1,4}\s?[A-Za-z]{1,3}$/',
        ];
    }

    public function store(Request $request)
    {
        $request->merge([
            'plat_nomor' => $this->formatPlatNomor($request->plat_nomor ?? ''),
        ]);

        $request->validate([
            'plat_nomor' => array_merge($this->platValidationRules(), ['unique:tb_kendaraan,plat_nomor']),
            'jenis_kendaraan' => 'required|in:motor,mobil,bus',
            'pemilik' => 'nullable|string|max:255',
        ], [
            'plat_nomor.regex' => 'Format plat nomor tidak valid. Gunakan format: X 1234 XXX (contoh: B 1234 ABC)',
            'plat_nomor.unique' => 'Plat nomor ini sudah terdaftar.',
            'plat_nomor.min' => 'Plat nomor minimal 4 karakter.',
        ]);

        Kendaraan::create($request->only(['plat_nomor', 'jenis_kendaraan', 'pemilik']));

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Tambah Kendaraan',
            'keterangan' => 'Menambahkan kendaraan: ' . $request->plat_nomor,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->merge([
            'plat_nomor' => $this->formatPlatNomor($request->plat_nomor ?? ''),
        ]);

        $request->validate([
            'plat_nomor' => array_merge($this->platValidationRules(), ['unique:tb_kendaraan,plat_nomor,' . $kendaraan->id]),
            'jenis_kendaraan' => 'required|in:motor,mobil,bus',
            'pemilik' => 'nullable|string|max:255',
        ], [
            'plat_nomor.regex' => 'Format plat nomor tidak valid. Gunakan format: X 1234 XXX (contoh: B 1234 ABC)',
            'plat_nomor.unique' => 'Plat nomor ini sudah terdaftar.',
            'plat_nomor.min' => 'Plat nomor minimal 4 karakter.',
        ]);

        $kendaraan->update($request->only(['plat_nomor', 'jenis_kendaraan', 'pemilik']));

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Edit Kendaraan',
            'keterangan' => 'Mengedit kendaraan: ' . $kendaraan->plat_nomor,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $plat = $kendaraan->plat_nomor;
        $kendaraan->delete();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Hapus Kendaraan',
            'keterangan' => 'Menghapus kendaraan: ' . $plat,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
