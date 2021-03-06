<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productrange extends Model
{
    protected $fillable = [
        'brand',
        'grammage',
        'format',
        'min_lot',
        'price',
        'provider_id',
    ];

    public function cooperations()
    {
        return $this->belongsToMany('App\Models\Cooperation');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }

    public function consigneerDeliveries()
    {
        return $this->hasMany('App\Models\ConsigneerDelivery');
    }

    public function getConsigneerDeliveries(Application $application)
    {
        return $this->consigneerDeliveries()->where('consigneer_id',$application->consigneer->id)->get();
    }

}
