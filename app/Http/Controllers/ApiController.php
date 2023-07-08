<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Country;
use App\Models\State;
use App\Models\City;


class ApiController extends Controller
{
    public function vendorindex()
    {
        return response()->json(["vendors"=>Vendor::get()]);
    }
    public function productindex()
    {
        return response()->json(["products"=>Product::get()]);
    }
    public function companyindex()
    {
        return response()->json(["company"=>Company::get()]);
    }
    public function categoryindex()
    {
        return response()->json(["category"=>Category::get()]);
    }
    public function customerindex()
    {
        return response()->json(["customers"=>Customer::get()]);
    }
    public function countryindex()
    {
        return response()->json(["countrys"=>Country::get()]);
    }
    public function stateindex()
    {
        return response()->json(["state"=>State::get()]);
    }
    public function cityindex()
    {
        return response()->json(["city"=>City::get()]);
    }

}
