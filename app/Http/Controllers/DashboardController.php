<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            return $this->ownerDashboard();
        }

        abort(403);
    }

    private function ownerDashboard()
    {
        $today = Carbon::today();
        $now = Carbon::now();

        // === Stat Cards ===
        $pendapatanHariIni = Transaksi::whereDate('waktu_keluar', $today)
            ->where('status', 'keluar')
            ->sum('biaya_total');

        $pendapatanBulanIni = Transaksi::whereMonth('waktu_keluar', $now->month)
            ->whereYear('waktu_keluar', $now->year)
            ->where('status', 'keluar')
            ->sum('biaya_total');

        $totalTransaksi = Transaksi::count();
        $kendaraanAktif = Transaksi::where('status', 'masuk')->count();

        // Pendapatan kemarin (untuk perbandingan)
        $pendapatanKemarin = Transaksi::whereDate('waktu_keluar', $today->copy()->subDay())
            ->where('status', 'keluar')
            ->sum('biaya_total');

        // Transaksi hari ini
        $transaksiHariIni = Transaksi::whereDate('waktu_keluar', $today)
            ->where('status', 'keluar')
            ->count();

        // === Area Capacity ===
        $areas = AreaParkir::all();

        // === Grafik Tren 7 Hari ===
        $tren7Hari = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $pendapatan = Transaksi::whereDate('waktu_keluar', $date)
                ->where('status', 'keluar')
                ->sum('biaya_total');
            $jumlah = Transaksi::whereDate('waktu_keluar', $date)
                ->where('status', 'keluar')
                ->count();
            $tren7Hari[] = [
                'tanggal' => $date->format('d/m'),
                'hari' => $date->translatedFormat('D'),
                'pendapatan' => (int) $pendapatan,
                'jumlah' => $jumlah,
            ];
        }

        // === Pendapatan per Jenis Kendaraan (bulan ini) ===
        $pendapatanPerJenis = Transaksi::join('tb_kendaraan', 'tb_transaksi.kendaraan_id', '=', 'tb_kendaraan.id')
            ->whereMonth('tb_transaksi.waktu_keluar', $now->month)
            ->whereYear('tb_transaksi.waktu_keluar', $now->year)
            ->where('tb_transaksi.status', 'keluar')
            ->groupBy('tb_kendaraan.jenis_kendaraan')
            ->select('tb_kendaraan.jenis_kendaraan', DB::raw('SUM(tb_transaksi.biaya_total) as total'), DB::raw('COUNT(*) as jumlah'))
            ->get();

        // === Area Terpopuler ===
        $areaTerpopuler = Transaksi::join('tb_area_parkir', 'tb_transaksi.area_parkir_id', '=', 'tb_area_parkir.id')
            ->whereMonth('tb_transaksi.waktu_keluar', $now->month)
            ->whereYear('tb_transaksi.waktu_keluar', $now->year)
            ->where('tb_transaksi.status', 'keluar')
            ->groupBy('tb_area_parkir.id', 'tb_area_parkir.nama_area')
            ->select('tb_area_parkir.nama_area', DB::raw('SUM(tb_transaksi.biaya_total) as total_pendapatan'), DB::raw('COUNT(*) as total_transaksi'))
            ->orderByDesc('total_transaksi')
            ->get();

        // === Jam Sibuk (distribusi 24 jam, bulan ini) ===
        $jamSibuk = Transaksi::whereMonth('waktu_masuk', $now->month)
            ->whereYear('waktu_masuk', $now->year)
            ->groupBy(DB::raw('HOUR(waktu_masuk)'))
            ->select(DB::raw('HOUR(waktu_masuk) as jam'), DB::raw('COUNT(*) as jumlah'))
            ->orderBy('jam')
            ->get()
            ->keyBy('jam');

        // Fill missing hours
        $jamSibukData = [];
        for ($h = 0; $h < 24; $h++) {
            $jamSibukData[] = [
                'jam' => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00',
                'jumlah' => $jamSibuk->has($h) ? $jamSibuk[$h]->jumlah : 0,
            ];
        }

        // === Kendaraan Menginap (>24 jam) ===
        $kendaraanMenginap = Transaksi::with(['kendaraan', 'areaParkir'])
            ->where('status', 'masuk')
            ->where('waktu_masuk', '<=', $now->copy()->subHours(24))
            ->orderBy('waktu_masuk', 'asc')
            ->get();

        // === Kendaraan Sedang Parkir (semua yang masih masuk) ===
        $kendaraanSedangParkir = Transaksi::with(['kendaraan', 'areaParkir', 'petugas'])
            ->where('status', 'masuk')
            ->orderBy('waktu_masuk', 'desc')
            ->get();

        // Masuk hari ini
        $masukHariIni = Transaksi::whereDate('waktu_masuk', $today)->count();

        return view('dashboard.owner', compact(
            'pendapatanHariIni', 'pendapatanBulanIni', 'totalTransaksi',
            'kendaraanAktif', 'pendapatanKemarin', 'transaksiHariIni',
            'areas', 'tren7Hari', 'pendapatanPerJenis', 'areaTerpopuler',
            'jamSibukData', 'kendaraanMenginap', 'kendaraanSedangParkir', 'masukHariIni'
        ));
    }
}
