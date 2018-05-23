<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consigneer extends Model
{
    protected $fillable = [
        'name',
        'address',
        'INN',
        'KPP',
        'delivery_time',
        'roll_diameter',
        'core_diameter',
        'counter_id',
    ];

    public function counter()
    {
        return $this->belongsTo('App\Models\Counter');
    }

    public function consigneerDeliveries()
    {
        return $this->hasMany('App\Models\ConsigneerDelivery');
    }
}
