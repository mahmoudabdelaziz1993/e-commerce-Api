<?php

namespace App\Providers;

use App\Mail\registeruser;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        schema::defaultStringLength(191);
        Passport::routes();

        User::created(function($user){
            Mail::to($user)->send(new registeruser($user));
        });


        
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
