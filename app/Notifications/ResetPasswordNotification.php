<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    public string $token;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(env('APP_URL', 'http://localhost') . '/password-reset/' . $this->token . '?email=' . $notifiable->getEmailForPasswordReset());

        return (new MailMessage)
            ->subject(Lang::get('passwords.notification.subject'))
            ->greeting(Lang::get('passwords.notification.greeting', ['name' => $notifiable->name]))
            ->line(Lang::get('passwords.notification.line1'))
            ->action(Lang::get('passwords.notification.action'), $url)
            ->line(Lang::get('passwords.notification.line2', [
                'count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')
            ]))
            ->line(Lang::get('passwords.notification.line3'));
        // return (new MailMessage)
        //     ->subject(Lang::get('Notifikasi Reset Password'))
        //     ->greeting(Lang::get('Halo') . ' '  . $notifiable->name . ',')
        //     ->line(Lang::get('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.'))
        //     ->action(Lang::get('Reset Password'), $url)
        //     ->line(Lang::get('Link reset password ini akan kadaluarsa dalam :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
        //     ->line(Lang::get('Jika Anda tidak meminta reset password, abaikan email ini.'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
