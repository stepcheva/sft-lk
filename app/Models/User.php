<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $counter_id;

    protected $fillable = [
        'lastName',
        'firstName',
        'middleName',
        'email',
        'phone',
        'password',
        'remember_token',
    ];

    public function applicator()
    {
        return $this->hasOne('App\Models\Applicator');
    }

}

