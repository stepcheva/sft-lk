<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use App\Notifications\SendResetPasswordLink;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'lastName',
        'firstName',
        'middleName',
        'email',
        'phone',
        'password',

    ];

    protected $hidden = [
        'remember_token',
    ];

    public function applicator()
    {
        return $this->hasOne('App\Models\Applicator');
    }

    public function setPasswordUntil()
    {
        return $this->passwordUntil = Carbon::now()->addDays(25)->format('Y-m-d');
    }

    public function getPasswordUntil()
    {
        return $this->passwordUntil;
    }

    public function passwordIsValid()
    {
        return (Carbon::now() <= $this->getPasswordUntil()) or false;
    }

    public function passwordDayIsValid()
    {
        $date = Carbon::parse($this->getPasswordUntil());
        return $date->diffInDays(Carbon::now());
    }

    public static function check()
    {
        return Session::get('user');
    }

    public static function auth($email, $password)
    {
        $user = self::where(['email' => $email, 'password' => $password])->first();

        if (is_null($user)){
            Session::flash('error', 'Не верные логин или пароль');
        } elseif(!$user->passwordIsValid()) {
            Session::flash('error', 'Пароль не действителен');
        } else {
            Session::put('user', true);
            return $user;
        }
        return false;
    }

    public static function logout()
    {
        Session::forget('user');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SendResetPasswordLink($token));
    }


}
