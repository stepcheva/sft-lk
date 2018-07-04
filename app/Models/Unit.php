<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'decada',
        'volume',
        'price',
        'productrange_id',
        'application_id',
        'lunit_id',
        'order_application_id'
    ];

    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }

    public function productrange()
    {
        return $this->belongsTo('App\Models\Productrange');
    }

    public function order_application()
    {
        return $this->belongsTo('App\Models\OrderApplication');
    }

    public function lunit()
    {
        return $this->belongsTo('App\Models\Lunit');
    }
    public function getDeliveryName()
    {
        return $this->order_application->consigneer_delivery->delivery->name;
    }
}
