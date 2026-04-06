<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';

    protected $fillable = [
        'kendaraan_id',
        'area_parkir_id',
        'waktu_masuk',
        'waktu_keluar',
        'durasi_jam',
        'biaya_total',
        'status',
        'petugas_id',
    ];

    protected function casts(): array
    {
        return [
            'waktu_masuk' => 'datetime',
            'waktu_keluar' => 'datetime',
        ];
    }

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function areaParkir(): BelongsTo
    {
        return $this->belongsTo(AreaParkir::class, 'area_parkir_id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
