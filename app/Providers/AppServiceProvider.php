<?php

// app/Providers/AppServiceProvider.php (corrigido)

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\AddressLookupInterface;
use App\Services\ViaCep\ViaCepService;
use App\Contracts\EmailSenderInterface;
use App\Services\LaravelEmailSender;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AddressLookupInterface::class, ViaCepService::class);
        $this->app->bind(EmailSenderInterface::class, LaravelEmailSender::class);
    }

    public function boot(): void
    {
        //
    }
}
