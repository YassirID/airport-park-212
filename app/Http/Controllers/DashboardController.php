<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $data = [
                'totalUser' => User::count(),
                'totalArea' => AreaParkir::count(),
                'totalKendaraan' => Kendaraan::count(),
                'totalTransaksi' => Transaksi::count(),
                'transaksiAktif' => Transaksi::where('status', 'masuk')->count(),
            ];
            return view('dashboard.admin', $data);
        }

        if ($user->isPetugas()) {
            $data = [
                'transaksiAktif' => Transaksi::where('status', 'masuk')->count(),
                'transaksiHariIni' => Transaksi::whereDate('waktu_masuk', today())->count(),
                'areaList' => AreaParkir::all(),
            ];
            return view('dashboard.petugas', $data);
        }

        if ($user->isOwner()) {
            $data = [
                'totalTransaksi' => Transaksi::count(),
                'pendapatanHariIni' => Transaksi::whereDate('waktu_keluar', today())
                    ->where('status', 'keluar')
                    ->sum('biaya_total'),
                'pendapatanBulanIni' => Transaksi::whereMonth('waktu_keluar', now()->month)
                    ->whereYear('waktu_keluar', now()->year)
                    ->where('status', 'keluar')
                    ->sum('biaya_total'),
            ];
            return view('dashboard.owner', $data);
        }

        abort(403);
    }
}
