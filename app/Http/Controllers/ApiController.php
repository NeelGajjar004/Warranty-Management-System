<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Validator;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;


class ApiController extends Controller
{
    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'password_confirm' => ['required','same:password'],
        ]);

        if($validator->fails())
        {
            $response = [ 
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response,400);
        }

        $data = $request->all();
        $user = User::create($data);

        $success['token'] = $user->createToken('WMS')->plainTextToken;
        $success['user_name'] = $user->user_name;
        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User Register Successfully'
        ];
        return response()->json($response,200);
    }

    public function login(Request $request){
        
        if(Auth::attempt(['email'=>$request->email,'passsword'=>$request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('WMS')->plainTextToken;
            $success['user_name'] = $user->user_name;
            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'User Login Successfully'
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'success' => false,
                'message' => 'Unauthenticated'
            ];
            return response()->json($response);
        }
    }

    public function login1(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $success['token'] = $user->createToken('WMS')->plainTextToken;
        $success['user_name'] = $user->user_name;
        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User Login Successfully'
        ];
            return response()->json($response,200);
     
        // return $user->createToken($request->device_name)->plainTextToken;
    }





    public function userindex()
    {
        return response()->json(["users"=>User::get()]);
    }

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
