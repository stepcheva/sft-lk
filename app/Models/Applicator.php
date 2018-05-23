<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicator extends Model
{
    protected $fillable = [
        'user_id',
        'counter_id',
        'cooperation_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function counter()
    {
        return $this->belongsTo('App\Models\Counter');
    }

    public function applications()
    {
        return $this->belongsTo('App\Models\Application');
    }
    public function getConsigneers()
    {
        return $this->counter->consigneers;
    }

}
