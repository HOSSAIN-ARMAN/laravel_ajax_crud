<?php

namespace App\Http\Controllers;


use App\Area;
use App\City;
use App\Company;
use App\Customer;
use DB;
use View;


class CustomerController extends Controller
{
    public function __construct() {
        View::share([
            'cities' => City::where('division_id', 1)->get(),
            'areas'  => Area::where('city_id', 1)->get()
        ]);
    }

    public function show() {

        return view('defendentFIle', $this->viewAll());

    }
    public function get ($id) {

        return view('defendentFIle', $this->viewAll($id));

    }
    public function viewAll ($id = 1) {

           return array(
//               'companies' => Company::all(), // it gets service from provider
               'customer'  => Customer::where('company_id', $id)->first(),
               'customers' => Customer::where('company_id', $id)->get()
           );
    }





//    mother code -----------------------------------------------------------------


//    public function show() {
//
////        dd($this->viewAll());
//
//        return view('defendentFIle', [
//            'companies' => Company::all(),
//            'customer'  => Customer::where('company_id', 1)->first(),
//            'customers' => Customer::where('company_id', 1)->get()
//        ]);
//
//
//    }
//    public function get ($id) {
//
//        return view('defendentFIle', [
//            'companies' => Company::all(),
//            'customer'  => Customer::where('company_id', $id)->first(),
//            'customers' => Customer::where('company_id', $id)->get()
//        ]);
//
//
//
//    }

}
