<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = [
        'name',
        'address',
        'requisites',
        'counterparty_id',
    ];

    /**
     * @return array
     */

    public function consigneers()
    {
        return $this->hasMany('App\Models\Consigneer');
    }

    public function providers()
    {
        return $this->hasMany('App\Models\Provider');
    }

    public function counterparty()
    {
        return $this->belongsTo('App\Models\Counterparty');
    }

    public function getCooperation()
    {
        $cooperation = Cooperation::where('counter_id', $this->id)
            ->orderBy('contract_period', 'desc')
            ->firstOrFail();

        return $cooperation;
    }

}
