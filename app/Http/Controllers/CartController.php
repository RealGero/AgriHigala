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

    public function addFromSellerProfile(Request $request,$id)
    {   
      
        // $request->session()->flush();
        $products = DB::table('products  as a')
        ->join('stocks as b','b.product_id','=','a.product_id')
        ->join('prices as c','c.stock_id','=','b.stock_id')
        ->join('sellers as d','d.seller_id', '=','b.seller_id')
        ->join('orgs as e','e.org_id','=','d.org_id')
        ->join('brgys as f','f.brgy_id','=','e.brgy_id')
        ->join('units as g','g.unit_id','=','c.unit_id')
        ->join('users as h','h.user_id' ,'=' ,'d.user_id')
        ->join('product_types as i', 'i.product_type_id','=','a.product_type_id')
        ->where('a.product_id', '=' ,$id)
        ->first();
      
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        
        $cart->add($products,$id);
        
        $request->session()->put('cart', $cart);

        
        // dd( $request->session()->get('cart'));
       
       
    
    //    Cart::add($request->id,$request->name,1,$request->price,['image' => $request->image])
    //     ->associate('App\Product');

        return  redirect()->route('cart.index');
        // ('welcome_nav.browse');
    }
    public function add(Request $request,$id)
    {   
      
        // $request->session()->flush();
        $products = DB::table('products  as a')
        ->join('stocks as b','b.product_id','=','a.product_id')
        ->join('prices as c','c.stock_id','=','b.stock_id')
        ->join('sellers as d','d.seller_id', '=','b.seller_id')
        ->join('orgs as e','e.org_id','=','d.org_id')
        ->join('brgys as f','f.brgy_id','=','e.brgy_id')
        ->join('units as g','g.unit_id','=','c.unit_id')
        ->join('users as h','h.user_id' ,'=' ,'d.user_id')
        ->join('product_types as i', 'i.product_type_id','=','a.product_type_id')
        ->where('b.stock_id', '=' ,$id)
        ->first();
      
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        
        $cart->add($products,$id);
        
        $request->session()->put('cart', $cart);

        
        // dd( $request->session()->get('cart'));
       
       
    
    //    Cart::add($request->id,$request->name,1,$request->price,['image' => $request->image])
    //     ->associate('App\Product');

        return  redirect()->route('browse.index');
        // ('welcome_nav.browse');
    }

    public function getCart()
    {
        $sellers = [];
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
    
        if(Session::has('cart')){
    
            $cartCounts = $cart->items;

        foreach($cartCounts as $cartCount)
        {

            array_push($sellers,$cartCount['item']->seller_id);
            //  $sellerInfo =  array(
            //     'id' => $cartCount['item']->seller_id,
            //     'name' => $cartCount['item']->username,
            //   );
           
        };
        $sellers= array_unique($sellers);
          
        }
        
    //    $sellerInfo =  array_unique(array_column($sellers['id']));
    //    return dd($sellers);
      
        // return dd($cart->items[]);
        // return dd($cart->items);
        return view('buyer_subpages.cart',['products' => $cart->items, 'sellers' => $sellers]);

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

    // public function deleteSession()
    // {
    //     Session::flush();

    //     return view('Seller_view.seller-dashboard');
    // }

    public function changeQty(Request $request, $id)
    {
        // return $id;
        $cart = session()->get('cart');
        // return dd($cart->items[$id]['qty']);
        // return var_dump($cart); 
        // 'propertyOne' => 'foo',
        // foreach ($cart->items as $item){
        //     if ($item['item']->product_id == $id){
        //         return dd($item);
        //     }
        // }
       
        
        // return dd($cart[$id]['qty']); 
        // return dd($cart->items);
        // return dd($cart->totalQty); 
        // return dd($cart->items['product_id']);  
       
        if ($request->change_to === 'down') {
            if (isset($cart->items[$id]['item']->product_id)) {
                if ( $cart->items[$id]['qty'] > 1) {
                    $cart->items[$id]['qty']--;
                    
                    return $this->setSessionAndReturnResponse($cart);
                } 
                // else {
                //     return $this->removeFromCart($product->id);
                //    return $this->deleteCart($id);
                // }
            }
        } else {
           
            $cart->items[$id]['qty']++;
            // return dd($cart->items[$id]['qty']);
            // $cart->items[$id]['']
           
            
            return $this->setSessionAndReturnResponse($cart);

        }
        return back();
    }
 

    protected function setSession($cart)
    {
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    protected function setSessionAndReturnResponse($cart)
    {
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', "Added to Cart");
    }


}
