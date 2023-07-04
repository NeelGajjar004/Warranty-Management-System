<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\City;
use App\Models\Vendor;
use App\Models\Company;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class VendorController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:vendor-list|vendor-create|vendor-edit|vendor-delete', ['only' => ['index','show']]);
         $this->middleware('permission:vendor-create', ['only' => ['create','store']]);
         $this->middleware('permission:vendor-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:vendor-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $cities = City::all();
        $vendors = Vendor::with('cities')->get();
        
        $vendors = Vendor::latest()->paginate(5);
        return view('vendors.index',['vendors'=> $vendors ,'cities' => $cities])
        ->with('i', (request()->input('page', 1) - 1) * 5);

        return response()->json([
            'vendors'=>Vendor::get()
        ]);
        
    }

    public function create(): View
    {
        $cities = City::all();

        return view('vendors.create',compact('cities'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'vendor_name' => 'required',
            'store_name' => 'required',
            'vendor_email' => 'required|email|unique:vendor,vendor_email',
            'vendor_phone' => 'required|digits:10',
            'vendor_password' => 'required',
            'vendor_address' => 'required',
            'city_id' => 'required',
            'vendor_pincode' => 'required|digits:6',
            'gst_number' => 'required',
        ]);
        
        // dd($request);
        $input = $request->all();
        
        
        $vendor = Vendor::create($input);

        if($request->vendor_image) {
            $ext = $request->vendor_image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->vendor_image->move(public_path().'/uploads/vendor/',$newFileName);
            $vendor->vendor_image = $newFileName;
            $vendor->save();
        }
        
        return redirect()->route('vendors.index')
        ->with('success','vendor created successfully.');
    }
    
    public function show(vendor $vendor): View
    {
        $cities = City::all();
        return view('vendors.show',compact('vendor','cities'));
    }

    public function vencom(vendor $vendors): View
    {
        // $vendors = Vendor::get();
        $companies = Company::get();
        return view('vendors.vencom',compact('vendors','companies'));
    }
    
    public function edit(vendor $vendor): View
    {
        $cities = City::all();
        
        return view('vendors.edit',compact('vendor','cities'));
    }
    
    public function vencomstore(Request $request, vendor $vendor): RedirectResponse
    {
        // $vendors = Vendor::find($id);
        // dd($vendor);

        $this->validate($request, [
            'vendor_id' => 'required',
            'companies' => 'required',
        ]);
    
        $company = $request->companies;
        
        
        foreach($company as $com){

            $vencom = Vendors_Has_Companies::create(['vendor_id' => $vendor,'company_id'=> $com]);
        }
        
        
        return redirect()->route('vencoms.index')
        ->with('success','company assigned successfully');
    }
    

    public function update(Request $request, vendor $vendor): RedirectResponse
    {
        if(!empty($request->Active)){
            $vendor->update(['IsActive' => !$request->InActive]);
            $vendor->save();

            return redirect()->route('vendors.index')
                        ->with('success');
        }

        if(!empty($request->Delete)){
            $vendor->update(['IsDelete' => !$request->Restore]);
            $vendor->save();

            return redirect()->route('vendors.index')
                        ->with('success');
        }

        if(!empty($request->Verified)){
            $vendor->update(['IsVerified' => !$request->NotVerified]);
            $vendor->save();

            return redirect()->route('vendors.index')
                        ->with('success');
        }

        if(!empty($request->Block)){
            $vendor->update(['IsBlock' => !$request->UnBlock]);
            $vendor->save();

            return redirect()->route('vendors.index')
                        ->with('success');
        }


        request()->validate([
            'vendor_name' => 'required',
            'store_name' => 'required',
            // 'vendor_email' => 'required|email|unique:vendor,email',
            'vendor_phone' => 'required|digits:10',
            'vendor_password' => 'required',
            'vendor_address' => 'required',
            'city_id' => 'required',
            'vendor_pincode' => 'required|digits:6',
            'gst_number' => 'required',
        ]);
        
        $vendor->update($request->all());
        if($request->vendor_image) {
            $oldImage = $vendor->vendor_image;
            $ext = $request->vendor_image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->vendor_image->move(public_path().'/uploads/vendor/',$newFileName);

            $vendor->vendor_image = $newFileName;
            $vendor->save();
            
            File::delete(public_path().'/uploads/vendor/',$oldImage); 
        }
    
        return redirect()->route('vendors.index')
                        ->with('success','vendor updated successfully');
    }

    public function destroy(vendor $vendor): RedirectResponse
    {
        $vendor->delete();
    
        return redirect()->route('vendors.index')
                        ->with('success','vendor deleted successfully');
    }
}
