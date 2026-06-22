<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Override storage path for Vercel serverless environment
        if (isset($_ENV['VERCEL']) || getenv('VERCEL')) {
            $this->app->useStoragePath('/tmp');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Override view compiled path for Vercel serverless environment
        if (isset($_ENV['VERCEL']) || getenv('VERCEL')) {
            config(['view.compiled' => '/tmp/framework/views']);
        }
    }
}
