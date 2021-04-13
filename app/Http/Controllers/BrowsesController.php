<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Brgy;
use App\ProductType;
use App\User;
use Session;
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

        // Session::flush();
        if(isset($_GET['s'])){
            $products = DB::table('products as a')
                    ->leftJoin('stocks as b','b.product_id','=','a.product_id')
                    ->leftJoin('prices as c','c.price_id','=','b.stock_id')
                    ->leftJoin('sellers as d','d.seller_id', '=','b.seller_id')
                    ->leftJoin('orgs as e','e.org_id','=','d.org_id')
                    ->leftJoin('brgys as f','f.brgy_id','=','e.brgy_id')
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
        elseif(isset($_GET['brgy'])){
            $products = DB::table('products as a')
                    ->leftJoin('stocks as b','b.product_id','=','a.product_id')
                    ->leftJoin('prices as c','c.price_id','=','b.stock_id')
                    ->leftJoin('sellers as d','d.seller_id', '=','b.seller_id')
                    ->leftJoin('orgs as e','e.org_id','=','d.org_id')
                    ->leftJoin('brgys as f','f.brgy_id','=','e.brgy_id')
                    ->where('f.brgy_id', '=', $_GET['brgy'])
                    ->paginate(5);
        }
        else{
            $products = DB::table('products as a')
                ->leftJoin('stocks as b','b.product_id','=','a.product_id')
                ->leftJoin('prices as c','c.price_id','=','b.stock_id')
                ->leftJoin('sellers as d','d.seller_id', '=','b.seller_id')
                ->leftJoin('orgs as e','e.org_id','=','d.org_id')
                ->leftJoin('brgys as f','f.brgy_id','=','e.brgy_id')
                ->orderBy('b.created_at','ASC')
                ->paginate(5);
               
        }
        $id = Auth::id();
       
        $brgys = Brgy::all();
        $categories = ProductType::all();

     

        return view('welcome_nav.browse',compact('products','brgys','categories'));
    }


    public function viewSellerDetails($id)
    {
        $products = DB::table('products as a')
                ->leftJoin('stocks as b','b.product_id','=','a.product_id')
                ->leftJoin('prices as c','c.price_id','=','b.stock_id')
                ->leftJoin('sellers as d','d.seller_id', '=','b.seller_id')
                ->leftJoin('orgs as e','e.org_id','=','d.org_id')
                ->leftJoin('brgys as f','f.brgy_id','=','e.brgy_id')
                ->leftJoin('units as g','g.unit_id','=','c.unit_id')
                ->leftJoin('users as h','h.user_id' ,'=' ,'d.user_id')
                ->select('b.stock_image','f.brgy_name','a.product_name','g.unit_name','c.stock_price','b.qty_added','b.created_at','b.expiration_date','h.f_name','h.m_name','h.l_name','h.user_image')
                ->where('a.product_id','=',$id)
                ->first();
               


        return view('buyer_subpages.product-detail',compact('products'));
    }
}
