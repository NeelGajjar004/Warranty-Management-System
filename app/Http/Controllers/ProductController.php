<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $category = Category::all();
        $company = Company::all();
        $products = Product::with('category','company')->get();
        
        $products = Product::latest()->paginate(5);
        return view('products.index',['products'=> $products ,'category' => $category , 'company' => $company])
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function create(): View
    {
        $categorys = Category::all();
        $companys = Company::all();
        return view('products.create',compact('categorys'),compact('companys'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_description' => 'required',
            'product_model' => 'required',
            'product_model_year'=> 'required',
            'product_price' => 'required',
            'warranty_days' => 'required',
            'warranty_extendable_days' => 'required',
            'age_of_product' => 'required',
            'return_days' => 'required',
            'product_image' => 'required',
            'product_policy' => 'required',
            'category_id' => 'required',
            'company_id' => 'required',
        ]);
        
        // dd($request);
        $input = $request->all();
        
        
        $product = Product::create($input);

        if($request->product_image) {
            $ext = $request->product_image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->product_image->move(public_path().'/uploads/product/',$newFileName);
            $product->product_image = $newFileName;
            $product->save();
        }
        
        return redirect()->route('products.index')
        ->with('success','Product created successfully.');
    }
    
    public function show(Product $product): View
    {
        $categorys = Category::all();
        $companys = Company::all();
        return view('products.show',compact('product','categorys','companys'));
    }
    
    public function edit(Product $product): View
    {
        $categorys = Category::all();
        $companys = Company::all();
        
        return view('products.edit',compact('product','categorys','companys'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        if(!empty($request->Active)){
            $product->update(['IsActive' => !$request->InActive]);
            $product->save();

            return redirect()->route('products.index')
                        ->with('success');
        }

        if(!empty($request->Delete)){
            $product->update(['IsDelete' => !$request->Restore]);
            $product->save();

            return redirect()->route('products.index')
                        ->with('success');
        }

        if(!empty($request->Sold)){
            $product->update(['IsSold' => !$request->UnSold]);
            $product->save();

            return redirect()->route('products.index')
                        ->with('success');
        }

        request()->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_model' => 'required',
            'product_model_year'=> 'required',
            'product_price' => 'required',
            'warranty_days' => 'required',
            'warranty_extendable_days' => 'required',
            'age_of_product' => 'required',
            'return_days' => 'required',
            'product_policy' => 'required',
            'category_id' => 'required',
            'company_id' => 'required',
        ]);
        
        $product->update($request->all());
        if($request->product_image) {
            $oldImage = $product->product_image;
            $ext = $request->product_image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->product_image->move(public_path().'/uploads/product/',$newFileName);

            $product->product_image = $newFileName;
            $product->save();
            
            File::delete(public_path().'/uploads/product/',$oldImage); 
        }
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
