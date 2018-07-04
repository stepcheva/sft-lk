<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lunit extends Model
{
    protected $fillable = [
        'application_id',
        'number',
        'status',
        'volume',
        'price',
        'plan_data',
        'shipment_data',
        'delivery_data',
        'consigneer_id',
        'delivery_id',
    ];
    protected $hidden = [
        'delivery_id'
    ];

    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }

    public function units()
    {
        return $this->hasMany('App\Models\Unit');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }

    public function setStatus($status)
    {
        return $this->status = $status;
    }

    public function status()
    {
        switch ($this->status) {
            case '0':
                return 'new';
                break;
            case '1':
                return 'in stock';
                break;
            case '2':
                return 'transport assigned';
                break;
            case '3':
                return 'shipped';
                break;
            case '4':
                return 'delivered';
                break;
            case '5':
                return 'canceled';
                break;
            }
    }

    public function consigneer()
    {
        return $this->belongsTo('App\Models\Consigneer');
    }

    public function transportunits()
    {
        return $this->belongsToMany('App\Models\Transportunit', 'lunit_transportunits');
    }

    public function delivery()
    {
        return $this->belongsTo('App\Models\Delivery');
    }

    public function getTotalPrice()
    {
        return $this->units->map(function ($item) {
            return $item->price;
        })->sum();
    }

    public function showAddDeliveryField()
    {
        return !count($this->transportunits) && $this->delivery->id === 4;
    }

    public function showEditDeliveryField()
    {
        if (null !== $this->transportunits->count() && $this->delivery->id === 4)
            return $this->transportunits()->first();
        else return false;
    }

}
