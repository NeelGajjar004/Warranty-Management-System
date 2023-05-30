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
        $categorys = Category::all();
        $companys = Company::all();
        $products = Product::with('category')->get();
        $products = Product::with('company')->get();
        
        
        // return view('products.index',['products'=> $products,'categorys' => $categorys]);
        
        $products = Product::latest()->paginate(5);
        return view('products.index',['products'=> $products ,'category' => $categorys , 'company' => $companys])
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'product_price' => 'required',
            'warranty_period' => 'required',
            'product_image' => 'required',
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
            $product->update(['IsActive' => !$request->IsActive]);
            $product->save();

            return redirect()->route('products.index')
                        ->with('success');
        }

         request()->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'warranty_period' => 'required',
            'product_image' => 'required',
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
