<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        Log::info(sprintf(
            '[LanEx Password Reset] Enlace generado para %s: %s',
            $notifiable->getEmailForPasswordReset(),
            $resetUrl
        ));

        return (new MailMessage)
            ->subject('Restablecer Contraseña — LanEx Logistics')
            ->greeting('¡Hola, ' . ($notifiable->name ?? 'Usuario') . '!')
            ->line('Recibiste este correo electrónico porque se solicitó un restablecimiento de contraseña para tu cuenta en LanEx.')
            ->action('Restablecer mi Contraseña', $resetUrl)
            ->line('Este enlace para restablecer tu contraseña caducará en ' . config('auth.passwords.users.expire', 60) . ' minutos.')
            ->line('Si no solicitaste este cambio, puedes ignorar este mensaje de forma segura.')
            ->salutation('Atentamente,' . "\n" . 'Equipo de Operaciones LanEx');
    }
}
