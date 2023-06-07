<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index','show']]);
         $this->middleware('permission:customer-create', ['only' => ['create','store']]);
         $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $countrys = Country::all();
        $states = State::all();
        $cities = City::all();
        $customers = Customer::with('countrys')->get();
        $customers = Customer::with('states')->get();
        $customers = Customer::with('cities')->get();
        
        $customers = Customer::latest()->paginate(5);
        return view('customers.index',['customers'=> $customers ,'cities' => $cities,'states' => $states,'countrys' => $countrys])
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    
    public function create(): View
    {
        $countrys = Country::orderBy('country_name','ASC')->get();
        
        return view('customers.create',compact('countrys'));
    }
    
    public function fetchstates($country_id = null){
        $states = State::where('country_id',$country_id)->orderBy('state_name','ASC')->get();

        return response()->json([
            'status' => 1,
            'states' => $states,
        ]);
        
    }

    public function fetchcities($state_id = null){
        $cities = City::where('state_id',$state_id)->orderBy('city_name','ASC')->get();
        return response()->json([
            'status' => 1,
            'cities' => $cities,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'customer_name' => 'required',
            'customer_email' => 'required|email|unique:customer,customer_email',
            'customer_phone' => 'required|digits:10',
            'customer_password' => 'required',
            'date_of_birth' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);
        
        $input = $request->all();
        
        
        $customer = customer::create($input);
        
        if($request->customer_image) {
            $ext = $request->customer_image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->customer_image->move(public_path().'/uploads/customer/',$newFileName);
            $customer->customer_image = $newFileName;
            $customer->save();
        }
        
        return redirect()->route('customers.index')
        ->with('success','customer created successfully.');
    }
    
    public function show(customer $customer): View
    {
        $countrys = Country::all();
        $states = State::all();
        $cities = City::all();
        // $customers = Customer::with('countrys')->get();
        // $customers = Customer::with('states')->get();
        // $customers = Customer::with('cities')->get();
        return view('customers.show',compact('customer','cities','states','countrys'));
    }
    
    public function edit(customer $customer): View
    {
        if($customer == null){
            return redirect()->route('customers.index');
        }
        $countrys = Country::orderBy('country_name','ASC')->get();
        
        $states = State::where('country_id',$customer->country_id)->orderBy('state_name','ASC')->get();
        
        $cities = City::where('state_id',$customer->state_id)->orderBy('city_name','ASC')->get();
        
        return view('customers.edit',compact('customer','cities','states','countrys'));
    }

    public function update(Request $request, customer $customer): RedirectResponse
    {
        if(!empty($request->Active)){
            $customer->update(['IsActive' => !$request->InActive]);
            $customer->save();

            return redirect()->route('customers.index')
                        ->with('success');
        }

        if(!empty($request->Delete)){
            $customer->update(['IsDelete' => !$request->Restore]);
            $customer->save();

            return redirect()->route('customers.index')
                        ->with('success');
        }


        request()->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email|unique:customer,customer_email',
            'customer_phone' => 'required|digits:10',
            'customer_password' => 'required',
            'date_of_birth' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);
        
        $customer->update($request->all());
        if($request->customer_image) {
            $oldImage = $customer->customer_image;
            $ext = $request->customer_image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->customer_image->move(public_path().'/uploads/customer/',$newFileName);

            $customer->customer_image = $newFileName;
            $customer->save();
            
            File::delete(public_path().'/uploads/customer/',$oldImage); 
        }
    
        return redirect()->route('customers.index')
                        ->with('success','customer updated successfully');
    }

    public function destroy(customer $customer): RedirectResponse
    {
        $customer->delete();
    
        return redirect()->route('customers.index')
                        ->with('success','customer deleted successfully');
    }
}
