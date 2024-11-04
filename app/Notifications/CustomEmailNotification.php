<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomEmailNotification extends Notification
{
    use Queueable;

    protected $subject;
    protected $greeting;
    protected $introLines;
    protected $actionText;
    protected $actionUrl;
    protected $outroLines;
    protected $salutation;
    protected $level;

    /**
     * Create a new notification instance.
     */
    public function __construct($subject,$greeting, $introLines, $actionText, $actionUrl, $outroLines, $salutation, $level = 'primary')
    {
        $this->subject = $subject;
        $this->greeting = $greeting;
        $this->introLines = $introLines;
        $this->actionText = $actionText;
        $this->actionUrl = $actionUrl;
        $this->outroLines = $outroLines;
        $this->salutation = $salutation;
        $this->level = $level;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject($this->subject ?? 'Custom Email Notification') // Set the custom subject
            ->greeting($this->greeting ?? 'Hello!');

        // Add each intro line separately
        foreach ($this->introLines as $line) {
            $mailMessage->line($line);
        }

        // If you have an action, include it here
        if ($this->actionText && $this->actionUrl) {
            $mailMessage->action($this->actionText, $this->actionUrl);
        }

        // Add each outro line separately
        foreach ($this->outroLines as $line) {
            $mailMessage->line($line);
        }

        if ($this->salutation) {
            $mailMessage->salutation($this->salutation);
        }
    
        return $mailMessage;
    }
    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
