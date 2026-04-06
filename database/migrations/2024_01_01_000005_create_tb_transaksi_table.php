<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained('tb_kendaraan')->onDelete('cascade');
            $table->foreignId('area_parkir_id')->constrained('tb_area_parkir')->onDelete('cascade');
            $table->datetime('waktu_masuk');
            $table->datetime('waktu_keluar')->nullable();
            $table->decimal('durasi_jam', 8, 2)->nullable();
            $table->decimal('biaya_total', 12, 2)->nullable();
            $table->enum('status', ['masuk', 'keluar'])->default('masuk');
            $table->foreignId('petugas_id')->constrained('tb_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};
