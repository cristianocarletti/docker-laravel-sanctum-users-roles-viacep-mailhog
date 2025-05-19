<?php
// app/Services/LaravelEmailSender.php

namespace App\Services;

use App\Contracts\EmailSenderInterface;
use Illuminate\Support\Facades\Mail;

class LaravelEmailSender implements EmailSenderInterface
{
    public function send(string $to, string $subject, string $body): void
    {
        Mail::raw($body, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }
}
