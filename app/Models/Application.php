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



}
