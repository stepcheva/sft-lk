<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mail;

class Contactquery extends Model
{
    protected $fillable = [
        'theme',
        'querytext',
        'applicator_id',
        'file_id',
    ];

    public function applicator()
    {
        return $this->belongsTo('App\Models\Applicator');
    }

    public function file()
    {
        return $this->belongsTo('App\Models\File');
    }

    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }

    public function getFilePath()
    {
        return $this->file ? $this->file->path : null;
    }


}
