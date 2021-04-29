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

       
        // $products = DB::table('stocks as a')
        // ->join('products as b','b.product_id','=','a.product_id')
        // ->join('prices as c','c.stock_id','=','a.stock_id')
        // ->join('sellers as d','d.seller_id', '=','a.seller_id')
        // ->join('orgs as e','e.org_id','=','d.org_id')
        // ->join('brgys as f','f.brgy_id','=','e.brgy_id')
        // ->where('b.product_name', 'LIKE', "%".$_GET['s']."%")
        //  ->latest('a.created_at')
        // ->paginate(5);
        // Session::flush();
        if(isset($_GET['s'])){
            $products = DB::table('stocks as a')
            ->join('products as b','b.product_id','=','a.product_id')
            ->join('prices as c','c.stock_id','=','a.stock_id')
            ->join('sellers as d','d.seller_id', '=','a.seller_id')
            ->join('orgs as e','e.org_id','=','d.org_id')
            ->join('brgys as f','f.brgy_id','=','e.brgy_id')
            ->where('b.product_name', 'LIKE', "%".$_GET['s']."%")
            ->latest('c.created_at')
            ->paginate(5);
            // dd($products);
        }
        elseif(isset($_GET['category'])){
            $products = DB::table('stocks as a')
            ->join('products as b','b.product_id','=','a.product_id')
            ->join('prices as c','c.stock_id','=','a.stock_id')
            ->join('sellers as d','d.seller_id', '=','a.seller_id')
            ->join('orgs as e','e.org_id','=','d.org_id')
            ->join('brgys as f','f.brgy_id','=','e.brgy_id')
            ->where('b.product_type_id', '=', $_GET['category'])
            ->latest('c.created_at')
            ->paginate(5);
        }
        elseif(isset($_GET['brgy'])){
            $products = DB::table('stocks as a')
            ->join('products as b','b.product_id','=','a.product_id')
            ->join('prices as c','c.stock_id','=','a.stock_id')
            ->join('sellers as d','d.seller_id', '=','a.seller_id')
            ->join('orgs as e','e.org_id','=','d.org_id')
            ->join('brgys as f','f.brgy_id','=','e.brgy_id')
            ->where('f.brgy_id', '=', $_GET['brgy'])
            ->latest('c.created_at')
             ->paginate(5);
        }
        else{
            $products = DB::table('stocks as a')
                ->join('products as b','b.product_id','=','a.product_id')
                ->join('prices as c','c.stock_id','=','a.stock_id')
                ->join('sellers as d','d.seller_id', '=','a.seller_id')
                ->join('orgs as e','e.org_id','=','d.org_id')
                ->join('brgys as f','f.brgy_id','=','e.brgy_id')
                ->join('product_types as g','g.product_type_id','=','b.product_type_id')
                ->latest('c.created_at')
                ->paginate(5);
               
        }
        // return dd($products);
        $id = Auth::id();
       
        $brgys = Brgy::all();
        $categories = ProductType::all();

     

        return view('welcome_nav.browse',compact('products','brgys','categories'));
    }


    public function viewSellerDetails($id)
    {
        $products = DB::table('stocks as a')
                ->join('products as b','b.product_id','=','a.product_id')
                ->join('prices as c','c.price_id','=','a.stock_id')
                ->join('sellers as d','d.seller_id', '=','a.seller_id')
                ->join('orgs as e','e.org_id','=','d.org_id')
                ->join('brgys as f','f.brgy_id','=','e.brgy_id')
                ->join('units as g','g.unit_id','=','c.unit_id')
                ->join('users as h','h.user_id' ,'=' ,'d.user_id')
                ->join('product_types as i','i.product_type_id','=','b.product_type_id')
                ->select('a.seller_id','b.product_id','i.product_image','a.stock_id','a.stock_image','f.brgy_name','b.product_name','g.unit_name','c.stock_price','a.qty_added','a.created_at','a.expiration_date','h.f_name','h.m_name','h.l_name','h.user_image')
                ->where('a.stock_id','=',$id)
                ->first();
               
           
     

        return view('buyer_subpages.product-detail',compact('products'));
    }
}
