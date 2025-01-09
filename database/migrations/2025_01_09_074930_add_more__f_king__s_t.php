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
        $table->enum('Air_Conditioner',["Baik", "Buruk", "NA"])->default('NA');
        $table->enum('Wiper',["Baik", "Buruk", "NA"])->default('NA');
        $table->enum('V_Belt',["Baik", "Buruk", "NA"])->default('NA');
        $table->enum('Kaca',["Baik", "Buruk", "NA"])->default('NA');
        $table->enum('Buggy_Whip',["Baik", "Buruk", "NA"])->default('NA');
        $table->enum('Radio_Komunikasi',["Baik", "Buruk", "NA"])->default('NA');
        $table->enum('Sistem_4wd',["Baik", "Buruk", "NA"])->default('NA');
        $table->string("keterangan")->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
