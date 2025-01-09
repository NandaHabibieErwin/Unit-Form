<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'data';
    protected $fillable = [
        'Nama',
        'Tanggal_Data',
        'Nomor_Unit',
        'Kilo_Meter',
        'KiloMeter_Service',
        'Head',
        'status',
        'Ban_Velg_Baut',
        'Oli_Mesin',
        'Air_Radiator',
        'APAR',
        'Sabuk_Pengaman',
        'Spion',
        'Klakson_Alarm',
        'Kontrol_Panel',
        'Brake_System',
        'Steering_System',
        'Battery',
        'istirahat',
        'Keterangan',
        'keterangan_spv',
        'Air_Conditioner',
        'Wiper',
        'V_Belt',
        'Kaca',
        'Buggy_Whip',
        'Radio_Komunikasi',
        'Sistem_4wd',
        'obat',
        'masalah',
        'kondisi',
        'layak',
        'FotoKiri',
        'FotoKanan',
        'ttd_user',
        'ttd_admin',
    ];

}
