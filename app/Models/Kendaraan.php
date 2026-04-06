<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kendaraan extends Model
{
    protected $table = 'tb_kendaraan';

    protected $fillable = [
        'plat_nomor',
        'jenis_kendaraan',
        'pemilik',
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'kendaraan_id');
    }
}
