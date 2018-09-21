<?php

namespace App\Providers;

use App\Booking;
use App\BookingExtra;
use App\Observers\BookingExtraObserver;
use App\Observers\BookingObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Booking::observe(BookingObserver::class);
        BookingExtra::observe(BookingExtraObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
