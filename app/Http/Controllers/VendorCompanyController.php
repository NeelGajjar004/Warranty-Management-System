<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Company;
use App\Models\Vendors_Has_Companies;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VendorCompanyController extends Controller
{
    public function index(Request $request): View
    {
        $vencoms = DB::table('vendors_has_companies')
        ->join('vendor', 'vendors_has_companies.vendor_id', '=', 'vendor.id')
        ->join('company', 'vendors_has_companies.company_id', '=', 'company.id')
        ->select('vendors_has_companies.*', 'vendor.vendor_name', 'company.company_name')
            ->get();
        
        return view('vencoms.index',compact('vencoms'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        $vendors = Vendor::get();
        $companies = Company::get();
        return view('vencoms.create',compact('vendors','companies'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'vendor_id' => 'required',
            'companies' => 'required',
        ]);

        // dd($request);
        $vendor = $request->vendor_id;
        $company = $request->companies;
        
        
        foreach($company as $com){

            $vencom = Vendors_Has_Companies::create(['vendor_id' => $vendor,'company_id'=> $com]);
        }
        
        
        return redirect()->route('vencoms.index')
        ->with('success','company assigned successfully');
    }
    
    public function edit($id): View
    {
        $vendors = Vendor::find($id);
        // dd($vendors);

        $companies = Company::get();
        $vencoms = DB::table("vendors_has_companies")->where("vendors_has_companies.vendor_id",$id)
            ->pluck('vendors_has_companies.company_id','vendors_has_companies.company_id')
            ->all();
            
            return view('vencoms.edit',compact('vendors','companies','vencoms'));
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
        $vendors = Vendor::find($id);
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

    public function destroy($id): RedirectResponse
    {
        DB::table("Vendors_Has_Companies")->where('vendor_id',$id)->delete();
        return redirect()->route('vencoms.index')
                        ->with('success','Vendor_company deleted successfully');
    }
}
