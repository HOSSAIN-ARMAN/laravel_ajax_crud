<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use DB;
use Illuminate\View\View;

class CustomerController extends Controller
{

    public function show() {
        return view('defendentFIle', [
            'customers' => Customer::where('company_id', 1)->get()
        ]);
    }
    public function get ($id) {
        return view('defendentFIle', [
            'customers' => Customer::where('company_id', $id)->get()
        ]);
    }
}
