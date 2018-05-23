<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counterparty extends Model
{
    public function counterparty()
    {
        return $this->hasOne('App\Models\Counter');
    }
}
