<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Jobs\SendNewsletter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SendNewsletter::class, function(){
            return new SendNewsletter(null);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
