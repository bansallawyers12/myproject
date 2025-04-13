<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\UrlHelper;

class HelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('url-helper', function () {
            return new UrlHelper();
        });
    }

    public function boot()
    {
        //
    }
} 