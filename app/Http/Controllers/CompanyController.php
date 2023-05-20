<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
 

class CompanyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','show']]);
        $this->middleware('permission:company-create', ['only' => ['create','store']]);
        $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request): View
    {
        $data = Company::latest()->paginate(5);

        return view('companys.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }    
    
    public function create(): View
    {
        return view('companys.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'company_name' => 'required',
            'company_email' => 'required|email|unique:users,email',
            'company_phone' => 'required|digits:10',
            'company_address' => 'required',
            // 'password' => 'required|same:confirm-password',
            'company_description' => 'required',
            
            
        ]);

        $input = $request->all();

        // $input['password'] = Hash::make($input['password']);
    
        $company = Company::create($input);

        if($request->company_logo) {
            $ext = $request->company_logo->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->company_logo->move(public_path().'/uploads/company/',$newFileName);
            $company->company_logo = $newFileName;
            $company->save();
        }    
        return redirect()->route('companys.index')
                        ->with('success','Company Added successfully');
    }

    public function show($id): View
    {
        // $user = User::find($id);
        // return view('users.show',compact('user'));
        $company = Company::find($id);
        return view('companys.show',compact('company'));
    }
    
    public function edit($id): View
    {
        $company = Company::find($id);
        
        return view('companys.edit',compact('company'));
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
        $company = Company::find($id);
        if(!empty($request->Active)){
            $company->update(['IsActive' => !$request->IsActive]);
            $company->save();

            return redirect()->route('companys.index')
                        ->with('success');
        }

        $this->validate($request, [
            'company_name' => 'required',
            'company_email' => 'required|email|unique:users,email',
            'company_phone' => 'required|digits:10',
            'company_address' => 'required',
            // 'password' => 'required|same:confirm-password',
            'company_description' => 'required',
        ]);
        
        $input = $request->all();
        
        
        
        // if(!empty($input['password'])){ 
            //     $input['password'] = Hash::make($input['password']);
            // }else{
                //     $input = Arr::except($input,array('password'));    
                // }
                
        $company->update($input);
        if($request->company_logo) {
            $oldImage = $company->company_logo;
            $ext = $request->company_logo->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->company_logo->move(public_path().'/uploads/company/',$newFileName);

            $company->company_logo = $newFileName;
            $company->save();

            File::delete(public_path().'/uploads/company/',$oldImage); 
        }
    
    
        return redirect()->route('companys.index')
                        ->with('success','company Details Updated Successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Company::find($id)->delete();
        return redirect()->route('companys.index')
                        ->with('success','Company deleted successfully');
    }

}
