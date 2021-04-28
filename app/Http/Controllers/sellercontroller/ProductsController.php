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
        $id = Auth::id();
        $seller_id = User::find($id)->seller->seller_id;
        $products = DB::table('stocks as a')
                    ->join('products as b', 'b.product_id', '=', 'a.product_id')
                    ->join('srp as c', 'c.product_id','=', 'b.product_id')
                    ->join('units as d', 'd.unit_id','=','c.unit_id')
                    ->join('prices as e','e.price_id', '=','d.unit_id')
                    ->select('a.stock_id','b.product_id','a.stock_image','b.product_name','d.unit_name','e.stock_price','a.qty_added','a.created_at','a.expiration_date','a.deleted_at')
                    ->where('a.seller_id',$seller_id)
                    ->get();
        Product::all();
        $stock = Stock::all();
        $unit = Unit::all();
       
        return view ('Seller_view.my-product',compact('products','stock','unit'));

    }

    public function addNewProduct(Request $request,$id=null)
    {
        $select =$id;
        $products = [];
         $productTypes = ProductType::all();
         $units = Unit::all();
         $brgy = Brgy::all();
         $srp = Srp::all();

         $productTypeExist = false;
        // $countActiveCategories = ProductType::countActiveCategories();
        // $productType = ProductType::all();
        // return  $productType->countActiveCategories;
        
        $count_id = ProductType::where('product_type_id',$id)->count();
        // return  $productType_id;
        if ($count_id > 0){

            $products = DB::table('products as a')
                        ->join('product_types as b','b.product_type_id','=', 'a.product_type_id')
                        ->leftJoin('srp as c','c.product_id','=','a.product_id')
                        ->where('a.product_type_id', $id)->get();
                // return dd($products);
                        $productTypeExist = true;

        }elseif($id==null){

            return view ('Seller_view.add-new-prod',compact('productTypes','units','brgy','srp','products','productTypeExist','select'));

        }
        else{
            return back();
        }

        return view ('Seller_view.add-new-prod',compact('productTypes','units','brgy','srp','products','productTypeExist','select'));

      
       
        
        //  if($request->segment(4))
        //  {      
        //  $products = DB::table('stocks as a')
        //     ->join('products as b','b.product_id','=','a.product_id')
        //     ->join('product_types as c','c.product_type_id', '=','b.product_type_id')
        //     ->join('prices as d','d.stock_id', '=','a.stock_id')
        //     ->join('units as e', 'e.unit_id','=','d.unit_id')
        //     ->join('srp as f', 'f.srp_id', '=','b.product_id')
        //     ->select('a.product_id','a.product_description','c.stock_image','a.product_name','e.unit_id','d.stock_price','c.qty_added','c.created_at','c.expiration_date','b.product_type_id')
        //     ->where('a.product_id','=',$request->segment(4))
        //     ->first();
           
        //  }

       
        // return view ('Seller_view.add-new-prod',compact('productTypes','units','brgy','srp'));
        

    }
    public function getProductName($id)
    {
        // echo json_encode(
        //     DB::table('products as a')
        //     ->leftJoin('srp as b', 'b.product_id', '=', 'a.product_id')
        //     ->where('a.product_type_id', $id)->get()
        // );

        echo json_encode(
            DB::table('products as a')
            ->join('srp as b', 'b.product_id', '=', 'a.product_id')
            ->join('product_types as c', 'c.product_type_id', '=', 'a.product_type_id')
            ->where('a.product_type_id', $id)
            ->get()
        );
    }

    public function storeNewProduct(Request $request)
    {
       
        // 
        // return dd($request->input('price'));
        $this->validate($request,[

            'stock' => 'required',
            'price' => 'required|numeric',
            'prod-img' =>'max:1999'

        ]);

        $id = Auth::id();
        $seller = User::find($id)->seller->seller_id;

         $price = new Price;
        $stock = new Stock;
          
        $stock->stock_description = $request->input('description');
        $stock->qty_added = $request->input('stock');
        $stock->expiration_date = $request->input('expiration');
        $stock->product_id = $request->input('product_name'); 
        $stock->seller_id = $seller;
        
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

        
       $stock->save();
       $stock->prices()->save($price);

       return redirect()->back()->with('success','Successfully added a product');
    }
        // if($request->input('product_id'))
        // {

       
        // $stockdetails = Stock::select('stock_id')->where([
        //     ['product_id' ,'=',$request->input('product_id')],
        //     ['seller_id', '=', $seller]
        // ])->first();

        // $pricedetails = Price::select('price_id')->where([
        //     ['stock_id' ,'=',$stockdetails->stock_id],
        //     ['unit_id', '=',$request->input('unit')]
        // ])->first();

        // $stock = Stock::find($stockdetails->stock_id);
        // $price = Price::find($pricedetails->price_id);   
        //     return 123;

        // }
        // else{
        //     $stock = new Stock;
        //     $price = new Price;
        // }    
        // return $stockdetails->stock_id;
        // $stock->stock_id = $stockdetails->stock_id;
      


      

      
       
    //    $stock->seller_id = $seller;

    //    if($request->input('product_id'))
    //    {
    //         if($request->hasFile('prod-img'))
    //         {
    //             $filenameWithExt = $request->file('prod-img')->getClientOriginalName();
    //             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
    //             $extension = $request->file('prod-img')->getClientOriginalExtension();
    //             $filenameToStore = $filename.'.'.time().'.'.$extension;
    //             $path = $request->file('prod-img')->storeAs('public/stock',$filenameToStore); 
    
    //             $stock->stock_image = $filenameToStore;
    //         };
 
    //         $stock->product_id = $request->input('product_id');
    //         // print_r($stock);die;
    //         $stock->update();
    //         $price->update();
            
        
    //    }
    //    else{
       
    //    }
      
    //    $seller=  Auth::id();
    //    $seller->stocks()->save( $stock_id);
      
    public function editProduct($id)
    {
        $stock = DB::table('stocks as a')
        ->join('products as b','b.product_id','=','a.product_id')
        ->join('product_types as c','c.product_type_id','=', 'b.product_type_id')
        ->join('prices as d','d.stock_id', '=', 'a.stock_id')
        ->join('units as e','e.unit_id','=','d.unit_id')
        ->leftJoin('srp as f','f.product_id','=','b.product_id')
        ->select('d.stock_price','e.unit_name','a.qty_added','a.expiration_date','a.stock_image',
        'a.product_id','.product_price', 'b.product_type_id','e.unit_id','b.product_description','a.stock_id')
        ->where('a.stock_id','=', $id)
        ->latest('d.created_at') 
        ->first();
        
        // $product_type = DB::table('products as a')
        // ->join('stocks as b','b.product_id','=', 'a.product_id')
        // ->select('a.product_type_id')
        // ->first();
        // return $stock->product_type_id;
        $products = DB::table('products as a')
        ->join('product_types as b','b.product_type_id','=', 'a.product_type_id')
        ->leftJoin('srp as c','c.product_id','=','a.product_id')
        ->select('a.product_id','a.product_name','c.product_price','b.product_image')
        ->where('a.product_type_id', $stock->product_type_id)->get();
      
      $productTypes = ProductType::all();
      $units = Unit::all();
    //   $product = stockData($id);
   
        return view('Seller_view.edit-product',compact('products','productTypes','units','stock'));
    }


    public function updateProduct(Request $request,$id)
    {
      
        // return  $request->input('stock');
        $seller_id = Auth::id();
        $seller = User::find($seller_id)->seller->seller_id;
 
        $stock = Stock::find($id);
    
        $stock->stock_description = $request->input('description');
        $stock->qty_added =  $request->input('stock');
        $stock->expiration_date =  $request->input('expiration');
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
        
    
        $stock->save();
        // return Price::where('stock_id',$id)->first();

        $priceCheck = Price::where('stock_id',$id)->latest()->first();

        if($priceCheck->stock_price == $request->input('price') &&  $priceCheck->unit_id == $request->input('unit') ){


            return redirect()->back();

        }

        else{
            
            $price = new Price;

            $price->stock_price = $request->input('price');
            $price->stock_id =  $id;
            $price->unit_id = $request->input('unit');
            
           
           
            $price->save();
     
        }
       
        return redirect()->back()->with('success','Successfully editted your product');

    

      
        // $seller = User::find($id)->seller->seller_id;
 
        // $stock = Stock::find($id);

        // $stock->stock_description = $request->input('description');
        // $stock->qty_added =  $request->input('stock');
        // $stock->expiration_date =  $request->input('expiration');

        // if($request->hasFile('prod-img'))
        // {
        //     $filenameWithExt = $request->file('prod-img')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
        //     $extension = $request->file('prod-img')->getClientOriginalExtension();
        //     $filenameToStore = $filename.'.'.time().'.'.$extension;
        //     $path = $request->file('prod-img')->storeAs('public/stock',$filenameToStore); 

        //     $stock->stock_image = $filenameToStore;
        // };
        
          
        // $price = new Price;

        // $price->stock_price = $request->input('price');
        // $price->stock_id =  $id;
        // $price->unit_id = $request->input('unit');
        // $price->save();
        
        // return  $request->input('product_name');

        // $stock->product_id = $request->input('product_name');
        // $stock->save();

        // $priceCheck = Price::where('stock_id',$id)->latest()->first();

        // if($price->stock_price == $request->input('price') && $price->unit_id == $request->input('unit') ){


        //  return redirect()->back();
 
      

    }

    

    public function deleteProduct($id)
    {
        
       $stock = Stock::where('stock_id',$id)->first();
        $stock->delete();
        return redirect()->back()->with('success','Successfully deleted a product');


    }

    private function stockData($id)
    {
        // $products = DB::table('stocks as a')
        // ->join('products as b','b.product_id','=','a.product_id')
        // ->join('product_types as c','c.product_type_id','=', 'b.product_type_id')
        // ->join('prices as d','d.stock_id', '=', 'a.stock_id')
        // ->join('units as e','e.unit_id','=','d.unit_id')
        // ->join('srp as f','f.product_id','=','b.product_id')
        // ->where('a.stock_id','=', $id)
        // ->first();
         
        // return $products;
    }
}