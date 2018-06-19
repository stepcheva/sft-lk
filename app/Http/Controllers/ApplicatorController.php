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

        return view('templates.users.profile', compact('user' , 'counter', 'consigneers', 'cooperation'));
    }

    /**
     * @param Applicator $applicator
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProductranges(Applicator $applicator) {
        $productranges = $applicator->counter->providers->map(function ($item) {
            return $item->productranges;

        })->collapse();

        return view('templates.productranges.list', ['productranges' => $productranges]);
    }

}
