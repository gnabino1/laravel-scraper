<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Scraping\Scraper;
use App\Services\Scraping\ScraperInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->bind(ScraperInterface::class, Scraper::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
