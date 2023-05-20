<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request): View
    {
        $data = Category::latest()->paginate(5);

        return view('categorys.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }    
    
    public function create(): View
    {
        return view('categorys.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'category_name' => 'required',
            'parent_category_id' => 'required',
            'sort_category' => 'required',
        ]);

        $input = $request->all();
    
        $category = Category::create($input);
        
        
        if($request->category_image) {
            $ext = $request->category_image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->category_image->move(public_path().'/uploads/category/',$newFileName);
            $category->category_image = $newFileName;
            $category->save();
        }    
        return redirect()->route('categorys.index')
                        ->with('success','category Added successfully');
    }

    public function show($id): View
    {
        $category = category::find($id);
        return view('categorys.show',compact('category'));
    }
    
    public function edit($id): View
    {
        $category = category::find($id);
        
        return view('categorys.edit',compact('category'));
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
        $category = category::find($id);
        if(!empty($request->Active)){
            $category->update(['IsActive' => !$request->IsActive]);
            $category->save();

            return redirect()->route('categorys.index')
                        ->with('success');
        }

        $this->validate($request, [
            'category_name' => 'required',
            'parent_category_id' => 'required',
            'sort_category' => 'required',
        ]);
        
        $input = $request->all();
        
        
        
        // if(!empty($input['password'])){ 
            //     $input['password'] = Hash::make($input['password']);
            // }else{
                //     $input = Arr::except($input,array('password'));    
                // }
                
        // $category = category::find($id);
        $category->update($input);
        if($request->category_image) {
            $oldImage = $category->category_image;
            $ext = $request->category_image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->category_image->move(public_path().'/uploads/category/',$newFileName);

            $category->category_image = $newFileName;
            $category->save();

            File::delete(public_path().'/uploads/category/',$oldImage); 
        }
    
    
        return redirect()->route('categorys.index')
                        ->with('success','category Details Updated Successfully');
    }

    public function destroy($id): RedirectResponse
    {
        category::find($id)->delete();
        return redirect()->route('categorys.index')
                        ->with('success','category deleted successfully');
    }
}
