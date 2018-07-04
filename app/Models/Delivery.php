<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'name',
    ];

    public function consigneerDeliveries()
    {
        return $this->hasMany('App\Models\ConsigneerDelivery');
    }

    public function lunits()
    {
        return $this->hasMany('App\Models\Unit');
    }
}
