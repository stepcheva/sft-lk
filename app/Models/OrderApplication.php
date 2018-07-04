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

    public function productrange()
    {

        return $this->belongsTo('App\Models\Productrange');
    }

    public function consigneer_delivery()
    {
        return $this->belongsTo('App\Models\ConsigneerDelivery');
    }

    public function units()
    {
        return $this->hasMany('App\Models\Unit');
    }

    public function getVolume()
    {

        return $this->volume_1 + $this->volume_2 + $this->volume_3;
    }

    public function application()
    {

        return $this->belongsTo('App\Models\Application');
    }

    public function createUnits()
    {
        if (isset($this->volume_1)) {
            $unit[] = Unit::create([
                'application_id' => $this->application->id,
                'productrange_id' => $this->productrange_id,
                'volume' => $this->volume_1,
                'price' => $this->consigneer_delivery->price,
                'decada' => 1,
            ]);
        }
        if (isset($this->volume_2)) {
            $unit[] = Unit::create([
                'application_id' => $this->application->id,
                'productrange_id' => $this->productrange_id,
                'volume' => $this->volume_2,
                'price' => $this->consigneer_delivery->price,
                'decada' => 3,
            ]);
        }
        if (isset($this->volume_3)) {
            $unit[] = Unit::create([
                'application_id' => $this->application->id,
                'productrange_id' => $this->productrange_id,
                'volume' => $this->volume_3,
                'price' => $this->consigneer_delivery->price,
                'decada' => 3,
            ]);
        }
        return ($unit);
    }
}
