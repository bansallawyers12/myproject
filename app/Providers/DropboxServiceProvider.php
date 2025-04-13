<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Spatie\Dropbox\Client as DropboxClient;
use League\Flysystem\Filesystem;
use Spatie\FlysystemDropbox\DropboxAdapter;
use Illuminate\Filesystem\FilesystemAdapter;

class DropboxServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Storage::extend('dropbox', function ($app, $config) {
            $client = new DropboxClient(
                $config['authorization_token'] ?? $config['key'] ?? env('DROPBOX_ACCESS_TOKEN')
            );

            $adapter = new DropboxAdapter($client);
            
            return new FilesystemAdapter(
                new Filesystem($adapter, ['case_sensitive' => false]),
                $adapter,
                $config
            );
        });
    }
}