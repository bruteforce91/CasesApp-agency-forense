<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//bisogna inserire Schema
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //bisgona specificare la lunghezza per evitare errore: 1071 Specified key was too long; max key length is 1000 bytes")
        Schema::defaultStringLength(191);
    }
}
