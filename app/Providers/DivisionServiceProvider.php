<?php

namespace App\Providers;



use Illuminate\Support\ServiceProvider;

use App\Division;




class DivisionServiceProvider extends ServiceProvider
{


    public function register()
    {
//        $this->app->bind( DivisionController::class, function ($app) {
//            return new DivisionServiceProvider($app);
//        });
    }


    public function boot()
    {
        //if you use * it gets access in all file or you can write fileName to individual access

       view()->composer('defendentFIle', function ($view) {
           $divisions = Division::all();
           return $view->with('divisions', $divisions);
       });


    }



//    public function show(Division $division)
//    {
//        if ($division){
//            return view('defendentFIle', [
//                'cities' => City::where('division_id', $division->id)->get(),
//                'customer'  => Customer::where('company_id', 1)->first(),
//                'customers' => Customer::where('company_id', 1)->get()
//            ]);
//        }
//    }


}
