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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
            
            // Auto-Migrate in production to ensure DB is always up to date
            try {
                if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'google_id')) {
                    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Auto-Migrate Error: ' . $e->getMessage());
            }
        }
    }
}
