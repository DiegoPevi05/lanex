<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendContactFormEmail($data)
    {
        try {
            // Use Laravel's mail functionality to send the email
            Mail::send('emails.contact_form', $data, function ($message) use ($data) {
                $message->to(data['email'])
                        ->subject(__('messages.contact.mail.subject'));
                $message->from($data['email'], $data['company']);
            });

            return true;
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Failed to send contact form email: ' . $e->getMessage());
            return false;
        }
    }
}
