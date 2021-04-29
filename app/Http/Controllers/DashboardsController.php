<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
class DashboardsController extends Controller
{
    public function sellerIndex(){

        $auth = Auth::id();
        $id = User::find($auth)->seller->seller_id; 
      
    //  $id = User::find(Auth::id())->seller; 
    //  $stocks =  DB::table('stocks as a')
    //         ->join('sellers as b','b.seller_id','=','a.seller_id')
    //         ->join('products as c','c.product_id','=','a.product_id')
    //         ->join('product_types as d','d.product_type_id','=','c.product_type_id')
    //         ->join('users as e','e.user_id','=','b.user_id')
    //         ->where('b.user_id' , '=', $id)
    //         ->get();
            return view('Seller_view.seller-dashboard',compact('id'));
        }
    
    //  $meats =  DB::table('stocks as a')
    //         ->join('sellers as b','b.seller_id','=','a.seller_id')
    //         ->join('products as c','c.product_id','=','a.product_id')
    //         ->join('product_types as d','d.product_type_id','=','c.product_type_id')
            
    //         ->where([
    //             ['b.user_id' , '=', $id],
    //             ['d.product_type_name', '=', 'meat']
    //         ])
    //         ->get();   

    // $vegetables =  DB::table('stocks as a')
    //         ->join('sellers as b','b.seller_id','=','a.seller_id')
    //         ->join('products as c','c.product_id','=','a.product_id')
    //         ->join('product_types as d','d.product_type_id','=','c.product_type_id')
            
    //         ->where([
    //             ['b.user_id' , '=', $id],
    //             ['d.product_type_name', '=', 'vegetable']
    //         ])
    //         ->get(); 


    // $fruits =  DB::table('stocks as a')
    //         ->join('sellers as b','b.seller_id','=','a.seller_id')
    //         ->join('products as c','c.product_id','=','a.product_id')
    //         ->join('product_types as d','d.product_type_id','=','c.product_type_id')
            
    //         ->where([
    //             ['b.user_id' , '=', $id],
    //             ['d.product_type_name', '=', 'fruits']
    //         ])
    //         ->get();                         
            
            
                // return dd($fishes);

   
}
