<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Brgy;
use App\ProductType;
class BrowsesController extends Controller
{
    public function __construct()
    {
       if(!Auth::check())
       {
           return redirect('/login');
       }
    }
    public function index(){

        $products = DB::table('products as a')
                ->leftJoin('stocks as b','b.product_id','=','a.product_id')
                ->leftJoin('prices as c','c.price_id','=','b.stock_id')
                ->paginate(5);
        $brgys = Brgy::all();
        $categories = ProductType::all();

        return view('welcome_nav.browse',compact('products','brgys','categories'));
    }
}
