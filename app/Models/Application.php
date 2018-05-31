<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'number',
        'period',
        'status',
        'consigneer_id',
        'provider_id',
        'applicator_id'
    ];

    public function applicator()
    {
        return $this->belongsTo('App\Models\Applicator');
    }

    public function consigneer()
    {
        return $this->belongsTo('App\Models\Consigneer');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }
    public function order_applications()
    {
        return $this->hasMany('App\Models\OrderApplication');
    }
    public function getApplicationVolume()
    {
        $volume = $this->order_applications->map(function ($item){
            return $item->getVolume();
        })->sum();

        return $volume;
    }

    public function getApplicationPrice()
    {
        $price = $this->order_applications->map(function ($item){
            return $item->price;
        })->sum();

        return $price;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

}
