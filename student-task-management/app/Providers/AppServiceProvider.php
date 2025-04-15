<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $viewsPath = base_path('app/views');
        \Log::info('Views path: ' . $viewsPath);

        View::addNamespace('appviews', $viewsPath);
    }
}
