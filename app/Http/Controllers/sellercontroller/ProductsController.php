<?php

namespace App\Http\Controllers\sellercontroller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\ProductType;
use App\Unit;
use App\Srp;
use App\Brgy;
use App\Stock;
use App\Price;
use App\Product;
use App\Seller;
use App\User;
use DB;
class ProductsController extends Controller
{
    public function __construct()
    {
    //    if(!Auth::check())
    //    {
    //        return redirect('/login');
    //    }
    }
    public function productMyProduct()
    {
        
        $products = DB::table('products as a')
                    ->leftJoin('stocks as b', 'b.product_id', '=', 'a.product_id')
                    ->leftJoin('srp as c', 'c.srp_id','=', 'a.product_id')
                    ->leftJoin('units as d', 'd.unit_id','=','c.unit_id')
                    ->leftJoin('prices as e','e.price_id', '=','d.unit_id')
                    ->select('b.stock_image','a.product_name','d.unit_name','e.stock_price','b.qty_added','b.created_at','b.expiration_date')->get();

        
        Product::all();
        $stock = Stock::all();
        $unit = Unit::all();

        return view ('Seller_view.my-product',compact('products','stock','unit'));

    }

    public function addNewProduct()
    {
         $productTypes = ProductType::all();
         $units = Unit::all();
         $brgy = Brgy::all();
         $srp = Srp::all();
        
        return view ('Seller_view.add-new-prod',compact('productTypes','units','brgy','srp'));

    }
    public function getProductName($id)
    {
        echo json_encode(
            DB::table('products as a')
            ->leftJoin('srp as b', 'b.product_id', '=', 'a.product_id')
            ->where('a.product_type_id', $id)->get()
        );
    }

    public function storeNewProduct(Request $request)
    {
        
        $this->validate($request,[

            'price' => 'required|numeric',

        ]);
   
        $stock = new Stock;
        $stock->stock_description = $request->input('description');
        $stock->qty_added = $request->input('stock');
        $stock->expiration_date = $request->input('expiration');
        $stock->product_id = $request->input('product_name'); 

        if($request->hasFile('prod-img'))
       {
           $filenameWithExt = $request->file('prod-img')->getClientOriginalName();
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
           $extension = $request->file('prod-img')->getClientOriginalExtension();
           $filenameToStore = $filename.'.'.time().'.'.$extension;
           $path = $request->file('prod-img')->storeAs('public/stock',$filenameToStore); 

           $stock->stock_image = $filenameToStore;
       };

       $price = new Price;

       $price->unit_id = $request->input('unit');
       $price->stock_price = $request->input('price');

       $stock->seller_id =  Auth::id();
       $stock->save();
    //    $seller=  Auth::id();
    //    $seller->stocks()->save( $stock_id);
       $stock->prices()->save($price);

       return redirect()->back()->with('success','Successfully added a product');
    }
}
