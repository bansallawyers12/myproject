<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DocumentScannerService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(DocumentScannerService::class, function ($app) {
            return new DocumentScannerService();
        });
    }

    public function boot()
    {
        //
    }

    
}