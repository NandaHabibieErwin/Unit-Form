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
        $FormData = Form::whereDate('created_at', Carbon::now())->get();
        //dd($FormData);
        return Inertia::render('Report', [
            'user' => auth()->user(),
            'data' => $FormData,
        ]);
    }

    public function ViewReport($id)
    {
        $FormData = Form::findOrFail($id);
       // dd($FormData);
        return Inertia::render('ReportDetail', [
            'report' => $FormData,
        ]);
    }
}
