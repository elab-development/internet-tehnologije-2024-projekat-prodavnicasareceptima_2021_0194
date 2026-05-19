<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\KorpaStavka;
use App\Observers\KorpaStavkaObserver;

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
    //    KorpaStavka::observe(KorpaStavkaObserver::class);
    }
}
