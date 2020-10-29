<?php

namespace App\Providers;

use App\Company;
use App\Customer;
use App\Division;
use Illuminate\Support\ServiceProvider;

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

        view()->share([
            'companies' => Company::all(),
//            'divisions' => Division::all()
        ]);

    }
}
