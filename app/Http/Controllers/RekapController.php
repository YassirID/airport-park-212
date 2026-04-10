<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai', Carbon::now()->startOfMonth()->toDateString());
        $tanggalAkhir = $request->input('tanggal_akhir', Carbon::now()->toDateString());
        $jenisKendaraan = $request->input('jenis_kendaraan', '');
        $petugasId = $request->input('petugas_id', '');
        $areaId = $request->input('area_id', '');
        $tipeFilter = $request->input('tipe', ''); // 'inap' for >24h only

        $query = Transaksi::with(['kendaraan', 'areaParkir', 'petugas'])
            ->where('status', 'keluar')
            ->whereDate('waktu_keluar', '>=', $tanggalMulai)
            ->whereDate('waktu_keluar', '<=', $tanggalAkhir);

        if ($jenisKendaraan) {
            $query->whereHas('kendaraan', fn($q) => $q->where('jenis_kendaraan', $jenisKendaraan));
        }
        if ($petugasId) {
            $query->where('petugas_id', $petugasId);
        }
        if ($areaId) {
            $query->where('area_parkir_id', $areaId);
        }
        if ($tipeFilter === 'inap') {
            $query->where('durasi_jam', '>', 24);
        }

        $transaksi = $query->orderBy('waktu_keluar', 'desc')->paginate(20)->appends($request->query());

        // Summary stats using same filters
        $summaryQuery = Transaksi::where('status', 'keluar')
            ->whereDate('waktu_keluar', '>=', $tanggalMulai)
            ->whereDate('waktu_keluar', '<=', $tanggalAkhir);

        if ($jenisKendaraan) {
            $summaryQuery->whereHas('kendaraan', fn($q) => $q->where('jenis_kendaraan', $jenisKendaraan));
        }
        if ($petugasId) {
            $summaryQuery->where('petugas_id', $petugasId);
        }
        if ($areaId) {
            $summaryQuery->where('area_parkir_id', $areaId);
        }
        if ($tipeFilter === 'inap') {
            $summaryQuery->where('durasi_jam', '>', 24);
        }

        $totalPendapatan = (clone $summaryQuery)->sum('biaya_total');
        $totalKendaraan = (clone $summaryQuery)->count();
        $rataRataDurasi = round((clone $summaryQuery)->avg('durasi_jam') ?? 0, 1);
        $rataRataBiaya = round((clone $summaryQuery)->avg('biaya_total') ?? 0);

        // Breakdown per jenis
        $breakdownJenis = Transaksi::join('tb_kendaraan', 'tb_transaksi.kendaraan_id', '=', 'tb_kendaraan.id')
            ->where('tb_transaksi.status', 'keluar')
            ->whereDate('tb_transaksi.waktu_keluar', '>=', $tanggalMulai)
            ->whereDate('tb_transaksi.waktu_keluar', '<=', $tanggalAkhir)
            ->groupBy('tb_kendaraan.jenis_kendaraan')
            ->select('tb_kendaraan.jenis_kendaraan', DB::raw('SUM(tb_transaksi.biaya_total) as total'), DB::raw('COUNT(*) as jumlah'))
            ->get();

        // Filter options
        $petugasList = User::where('role', 'petugas')->orderBy('nama_lengkap')->get();
        $areaList = AreaParkir::orderBy('nama_area')->get();

        return view('rekap.index', compact(
            'transaksi', 'totalPendapatan', 'totalKendaraan',
            'rataRataDurasi', 'rataRataBiaya', 'breakdownJenis',
            'tanggalMulai', 'tanggalAkhir', 'jenisKendaraan',
            'petugasId', 'areaId', 'tipeFilter',
            'petugasList', 'areaList'
        ));
    }

    public function exportCsv(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai', Carbon::now()->startOfMonth()->toDateString());
        $tanggalAkhir = $request->input('tanggal_akhir', Carbon::now()->toDateString());
        $jenisKendaraan = $request->input('jenis_kendaraan', '');
        $petugasId = $request->input('petugas_id', '');
        $areaId = $request->input('area_id', '');
        $tipeFilter = $request->input('tipe', '');

        $query = Transaksi::with(['kendaraan', 'areaParkir', 'petugas'])
            ->where('status', 'keluar')
            ->whereDate('waktu_keluar', '>=', $tanggalMulai)
            ->whereDate('waktu_keluar', '<=', $tanggalAkhir);

        if ($jenisKendaraan) {
            $query->whereHas('kendaraan', fn($q) => $q->where('jenis_kendaraan', $jenisKendaraan));
        }
        if ($petugasId) {
            $query->where('petugas_id', $petugasId);
        }
        if ($areaId) {
            $query->where('area_parkir_id', $areaId);
        }
        if ($tipeFilter === 'inap') {
            $query->where('durasi_jam', '>', 24);
        }

        $data = $query->orderBy('waktu_keluar', 'desc')->get();

        $filename = 'rekap_transaksi_' . $tanggalMulai . '_' . $tanggalAkhir . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            // BOM for Excel UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, ['No', 'Plat Nomor', 'Jenis', 'Area', 'Waktu Masuk', 'Waktu Keluar', 'Durasi (Jam)', 'Biaya Total (Rp)', 'Petugas']);

            foreach ($data as $i => $t) {
                fputcsv($file, [
                    $i + 1,
                    $t->kendaraan->plat_nomor,
                    ucfirst($t->kendaraan->jenis_kendaraan),
                    $t->areaParkir->nama_area,
                    $t->waktu_masuk->format('d/m/Y H:i'),
                    $t->waktu_keluar->format('d/m/Y H:i'),
                    $t->durasi_jam,
                    $t->biaya_total,
                    $t->petugas->nama_lengkap,
                ]);
            }

            // Summary row
            fputcsv($file, []);
            fputcsv($file, ['', '', '', '', '', '', 'TOTAL', $data->sum('biaya_total'), '']);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
