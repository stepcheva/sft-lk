<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lunit extends Model
{
    protected $fillable = [
        'application_id',
        'number',
        'status',
        'volume',
        'price',
        'plan_data',
        'shipment_data',
        'delivery_data',
        'consigneer_id',
    ];


    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }

    public function units()
    {
        return $this->hasMany('App\Models\Unit');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }
}
