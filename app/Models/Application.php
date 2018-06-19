<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mail;

class Application extends Model
{
    protected $fillable = [
        'number',
        'period',
        'status',
        'consigneer_id',
        'provider_id',
        'applicator_id'
    ];

    public function applicator()
    {
        return $this->belongsTo('App\Models\Applicator');
    }

    public function consigneer()
    {
        return $this->belongsTo('App\Models\Consigneer');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }

    public function order_applications()
    {
        return $this->hasMany('App\Models\OrderApplication');
    }

    public function contactquery()
    {
        return $this->hasOne('App\Models\Contactquery');
    }

    public function getApplicationVolume()
    {
        $volume = $this->order_applications->map(function ($item){
            return $item->getVolume();
        })->sum();

        return $volume;
    }

    public function getApplicationPrice()
    {
        $price = $this->order_applications->map(function ($item){
            return $item->price;
        })->sum();

        return $price;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function sendNotification($subject = 'Уведомление о создании заказа')
    {
        $email = $this->applicator->user->email;
        $name = $this->applicator->user->firstName . " " . $this->applicator->user->lastName;
        $data = [
            'application' => $this,
            'product_applications' => $this->order_applications,
        ];
        $view = "templates.mail.applications";
        $send = Mail::send(['html' => $view], $data, function ($message) use ($subject, $name, $email) {
            $message->to($email, $name);
            $message->cc('file.storages.ex@gmail.com');
            $message->from('file.storages.ex@gmail.com', 'SFT Group');
            $message->subject($subject);
        });

        return $send;
    }

}
