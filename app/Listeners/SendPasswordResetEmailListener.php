<?php

namespace App\Listeners;

use App\Events\PasswordResetRequested;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Contracts\EmailSenderInterface;

class SendPasswordResetEmailListener
{
    protected EmailSenderInterface $emailSender;

    public function __construct(EmailSenderInterface $emailSender)
    {
        $this->emailSender = $emailSender;
    }

    public function handle(PasswordResetRequested $event): void
    {
        $user = User::where('email', $event->email)->first();

        if ($user) {
            $token = Password::createToken($user);
            $link = url("/reset-password?token=$token&email={$user->email}");
            $this->emailSender->send($user->email, 'Recuperação de Senha', "Clique no link para redefinir sua senha: $link");
        }
    }
}