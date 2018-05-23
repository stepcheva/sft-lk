<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsigneerDelivery extends Model
{
    protected $fillable = [
        'consigneer_id',
        'delivery_id',
        'price',
    ];

    public function consigneer()
    {
        return $this->belongsTo('App\Models\Consigneer');
    }

    public function delivery()
    {
        return $this->belongsTo('App\Models\Delivery');
    }
}
