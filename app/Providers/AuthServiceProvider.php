<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Document;
use App\Policies\DocumentPolicy;
use App\Models\BusinessEntity;
use App\Policies\BusinessEntityPolicy;
use App\Models\Asset;
use App\Policies\AssetPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Document::class => DocumentPolicy::class,
        BusinessEntity::class => BusinessEntityPolicy::class,
        Asset::class => AssetPolicy::class,
        // ... other policies ...
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}