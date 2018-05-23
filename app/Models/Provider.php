<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name',
    ];


    public function productranges()
    {
        return $this->hasMany('App\Models\Productrange');
    }

    public function counter()
    {
        return $this->belongsTo('App\Models\Counter');
    }
}
