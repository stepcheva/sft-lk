<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
        'path',
        'applicator_id',
        'admin_id',
        'lunit_id'
    ];

    public function contactquery()
    {
        return $this->belongsTo('App\Models\Contactquery');
    }

}
