<?php

namespace App\Http\Controllers;

use App\Models\Lunit;
use App\Models\Transportunit;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Applicator;
use App\Models\OrderApplication;
use Illuminate\Support\Facades\Route;

class LunitsController extends Controller
{
    public function index(Application $application, Request $request)
    {
        $units = $application->lunits()->where('decada', $request->active)->get();
        $user = $application->applicator->user;
        $active = $request->decada;

        return response()->json(compact('application','user', 'applicator', 'units','active'));
    }

    public function show($id)
    {
        $lunit = Lunit::find($id);
        $units = $lunit->units;
        return response()->json(compact('lunit', 'units'));
    }




    public function edit($id)
    {

    }

    public function store()
    {

    }

    public function destroy()
    {

    }

    public function getTransports($id)
    {
        $lunit = Lunit::findOrFail($id);
        $transports = $lunit->transportunits;
        return $transports;
    }

    public function addTransports($id, Request $request)
    {
        if ($request->has('transport_info')) {
            $lunit =  Lunit::findOrFail($id);
            $transport = $lunit->transportunits()->create([
                'info' => $request->transport_info,
                'delivery_id' => ($lunit->delivery_id) ? $lunit->delivery_id : '4',
            ]);
            $application = $lunit->application;
            $applicator = $application->applicator;
        }

       return redirect()->back()->with(compact('application','applicator'));
    }

    public function updateTransports($id, Request $request)
    {
        if ($request->has('transport_info')) {
            $transport = Transportunit::findOrFail($id);
            $transport->update([
                'info' => $request->transport_info,
            ]);

            $lunit = $transport->lunits->first();
            $application = $lunit->application;
            $applicator = $application->applicator;
        }

        return redirect()->back()->with(compact('application','applicator'));
    }
}
