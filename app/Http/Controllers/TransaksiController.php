<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use App\Models\Tarif;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['kendaraan', 'areaParkir', 'petugas'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('transaksi.index', compact('transaksi'));
    }

    public function masuk()
    {
        $areas = AreaParkir::all();
        $kendaraanList = Kendaraan::with(['transaksi' => function($q) {
            $q->where('status', 'masuk')->with('areaParkir');
        }])->orderBy('plat_nomor')->get();
        return view('transaksi.masuk', compact('areas', 'kendaraanList'));
    }

    public function storeMasuk(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:tb_kendaraan,id',
            'area_parkir_id' => 'required|exists:tb_area_parkir,id',
        ]);

        $area = AreaParkir::findOrFail($request->area_parkir_id);

        if ($area->isFull()) {
            return back()->with('error', 'Area parkir sudah penuh!')->withInput();
        }

        $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);

        // Check if kendaraan is already parked
        $sudahParkir = Transaksi::where('kendaraan_id', $kendaraan->id)
            ->where('status', 'masuk')
            ->exists();

        if ($sudahParkir) {
            return back()->with('error', 'Kendaraan dengan plat nomor ' . $kendaraan->plat_nomor . ' masih dalam area parkir!')->withInput();
        }

        // Create transaksi
        $transaksi = Transaksi::create([
            'kendaraan_id' => $kendaraan->id,
            'area_parkir_id' => $area->id,
            'waktu_masuk' => Carbon::now(),
            'status' => 'masuk',
            'petugas_id' => auth()->id(),
        ]);

        // Update area terisi
        $area->increment('terisi');

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Kendaraan Masuk',
            'keterangan' => 'Kendaraan ' . $kendaraan->plat_nomor . ' masuk ke ' . $area->nama_area,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Kendaraan ' . $kendaraan->plat_nomor . ' berhasil masuk parkir.');
    }

    public function keluarForm()
    {
        $transaksiAktif = Transaksi::with(['kendaraan', 'areaParkir'])
            ->where('status', 'masuk')
            ->orderBy('waktu_masuk', 'desc')
            ->get();
        return view('transaksi.keluar', compact('transaksiAktif'));
    }

    public function prosesKeluar(Request $request, Transaksi $transaksi)
    {
        if ($transaksi->status === 'keluar') {
            return back()->with('error', 'Transaksi ini sudah diselesaikan.');
        }

        $waktuKeluar = Carbon::now();
        $durasiMenit = $transaksi->waktu_masuk->diffInMinutes($waktuKeluar);

        // Get tarif and calculate billing
        $tarif = Tarif::where('jenis_kendaraan', $transaksi->kendaraan->jenis_kendaraan)->first();

        if ($tarif) {
            $billing = $tarif->hitungBiaya($durasiMenit);
        } else {
            // Fallback if no tarif defined
            $durasiJam = max(1, ceil($durasiMenit / 60));
            $billing = [
                'durasi_jam' => $durasiJam,
                'biaya_total' => $durasiJam * 5000,
                'tipe' => 'reguler',
            ];
        }

        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'durasi_jam' => $billing['durasi_jam'],
            'biaya_total' => $billing['biaya_total'],
            'status' => 'keluar',
        ]);

        // Decrement area terisi
        $transaksi->areaParkir->decrement('terisi');

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Kendaraan Keluar',
            'keterangan' => 'Kendaraan ' . $transaksi->kendaraan->plat_nomor
                . ' keluar (' . $billing['durasi_jam'] . ' jam'
                . ($billing['tipe'] === 'inap' ? ', inap ' . $billing['jumlah_hari'] . ' hari' : '')
                . '). Biaya: Rp ' . number_format($billing['biaya_total'], 0, ',', '.'),
        ]);

        return redirect()->route('transaksi.struk', $transaksi->id)->with('success', 'Kendaraan berhasil keluar parkir.');
    }

    public function cetakStruk(Transaksi $transaksi)
    {
        $transaksi->load(['kendaraan', 'areaParkir', 'petugas']);
        return view('transaksi.struk', compact('transaksi'));
    }
}
