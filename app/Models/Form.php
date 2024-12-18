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
        'obat',
        'masalah',
        'kondisi',
        'layak',
    ];

}
