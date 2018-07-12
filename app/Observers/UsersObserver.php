<?php

namespace App\Observers;

use App\Mail\Mail\SendMail;
use App\Models\User;
use Illuminate\Support\Carbon;
use Mail;

class UsersObserver

{
    /**
     * @param User $user
     * @return bool
     */
    public function creating(User $user)
    {
        if ($user->getAttributes('password')) {
            $user->setPasswordUntil();
        }
        return true;
    }

    public function updating(User $user)
    {
        $changes = array_diff($user->getOriginal(), $user->getAttributes());
        if (array_key_exists('password', $changes)) {
            $user->setPasswordUntil();
        }
        return $changes or false;
    }

    public function updated(User $user)
    {
        if ($this->getChangesForEmail($user)) {
            session()->flash('success', 'Уведомление об изменении учетных данных отправлено на email');
        }
        return true;
    }

    public function getChangesForEmail(User $user) {
        $changes = array_diff($user->getOriginal(), $user->getAttributes());
        if (empty($changes) || array_key_exists('remember_token', $changes))
        {
            return false;
        } else {

            $info = 'Учетные данные изменены.';

                if (array_key_exists('password', $changes)) {
                  $user->setPasswordUntil();
                  $info .= " Ваш пароль изменен. Новый пароль действителен до $user->passwordUntil.";
                  $mailto = $user->email;
                } elseif (array_key_exists('email', $changes )) {
                  $info .= ' Ваш логин изменен администратором сайта.';
                  $mailto = $user->getOriginal()['email'];
                }

            $prefix = $user->getTable();
            $subject = "Уведомление об изменении учетных данных";
            $view = "templates.mail.$prefix";
            $url = ($prefix == 'users') ? url("applicators/{$user->id}") : url("admins/{$user->id}");

            Mail::send(new SendMail($mailto, $subject, $info, $url, $view));

            return true;
        }
    }
}