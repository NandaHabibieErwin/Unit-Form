<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Sheets::spreadsheet('1kuSwituK8_OSl52j_wYlXtaBWUleCjFSQNSoPwJtEZs')->sheet('Sheet1')->get();
        $header = $rows->pull(0);
        $values = Sheets::collection(header: $header, rows: $rows);
        $values = array_values($values->toArray());
        dd($values);
        return view('sheets', compact('values'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama' => 'required|string',
            'Tanggal_Data' => 'required',
            'Nomor_Unit' => 'required',
            'Kilo_Meter' => 'required',
            'KiloMeter_Service' => 'required',
            'Head' => 'required',
            'layak' => 'required',
            'Vehicle' => 'required',
            'Health' => 'required',
            'FotoKiri' => 'required',
            'FotoKanan' => 'required',
        ]);

        $Vehicle = json_decode($validated['Vehicle'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON format in Vehicle data.'], 400);
        }

        $Health = json_decode($validated['Health'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON format in Health data.'], 400);
        }



        $fotoKiriPaths = [];
        foreach ($request->FotoKiri as $foto) {
            if (isset($foto['file']) && $foto['file'] instanceof \Illuminate\Http\UploadedFile) {
                $fotoKiriPaths[] = $foto['file']->store('uploads', 'public');
            } else {
                return response()->json(['error' => 'Invalid FotoKiri file format.'], 400);
            }
        }

        $fotoKananPaths = [];
        foreach ($request->FotoKanan as $foto) {
            if (isset($foto['file']) && $foto['file'] instanceof \Illuminate\Http\UploadedFile) {
                $fotoKananPaths[] = $foto['file']->store('uploads', 'public');
            } else {
                return response()->json(['error' => 'Invalid FotoKanan file format.'], 400);
            }
        }



    $Data = array_merge(
        $validated,
        $Vehicle,
        $Health,
        [
            'FotoKiri' => json_encode($fotoKiriPaths),
            'FotoKanan' => json_encode($fotoKananPaths),
        ]
    );

        $upload = Form::create($Data);

       $this->InsertIntoSheet($Data);

        return response()->json(['success' => true, 'upload' => $upload], 201);
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
                    ]
                ]
            );
        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        //
    }
}
