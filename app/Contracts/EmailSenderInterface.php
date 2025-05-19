<?php

// app/Contracts/EmailSenderInterface.php

namespace App\Contracts;

interface EmailSenderInterface
{
    public function send(string $to, string $subject, string $message): void;
}