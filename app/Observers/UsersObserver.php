<?php

namespace App\Observers;

use App\Mail\Mail\SendMail;
use App\Models\User;
use Illuminate\Support\Carbon;
use Mail;

class UsersObserver

{
    public $observables = [
            'password',
            'passwordUntil',
    ];

    /**
     * @param User $user
     * @return bool
     */
    public function creating(User $user)
    {
        if ($user->getAttributes('passwordUntil')) {
            $user->passwordUntil = Carbon::now()->addDays(25)->format('Y-m-d');
        }

    }

    public function updating(User $user)
    {
        $changes = array_diff($user->getOriginal(), $user->getAttributes());
        dd($changes);

        if (array_key_exists('password', $changes)) {
            $user->passwordUntil = date('Y-m-d');
        }

        return $changes or false;

    }

    public function updated(User $user)
    {
        if (array_key_exists('password', $user->getAttributes())) {
            $prefix = $user->getTable();
            $subject = "Уведомление об изменении пароля";
            $info = "Ваш пароль успешно изменен. Обновите пароль ";
            $view = "templates.mail.$prefix";
            $url = url("$prefix/{$user->id}");
            $send = Mail::send(new SendMail($user->email, $subject, $info, $url, $view));
            if ($send) {
                session()->flash('success', 'Новый пароль успешно изменен. Уведомление о смене пароля отправлено на {{$user->email}}');
            } else {
                session()->flash('alert', 'Ошибка отправки данных.');
            }
        }
        return true;
    }
}