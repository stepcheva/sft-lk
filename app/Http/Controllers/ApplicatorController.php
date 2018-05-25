<?php

namespace App\Http\Controllers;

use App\Models\Applicator;
use Illuminate\Http\Request;


class ApplicatorController extends Controller
{
    public function show(Applicator $applicator)
    {
        $user = $applicator->user;
        $counter = $applicator->counter;
        $consigneers = $applicator->getConsigneers();
        $cooperation = $applicator->counter->getCooperation();

        return view('templates.users.show', compact('user' , 'counter', 'consigneers', 'cooperation'));
    }




}
