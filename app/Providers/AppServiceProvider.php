<?php

namespace App\Providers;

use App\Integrations\LeedBookApiClient;
use App\Integrations\LeedBookApiInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LeedBookApiInterface::class, function ($app) {
            return new LeedBookApiClient(config('services.leed_book.api_url'));
        });
    }

    public function boot(): void
    {
        //
    }
}
