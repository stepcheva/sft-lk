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
        'applicator_id'
    ];

    public function applicator()
    {
        return $this->belongsTo('App\Models\Applicators');
    }

    public function consigneer()
    {
        return $this->belongsTo('App\Models\Consigneer');
    }


}
