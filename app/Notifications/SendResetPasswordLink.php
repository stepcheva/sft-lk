<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

class SendResetPasswordLink extends ResetPassword
{
    use Queueable;

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->markdown('vendor.notifications.email')
            ->line( 'You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url(route('password.reset', $this->token, true)))
            ->line('If you did not request a password reset, no further action is required.');
    }
}
