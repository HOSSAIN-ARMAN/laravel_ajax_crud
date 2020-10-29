<?php

namespace App\Http\Controllers;

use App\Area;
use App\City;
use App\Division;
use App\Customer;

use View;


class DivisionController extends Controller
{

    public function __construct() {
        View::share([
            'customer'  => Customer::where('company_id', 1)->first(),
            'customers' => Customer::where('company_id', 1)->get(),



            'area'      =>Area::where('city_id', 1)->first(),
            'areas'     => Area::where('city_id', 1)->get(),
            'city'   => City::where('division_id', 1)->first(),

            'cities'    => City::all(),
        ]);
    }


    public function getCityBydivision($id)
    {
        if ($id ){
            return view('defendentFIle', [
                'city'   => City::where('division_id', $id)->first(),
                'cities' => City::where('division_id', $id)->get(),
            ]);
        }
    }
    public function getAreaByCity($id , $division_id=null) {


        return view('defendentFIle', [
            'division' => Division::where('id', $division_id)->first(),
            'city'   => City::where('id', $id)->first(),
//            'cities' => City::where('id', $id)->get(),   //if you want show only one city then use it by uncomment
            'area'  =>Area::where('city_id', $id)->first(),
            'areas' => Area::where('city_id', $id)->get(),
        ]);

    }












//    public function show(Division $division){} // this work for DivisionServiceProvider

}
