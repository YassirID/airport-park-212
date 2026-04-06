<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AreaParkir extends Model
{
    protected $table = 'tb_area_parkir';

    protected $fillable = [
        'nama_area',
        'kapasitas',
        'terisi',
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'area_parkir_id');
    }

    public function isFull(): bool
    {
        return $this->terisi >= $this->kapasitas;
    }

    public function sisaKapasitas(): int
    {
        return $this->kapasitas - $this->terisi;
    }
}
