<?php

namespace App\Http\Controllers;
// namespace Gloudemans\Shoppingcart\Facades;
use Illuminate\Http\Request;
use App\Cart;
use DB;
use Session;
class CartController extends Controller
{
    
    public function index()
    {
        
        return view('buyer_subpages.cart');
    }
    public function add(Request $request,$id)
    {   
      
        $products = DB::table('products as a')
        ->leftJoin('stocks as b','b.product_id','=','a.product_id')
        ->leftJoin('prices as c','c.price_id','=','b.stock_id')
        ->leftJoin('sellers as d','d.seller_id', '=','b.seller_id')
        ->leftJoin('orgs as e','e.org_id','=','d.org_id')
        ->leftJoin('brgys as f','f.brgy_id','=','e.brgy_id')
        ->leftJoin('units as g','g.unit_id','=','c.unit_id')
        ->leftJoin('users as h','h.user_id' ,'=' ,'d.user_id')
        ->where('a.product_id', '=' ,$id)
        ->first();
        
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
       
        $cart->add($products, $products->product_id);
        
        $request->session()->put('cart', $cart);
        // dd( $request->session()->get('cart'));
       
       
    
    //    Cart::add($request->id,$request->name,1,$request->price,['image' => $request->image])
    //     ->associate('App\Product');

        return  redirect()->route('browse.index');
        // ('welcome_nav.browse');
    }

    public function getCart()
    {
        if(!Session::has('cart')){

            return view('buyer_subpages.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
     
        return view('buyer_subpages.cart',['products' => $cart->items , 'totalPrice' => $cart->totalPrice]);

    }

    public function deleteCart(Request $request,$id)
    {
        $cart = $request->session()->get('cart');
        if(array_key_exists($id,$cart->items))
        {
            unset($cart->items[$id]);
        }
        $oldCart =  $request->session()->get('cart');

        $updatedCart = new Cart($oldCart);
        $updatedCart->updatePriceAndQuantity();

        $request->session()->put('cart', $updatedCart);

        return redirect()->route('cart.index');

    }
    public function deleteSession()
    {
        Session::flush();

        return view('Seller_view.seller-dashboard');
    }
}
