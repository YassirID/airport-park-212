<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tb_tarif';

    protected $fillable = [
        'jenis_kendaraan',
        'tarif_per_jam',
        'tarif_tambahan_per_jam',
        'tarif_inap_per_hari',
    ];

    /**
     * Hitung biaya parkir berdasarkan durasi (dalam menit).
     * - Jam pertama: tarif_per_jam
     * - Jam berikutnya: tarif_tambahan_per_jam
     * - Lebih dari 24 jam: tarif_inap_per_hari × jumlah hari (sisa jam tetap dihitung)
     */
    public function hitungBiaya(int $durasiMenit): array
    {
        $durasiJam = max(1, ceil($durasiMenit / 60));

        // Jika lebih dari 24 jam → tarif inap
        if ($durasiJam > 24 && $this->tarif_inap_per_hari > 0) {
            $jumlahHari = floor($durasiJam / 24);
            $sisaJam = $durasiJam % 24;

            $biayaInap = $jumlahHari * $this->tarif_inap_per_hari;
            $biayaSisa = 0;

            if ($sisaJam > 0) {
                $biayaSisa = $this->tarif_per_jam; // jam pertama sisa
                if ($sisaJam > 1) {
                    $biayaSisa += ($sisaJam - 1) * ($this->tarif_tambahan_per_jam ?: $this->tarif_per_jam);
                }
            }

            return [
                'durasi_jam' => $durasiJam,
                'jumlah_hari' => $jumlahHari,
                'sisa_jam' => $sisaJam,
                'biaya_inap' => $biayaInap,
                'biaya_sisa' => $biayaSisa,
                'biaya_total' => $biayaInap + $biayaSisa,
                'tipe' => 'inap',
            ];
        }

        // Parkir biasa (≤24 jam)
        $biayaJamPertama = $this->tarif_per_jam;
        $biayaTambahan = 0;

        if ($durasiJam > 1) {
            $tarifTambahan = $this->tarif_tambahan_per_jam ?: $this->tarif_per_jam;
            $biayaTambahan = ($durasiJam - 1) * $tarifTambahan;
        }

        return [
            'durasi_jam' => $durasiJam,
            'jumlah_hari' => 0,
            'sisa_jam' => $durasiJam,
            'biaya_jam_pertama' => $biayaJamPertama,
            'biaya_tambahan' => $biayaTambahan,
            'biaya_total' => $biayaJamPertama + $biayaTambahan,
            'tipe' => 'reguler',
        ];
    }
}
