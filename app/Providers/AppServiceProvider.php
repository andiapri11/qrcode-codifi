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
            
            // Auto-Migrate in production
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('users') && !\Illuminate\Support\Facades\Schema::hasColumn('users', 'google_id')) {
                    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                }
            } catch (\Exception $e) {
                // Silent error
            }
        }
    }
}
