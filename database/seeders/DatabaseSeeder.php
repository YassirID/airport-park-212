<?php

namespace Database\Seeders;

use App\Models\AreaParkir;
use App\Models\Tarif;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Users
        User::create([
            'nama_lengkap' => 'Administrator',
            'username' => 'admin',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        User::create([
            'nama_lengkap' => 'Petugas Parkir',
            'username' => 'petugas',
            'password' => 'password123',
            'role' => 'petugas',
        ]);

        User::create([
            'nama_lengkap' => 'Owner Bandara',
            'username' => 'owner',
            'password' => 'password123',
            'role' => 'owner',
        ]);

        // Create Area Parkir
        $areas = [
            ['nama_area' => 'Parkir Terminal A', 'kapasitas' => 50],
            ['nama_area' => 'Parkir Terminal B', 'kapasitas' => 40],
            ['nama_area' => 'Parkir VIP', 'kapasitas' => 20],
            ['nama_area' => 'Parkir Inap', 'kapasitas' => 30],
        ];

        foreach ($areas as $area) {
            AreaParkir::create($area);
        }

        // Create Tarif
        $tarifs = [
            ['jenis_kendaraan' => 'motor', 'tarif_per_jam' => 3000],
            ['jenis_kendaraan' => 'mobil', 'tarif_per_jam' => 5000],
            ['jenis_kendaraan' => 'bus', 'tarif_per_jam' => 10000],
        ];

        foreach ($tarifs as $tarif) {
            Tarif::create($tarif);
        }
    }
}
