<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai', Carbon::now()->startOfMonth()->toDateString());
        $tanggalAkhir = $request->input('tanggal_akhir', Carbon::now()->toDateString());

        $transaksi = Transaksi::with(['kendaraan', 'areaParkir', 'petugas'])
            ->where('status', 'keluar')
            ->whereDate('waktu_keluar', '>=', $tanggalMulai)
            ->whereDate('waktu_keluar', '<=', $tanggalAkhir)
            ->orderBy('waktu_keluar', 'desc')
            ->paginate(20);

        $totalPendapatan = Transaksi::where('status', 'keluar')
            ->whereDate('waktu_keluar', '>=', $tanggalMulai)
            ->whereDate('waktu_keluar', '<=', $tanggalAkhir)
            ->sum('biaya_total');

        $totalKendaraan = Transaksi::where('status', 'keluar')
            ->whereDate('waktu_keluar', '>=', $tanggalMulai)
            ->whereDate('waktu_keluar', '<=', $tanggalAkhir)
            ->count();

        return view('rekap.index', compact('transaksi', 'totalPendapatan', 'totalKendaraan', 'tanggalMulai', 'tanggalAkhir'));
    }
}
