<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject(Lang::get('Atur Ulang Kata Sandi - Schola Exambro'))
            ->greeting('Halo, Bapak/Ibu!')
            ->line(Lang::get('Kami menerima permintaan untuk mengatur ulang kata sandi akun Schola Exambro Anda.'))
            ->action(Lang::get('Atur Ulang Kata Sandi'), $url)
            ->line(Lang::get('Tautan pengaturan ulang kata sandi ini akan kedaluwarsa dalam :count menit.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini.'))
            ->salutation('Salam hangat, Tim Schola Exambro');
    }
}
