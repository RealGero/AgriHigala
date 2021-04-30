<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ProductType;

class ProductTypesController extends Controller
{
    protected $check_auth;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // CHECK IF AUTHENTICATED & ADMIN
            if (Auth::check()){
                if (Auth::user()->user_type != 1){
                    return back();
                }
            }
            else{
                return redirect()->route('admin.login');
            }

            return $next($request);
        });
    }
    
    // INDEX
    public function index(){

        $categories=ProductType::orderBy('product_type_id')->paginate(10);
        return view('admin.categories.index',compact('categories'));
    }

    // CREATE
    public function create(){

        return view('admin.categories.create');
    }

    // STORE
    public function store(Request $request){

        // PRODUCT TYPE TABLE VALIDATOR
        $validated = $request->validate([
            'title' => ['required','string','min:2'],
            'description' => ['required','string','min:2'],
            'image' => ['max:1999'],
        ]);

        // ASSIGN INPUT TO PRODUCT TYPE TABLE
        $category = new ProductType;
        $category->product_type_name = $request->input('title');
        $category->product_type_description = $request->input('description');
        
        // CHECK USER IMAGE IF EMPTY
        if($request->hasFile('image'))
        {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'.'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/seller/product_type_image',$filenameToStore); 

            $category->product_image = $filenameToStore;
        };

        // SAVE CATEGORY
        $category->save();

        // CHECK IF SUCCESSFUL
        if ($category){
            request()->session()->flash('success','Successfully added category');
        }
        else{
            request()->session()->flash('error','Error occurred while adding category');
        }
        return redirect()->route('admin.categories.index');
    }

    // SHOW
    public function show($id){
        return back();
    }

    // EDIT
    public function edit($id){
        $category = ProductType::find($id);
        if ($category){
            return view('admin.categories.edit',compact('category'));
        }
        else{
            request()->session()->flash('error','An error occurred');
            return redirect()->route('admin.categories.index');
        }
    }
    
    // UPDATE
    public function update(Request $request, $id){
        // PRODUCT TYPE TABLE VALIDATOR
        $validated = $request->validate([
            'title' => ['required','string','min:2'],
            'description' => ['required','string','min:2'],
            'image' => ['max:1999'],
        ]);

        $category = ProductType::find($id);
        $category->product_type_name = $request->input('title');
        $category->product_type_description = $request->input('description');
        
        // CHECK USER IMAGE IF EMPTY
        if($request->hasFile('image'))
        {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'.'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/seller/product_type_image',$filenameToStore); 

            $category->product_image = $filenameToStore;
        };

        // SAVE CATEGORY
        $category->save();

        if ($category){
            request()->session()->flash('success','Successfully updated category');
        }
        else{
            request()->session()->flash('error','Error occurred while updating category');
        }
        return redirect()->route('admin.categories.index');
    }
    
    // DESTROY
    public function destroy($id){
        $category = ProductType::find($id);
        $category->delete();

        if ($category){
            request()->session()->flash('success','Successfully deleted category');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting category');
        }
        return redirect()->route('admin.categories.index');
    }
}
