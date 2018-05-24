<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductApplication extends Model
{
    public $price;
    public $productrange_id;
    public $volume_1 = null;
    public $volume_2 = null;
    public $volume_3 = null;
    public $consigneer_delivery_id;
    public $application_id;

    public function __construct($application_id, $productrange_id, $volume_1 = 0, $volume_2 = 0 , $volume_3 = 0, $consigneer_delivery_id)
    {

        $this->productrange_id = $productrange_id;
        $this->volume_1 = $volume_1;
        $this->volume_2 = $volume_2;
        $this->volume_3 = $volume_3;
        $this->consigneer_delivery_id = $consigneer_delivery_id;
        $this->application_id = $application_id;
    }

    public function productrange() {

        return $this->belongsTo('App\Models\Productrange');
    }

    public function consigneer_delivery() {
        return $this->belongsTo('App\Models\ConsigneerDelivery');
    }

    public function setPrice() {

        return $this->price = $this->consigneer_delivery->price;
    }

}
