<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('data', function (Blueprint $table) {
            $table->enum('Ban_Velg_Baut',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('Oli_Mesin',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('Air_Radiator',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('APAR',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('Sabuk_Pengaman',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('Spion',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('Klakson_Alarm',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('Kontrol_Panel',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('Brake_System',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('Steering_System',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('Lampu',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('Battery',["Baik", "Buruk", "NA"])->default('NA');
            $table->enum('istirahat',["Lebih dari 6 jam (Standar bugar selamat)", "4-6 jam (Wajib konseling dengan pengawas/user)", "Kurang dari 6 jam (Tidak diperbolehkan mengemudi)"]);
            $table->enum('obat',["Tidak", "Iya"]);
            $table->enum('masalah',["Tidak", "Iya"]);
            $table->enum('kondisi',["Tidak", "Iya"]);
            $table->enum('layak',["Tidak Layak", "Layak", "Layak dengan catatan"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data', function (Blueprint $table) {
            //
        });
    }
};
