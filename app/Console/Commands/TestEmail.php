<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    protected $signature = 'email:test';
    protected $description = 'Send a test email';

    public function handle()
    {
        try {
            Mail::raw('Test email from Laravel app', function ($message) {
                $message->to('ajay.melbourne@gmail.com')
                        ->subject('Test Email');
            });
            $this->info('Test email sent successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to send email: ' . $e->getMessage());
        }
    }
} 