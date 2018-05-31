<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        return $this->hasMany('App\Models\Application');
    }
    public function getConsigneers()
    {
        return $this->counter->consigneers;
    }

    public function cooperation()
    {
        return $this->belongsTo('App\Models\Cooperation');
    }

    public function contactqueries()
    {
        return $this->hasMany('App\Models\Contactquery');
    }

    public function getApplications($status)
    {
        return $this->applications()->where('status', $status)->latest()->get();
    }

    public function getMonthlyApplications()
    {
        return $this->applications()->where('created_at', '>=', Carbon::now()->startOfMonth())->get();
    }


}
