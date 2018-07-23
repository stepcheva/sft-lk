<?php

namespace App\Http\Controllers;

use App\Models\Applicator;
use App\Models\Consigneer;
use App\Models\ConsigneerDelivery;
use App\Models\CooperationProductrange;
use App\Models\Productrange;


class ApplicatorController extends Controller
{
    public function show(Applicator $applicator)
    {
        $user = $applicator->user;
        $counter = $applicator->counter;
        $consigneers = $applicator->getConsigneers();
        $cooperation = $applicator->counter->getCooperation();

        return view('templates.users.profile', compact('user', 'counter', 'consigneers', 'cooperation'));
    }

    /**
     * @param Applicator $applicator
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProductranges(Applicator $applicator, $consigneer_id)
    {
        $user = $applicator->user;
        return view('templates.productranges.list', compact('applicator', 'user'));
    }

    public function showConsigneers($applicator)
    {
        $consigneers = Applicator::find($applicator)->getConsigneers();
        return response()->json(['consigneers' => $consigneers]);
    }

    public function getProducts($consigneer, $applicator)
    {
        $products_id = CooperationProductrange::where('cooperation_id',
            Applicator::find($applicator)->cooperation->id)->pluck('productrange_id');
        $productranges = Productrange::find($products_id);
        foreach ($productranges as $product) {
            $id = $product->id;
            $brand = $product->brand;
            $grammage = $product->grammage;
            $format = $product->format;
            $min_lot = $product->min_lot;
            $consigneer_delivery = $product->consigneerDeliveries()->where('consigneer_id', $consigneer)->get();
            foreach($consigneer_delivery as $key => $value) {
                $deliveries[$key]['name'] = $value->delivery->name;
                $deliveries[$key]['price'] = $value->price;
            }

            $products[] = compact('id', 'brand', 'grammage', 'format', 'min_lot', 'deliveries');
        }

        return response()->json([
            'products' => $products,
        ]);
    }
}
