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
                    ->select('a.product_id','b.stock_image','a.product_name','d.unit_name','e.stock_price','b.qty_added','b.created_at','b.expiration_date','a.deleted_at')->get();

        
        Product::all();
        $stock = Stock::all();
        $unit = Unit::all();
       
        return view ('Seller_view.my-product',compact('products','stock','unit'));

    }

    public function addNewProduct(Request $request)
    {
       
        $products = [];
         $productTypes = ProductType::all();
         $units = Unit::all();
         $brgy = Brgy::all();
         $srp = Srp::all();
        
         if($request->segment(4))
         {      
         $products = DB::table('products as a')
            ->leftJoin('product_types as b','b.product_type_id', '=','a.product_type_id')
            ->leftJoin('stocks as c','c.product_id','=','a.product_id')
            ->leftJoin('prices as d','d.stock_id', '=','c.stock_id')
            ->leftJoin('units as e', 'e.unit_id','=','d.unit_id')
            ->leftJoin('srp as f', 'f.srp_id', '=','a.product_id')
            ->select('a.product_id','a.product_description','c.stock_image','a.product_name','e.unit_id','d.stock_price','c.qty_added','c.created_at','c.expiration_date','b.product_type_id')
            ->where('a.product_id','=',$request->segment(4))
            ->first();
           
         }

       
         return view ('Seller_view.add-new-prod',compact('productTypes','units','brgy','srp','products'));
        // return view ('Seller_view.add-new-prod',compact('productTypes','units','brgy','srp'));
        

    }
    public function getProductName($id)
    {
        echo json_encode(
            DB::table('products as a')
            ->leftJoin('srp as b', 'b.product_id', '=', 'a.product_id')
            ->where('a.product_type_id', $id)->get()
        );
    }

    public function storeNewProduct(Request $request,Product $product)
    {
       
        
        $this->validate($request,[

            'stock' => 'required',
            'price' => 'required|numeric',
            'prod-img' =>'max:1999'

        ]);

        $id = Auth::id();
        $seller = User::find($id)->seller->seller_id;

        

        
        $stockdetails = Stock::select('stock_id')->where([
            ['product_id' ,'=',$request->input('product_id')],
            ['seller_id', '=', $seller]
        ])->first();

        $pricedetails = Price::select('price_id')->where([
            ['stock_id' ,'=',$stockdetails->stock_id],
            ['unit_id', '=',$request->input('unit')]
        ])->first();
        if($request->input('product_id'))
        {

            $stock = Stock::find($stockdetails->stock_id);
            $price = Price::find($pricedetails->price_id);
        }
        else{
            $stock = new Stock;
            $price = new Price;
        }    
        // return $stockdetails->stock_id;
        // $stock->stock_id = $stockdetails->stock_id;
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

      

       $price->unit_id = $request->input('unit');
       $price->stock_price = $request->input('price');

      
       
       $stock->seller_id = $seller;

       if($request->input('product_id'))
       {
            if($request->hasFile('prod-img'))
            {
                $filenameWithExt = $request->file('prod-img')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
                $extension = $request->file('prod-img')->getClientOriginalExtension();
                $filenameToStore = $filename.'.'.time().'.'.$extension;
                $path = $request->file('prod-img')->storeAs('public/stock',$filenameToStore); 
    
                $stock->stock_image = $filenameToStore;
            };
 
            $stock->product_id = $request->input('product_id');
            // print_r($stock);die;
            $stock->update();
            $price->update();
            
        
       }
       else{
        $stock->save();
        $stock->prices()->save($price);
       }
      
    //    $seller=  Auth::id();
    //    $seller->stocks()->save( $stock_id);
       
       
       return redirect()->back()->with('success','Successfully added a product');
    }

    public function deleteProduct($id)
    {
        
       $product = Product::where('product_id',$id)->first();
        $product->delete();
        return redirect()->back()->with('success','Successfully deleted a product');


    }
}
