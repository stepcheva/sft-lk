<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CooperationProductrange extends Model
{
    protected $fillable = [
        'cooperation_id',
        'productrange_id',
    ];

    public function cooperation()
    {
        return $this->belongsTo('App\Models\Cooperation');
    }

    public function productrange()
    {
        return $this->belongsTo('App\Models\Productrange');
    }
}
