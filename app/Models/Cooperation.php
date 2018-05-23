<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cooperation extends Model
{
    protected $fillable = [
        'contract_number',
        'contract_period',
        'monthly_min_volume',
        'monthly_max_volume',
        'delayed_payment',
        'bonus',
        'description',
        'counter_id',
    ];

    public function counter()
    {
        return $this->belongsTo('App\Models\Counter');
    }

    public function productranges()
    {
        return $this->belongsToMany('App\Models\Productrange');
    }
}
