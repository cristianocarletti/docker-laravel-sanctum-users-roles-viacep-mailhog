<?php
// app/Services/Mail/MailSenderService.php

namespace App\Services\Mail;

use App\Contracts\EmailSenderInterface;
use Illuminate\Support\Facades\Mail;

class MailSenderService implements EmailSenderInterface
{
    public function enviar(string $to, string $subject, string $message): void
    {
        Mail::raw($message, function ($msg) use ($to, $subject) {
            $msg->to($to)->subject($subject);
        });
    }
}