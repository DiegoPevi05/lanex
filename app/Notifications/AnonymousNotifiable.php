<?php

namespace App\Notifications;

use Illuminate\Notifications\Notifiable;

class AnonymousNotifiable
{
    use Notifiable;

    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
