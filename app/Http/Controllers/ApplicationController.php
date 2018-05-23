<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Applicator;
use App\Models\Productrange;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Jenssegers\Date\Date;

use Mail;

class ApplicationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // список заявок пользователя
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Applicator $applicator)
    {
        $date_year = [
            Carbon::now()->format('Y'), Carbon::now()->addYear()->format('Y')
        ];

        $date_month = [];

        for($i = 1; count($date_month) < 12; $i++) {
            $date_month[] = Carbon::now()->addMonth($i)->format('F');
        }

        return view('templates.applications.create', ['applicator' => $applicator, 'date_month' => $date_month, 'date_year' => $date_year]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Applicator $applicator, Request $request)
    {
        $date = "$request->year $request->month";
        $date = Carbon::createFromFormat('Y F', $date)->lastOfMonth();

        $application = Application::create([
            'consigneer_id' => $request->consigneer_id,
            'applicator_id' => $request->applicator->id,
            'status' => '0',
            'number' => '1'. random_int(10000,20000),
            'period' => $date->format('Y-m-d'),
            ]);

        $productranges = Productrange::where('provider_id', $request->provider_id)->paginate(15);

        $consigneer_deliveries = $application->consigneer->consigneerDeliveries;

        return view('templates.applications.productrange', compact('productranges','applicator', 'consigneer_deliveries'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function createProductApplication(Applicator $applicator, Request $request)
    {
        dd($request);
    }
}
