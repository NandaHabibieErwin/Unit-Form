<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;
use Revolution\Google\Sheets\Facades\Sheets;

class ReportController extends Controller
{
    public function index()
    {
        $FormData = Form::orderBy('created_at', 'desc')->get();

        return Inertia::render('Report', [
            'user' => auth()->user(),
            'data' => $FormData,
        ]);
    }


    public function search(Request $request)
{
    $query = Form::query();

    if ($request->filled('name')) {
        $query->where('Nama', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('no_unit')) {
        $query->where('Nomor_Unit', 'like', '%' . $request->no_unit . '%');
    }

    if ($request->filled('tanggal_data')) {
        $query->whereDate('Tanggal_Data', $request->tanggal_data);
    }

    if ($request->filled('kelayakan')) {
        $query->where('Layak', $request->kelayakan);
    }
        $query->orderBy('created_at', 'desc');
    return response()->json($query->Paginate(10));
}

    public function ViewReport($id)
    {
        $FormData = Form::findOrFail($id);
        $FormData->FotoKiri = str_replace(['\/', '[', ']', '"'], ['/', '', '', ''], $FormData->FotoKiri);
        $FormData->FotoKanan = str_replace(['\/', '[', ']', '"'], ['/', '', '', ''], $FormData->FotoKanan);
       // dd($FormData);
        return Inertia::render('ReportDetail',[
            'report' => $FormData,
        ]);
    }

    public function ManageReport($id, $status)
    {
        $FormData = Form::findOrFail($id);
        if($status == "Approved"){
        $FormData->status = "Approved";
    }
    else if ($status == "Rejected")
    {
        $FormData->status = "Rejected";
    }

        $FormData->save();
        $this->InsertIntoSheet($FormData);
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'data' => $FormData
        ], 200);
       // dd($FormData);
    }

    public function InsertIntoSheet($data)
    {
        Sheets::spreadsheet('1kuSwituK8_OSl52j_wYlXtaBWUleCjFSQNSoPwJtEZs')
            ->sheet('Sheet1')
            ->append(
                [
                    [
                        'Nama' => $data['Nama'],
                        'Tanggal' => $data['Tanggal_Data'],
                        'Nomor_Unit' => $data['Nomor_Unit'],
                        'Kilometer' => $data['Kilo_Meter'],
                        'Kilometer_Service' => $data['KiloMeter_Service'],
                        'Head' => $data['Head'],
                        'Ban_Velg_Baut' => $data['Ban_Velg_Baut'] ?? '',
                        'Oli_Mesin' => $data['Oli_Mesin'] ?? '',
                        'Air_Radiator' => $data['Air_Radiator'] ?? '',
                        'APAR' => $data['APAR'] ?? '',
                        'Sabuk_Pengaman' => $data['Sabuk_Pengaman'] ?? '',
                        'Spion' => $data['Spion'] ?? '',
                        'Klakson_Alarm' => $data['Klakson_Alarm'] ?? '',
                        'Kontrol_Panel' => $data['Kontrol_Panel'] ?? '',
                        'Brake_System' => $data['Brake_System'] ?? '',
                        'Steering_System' => $data['Steering_System'] ?? '',
                        'Lampu' => $data['Lampu'] ?? '',
                        'Battery' => $data['Battery'] ?? '',
                        'Telah beristirahat sebelum awal shift selama' => $data['istirahat'] ?? '',
                        'Tidak mengonsumsi obat-obatan yang dapat menyebabkan ngantuk dalam periode 8 jam sebelum mengemudi' => $data['obat'] ?? '',
                        'Tidak memiliki masalah pribadi atau keluarga yang dapat memengaruhi konsentrasi saya dalam mengemudi' => $data['masalah'] ?? '',
                        'Dalam Kondisi sehat dan fit untuk mengemudi' => $data['kondisi'] ?? '',
                        'Kelayakan' => $data['layak'] ?? '',
                        'Status' => $data['status'] ?? '',
                    ]
                ]
            );
        return true;
    }
}
