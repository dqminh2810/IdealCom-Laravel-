<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	// Sinon erreur SQL : SQLSTATE[42000]: Syntax error or access violation: 1071 La clé est
			// trop longue. Longueur maximale: 1000 (SQL: alter table `users` add unique `users_email_unique`(`email`))
			Schema::defaultStringLength(191);
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
