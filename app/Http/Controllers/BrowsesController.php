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
        if(isset($_GET['s'])){
            $products = DB::table('products as a')
                    ->leftJoin('stocks as b','b.product_id','=','a.product_id')
                    ->leftJoin('prices as c','c.price_id','=','b.stock_id')
                    ->leftJoin('sellers as d','d.seller_id', '=','b.seller_id')
                    ->leftJoin('orgs as e','e.org_id','=','d.org_id')
                    ->join('brgys as f','f.brgy_id','=','e.brgy_id')
                    ->where('a.product_name', 'LIKE', "%".$_GET['s']."%")
                    ->paginate(5);
        }
        elseif(isset($_GET['category'])){
            $products = DB::table('products as a')
                    ->leftJoin('stocks as b','b.product_id','=','a.product_id')
                    ->leftJoin('prices as c','c.price_id','=','b.stock_id')
                    ->leftJoin('sellers as d','d.seller_id', '=','b.seller_id')
                    ->leftJoin('orgs as e','e.org_id','=','d.org_id')
                    ->join('brgys as f','f.brgy_id','=','e.brgy_id')
                    ->where('a.product_type_id', '=', $_GET['category'])
                    ->paginate(5);
        }
        else{
            $products = DB::table('products as a')
                ->leftJoin('stocks as b','b.product_id','=','a.product_id')
                ->leftJoin('prices as c','c.price_id','=','b.stock_id')
                ->leftJoin('sellers as d','d.seller_id', '=','b.seller_id')
                ->leftJoin('orgs as e','e.org_id','=','d.org_id')
                ->join('brgys as f','f.brgy_id','=','e.brgy_id')
                ->paginate(5);
        }

        $brgys = Brgy::all();
        $categories = ProductType::all();

        return view('welcome_nav.browse',compact('products','brgys','categories'));
    }
}
