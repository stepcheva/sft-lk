<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Admin extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function check()
    {
        return Session::get('admin');
    }

    public static function auth($user, $password)
    {
        $admin = self::where('email', $user->email)->first();
        if (!is_null($admin) && Hash::check($password, $admin->password)) {
            Session::put('admin', true);
            return true;
        }
        return false;
    }

    public static function logout()
    {
        Session::forget('admin');
    }
}

