<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportunit extends Model
{
    protected $fillable = [
        'info',
        'delivery_id',
    ];

    public function lunits()
    {
        return $this->belongsToMany('App\Models\Lunit');
    }

}
