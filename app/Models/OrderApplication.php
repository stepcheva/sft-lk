<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderApplication extends Model
{
    protected $fillable = [
        'price',
        'productrange_id',
        'volume_1',
        'volume_2',
        'volume_3',
        'consigneer_delivery_id',
        'application_id',
    ];

    public function productrange() {

        return $this->belongsTo('App\Models\Productrange');
    }

    public function consigneer_delivery() {
        return $this->belongsTo('App\Models\ConsigneerDelivery');
    }

    public function getVolume() {

        return $this->volume_1 + $this->volume_2 + $this->volume_3;
    }
}
