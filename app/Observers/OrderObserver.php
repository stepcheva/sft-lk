<?php
namespace App\Observers;

use App\Mail\Mail\SendMail;
use App\Models\User;
use Illuminate\Support\Carbon;
use Mail;

class OrderObserver
{
    public function created(Order $order)
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

