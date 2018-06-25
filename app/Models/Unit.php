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
    ];

    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }

    public function productrange()
    {
        return $this->belongsTo('App\Models\Productrange');
    }

    public function lunit()
    {
        return $this->belongsTo('App\Models\Lunit');
    }


}
