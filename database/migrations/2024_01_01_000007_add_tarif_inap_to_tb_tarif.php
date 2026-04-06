<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_tarif', function (Blueprint $table) {
            $table->decimal('tarif_tambahan_per_jam', 10, 2)->default(0)->after('tarif_per_jam');
            $table->decimal('tarif_inap_per_hari', 10, 2)->default(0)->after('tarif_tambahan_per_jam');
        });
    }

    public function down(): void
    {
        Schema::table('tb_tarif', function (Blueprint $table) {
            $table->dropColumn(['tarif_tambahan_per_jam', 'tarif_inap_per_hari']);
        });
    }
};
