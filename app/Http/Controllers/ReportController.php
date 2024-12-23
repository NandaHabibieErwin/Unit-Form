<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $FormData = Form::all();
        //$FormData = Form::whereDate('created_at', Carbon::now())->orderBy('created_at', 'desc')->get();
        //dd($FormData);
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
        if($status == true){
        $FormData->status = "Approved";
    }
    else if ($status == false)
    {
        $FormData->status = "Rejected";
    }

        $FormData->save();
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'data' => $FormData
        ], 200);
       // dd($FormData);
    }
}
