<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ProductType;
use App\Stock;
use App\Price;

class StocksController extends Controller
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
        $stocks = DB::table('stocks as a')
            ->join('products as b', 'a.product_id', 'b.product_id')
            ->join('sellers as c', 'a.seller_id', 'c.seller_id')
            ->join('users as d', 'c.user_id', 'd.user_id')
            ->join('product_types as e', 'b.product_type_id', 'e.product_type_id')
            ->where('a.deleted_at', NULL)
            ->paginate(10);
        return view('admin.stocks.index',compact('stocks'));
    }

    // CREATE
    public function create($id=null)
    {
        // COUNT PRODUCT TYPES & RETURN PRODUCTS FROM $id
        $count_id = ProductType::where('product_type_id',$id)->count();
        if ($count_id > 0){
            $products = DB::table('products as a')
                ->join('product_types as b','b.product_type_id','=', 'a.product_type_id')
                ->leftJoin('srp as c','c.product_id','=','a.product_id')
                ->where('a.product_type_id', $id)->get();
                $productTypeExist = true;

            if ($products){
                $category = $id;
            }

        }elseif($id==null){
            $category = null;
            $products = false;

        }
        else{
            return back();
        }

        return view ('admin.stocks.create',compact('products','category'));
    }
    
    // STORE
    public function store(Request $request)
    {
        // STOCK TABLE VALIDATOR
        $validated = $request->validate([
            'seller' => ['required'],
            'product' => ['required'],
            'stock_quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'unit' => ['required'],
            'expiration' => ['required'],
            'stock_image' => ['max:1999'],

        ]);
        
        // CREATE STOCK
        $stock = new Stock;
        $stock->seller_id = $request->input('seller');
        $stock->product_id = $request->input('product');
        $stock->stock_description = $request->input('stock_description');
        $stock->qty_added = $request->input('stock_quantity');
        $stock->expiration_date = $request->input('expiration');
        
        // CHECK STOCK IMAGE IF EMPTY
        if($request->hasFile('stock_image'))
        {
            $filenameWithExt = $request->file('stock_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('stock_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'.'.time().'.'.$extension;
            $path = $request->file('stock_image')->storeAs('public/stock',$filenameToStore); 

            $stock->stock_image = $filenameToStore;
        };

        // SAVE CATEGORY
        $stock->save();
        
        // CREATE PRICE
        $price =  new PRICE;
        $price->unit_id = $request->input('unit');
        $price->stock_price = $request->input('price');
        $stock->prices()->save($price);

        if ($price){
            request()->session()->flash('success','Successfully added stock');
        }
        else{
            request()->session()->flash('error','Error occurred while adding stock');
        }
        return redirect()->route('admin.stocks.index');
    }

    // SHOW
    public function show($id)
    {
        return back();
    }

    // EDIT
    public function edit($id)
    {
        $products = DB::table('products as a')
            ->join('product_types as b','b.product_type_id','=', 'a.product_type_id')
            ->leftJoin('srp as c','c.product_id','=','a.product_id')
            ->where('a.product_type_id', $id)
            ->get();

        $stock = DB::table('stocks as a')
            ->join('prices as b','b.stock_id','=', 'a.stock_id')
            ->where('a.stock_id', $id)
            ->latest('b.created_at')
            ->first();
        
        $category = DB::table('stocks as a')
            ->join('products as b','b.product_id','=', 'a.product_id')
            ->join('product_types as c','b.product_type_id','=', 'c.product_type_id')
            ->where('a.product_id', $stock->product_id)
            ->pluck('c.product_type_id')
            ->first();

        if ($category){
            return view ('admin.stocks.edit',compact('products', 'stock', 'category'));
        }
        else{
            return back();
        }

    }

    // UPDATE
    public function update(Request $request, $id)
    {
        // STOCK TABLE VALIDATOR
        $validated = $request->validate([
            'seller' => ['required'],
            'product' => ['required'],
            'stock_quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'unit' => ['required'],
            'expiration' => ['required'],
            'stock_image' => ['max:1999'],

        ]);
    
        // UPDATE STOCK
        $stock = Stock::find($id);
        $stock->seller_id = $request->input('seller');
        $stock->product_id = $request->input('product');
        $stock->stock_description = $request->input('stock_description');
        $stock->qty_added = $request->input('stock_quantity');
        $stock->expiration_date = $request->input('expiration');
        
        // CHECK STOCK IMAGE IF EMPTY
        if($request->hasFile('stock_image'))
        {
            $filenameWithExt = $request->file('stock_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('stock_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'.'.time().'.'.$extension;
            $path = $request->file('stock_image')->storeAs('public/stock',$filenameToStore); 

            $stock->stock_image = $filenameToStore;
        };

        // SAVE CATEGORY
        $stock->save();

        // CHECK PRICE IF UPDATED
        $priceCheck = Price::where('stock_id',$id)->latest()->first();
        if($priceCheck->stock_price != $request->input('price') || $priceCheck->unit_id != $request->input('unit') ){
            $price = new Price;
            $price->stock_id =  $id;
            $price->stock_price = $request->input('price');
            $price->unit_id = $request->input('unit');
            $price->save();
        } 

        if ($stock){
            request()->session()->flash('success','Successfully updated stock');
        }
        else{
            request()->session()->flash('error','Error occurred while updating stock');
        }
        return redirect()->route('admin.stocks.index');
    }

    // DESTROY
    public function destroy($id)
    {
        $stock = Stock::find($id);
        $stock->delete();

        if ($stock){
            request()->session()->flash('success','Successfully deleted stock');
        }
        else{
            request()->session()->flash('error','Error occurred while deleting stock');
        }
        return redirect()->route('admin.stocks.index');
    }
}
