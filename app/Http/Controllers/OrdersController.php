<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Cart;
use DB;
use App\User;
class OrdersController extends Controller
{
    public function __construct()
    {
    //    if(!Auth::check())
    //    {
    //        return redirect('/login');
    //    }
    }
    
    public function index (){

        return view('buyer_pages.order');
        
    }

    public function cartIndex(){

        return view('buyer_subpages.cart');
    }

    public function checkoutIndex($id)
    {

       
        // if(!Session::has('cart')){

        //     return view('buyer_subpages.cart');
        // }
        
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $user_id = Auth::id();
        // $user = User::find($id)->buyer;
        // return $user;
    //    return $user_id = $user->id;
   
       
        $user = DB::table('users as a')
            ->leftJoin('buyers as b','b.user_id','=','a.user_id')
            ->leftJoin('brgys as c','c.brgy_id','b.brgy_id')
            ->select('c.brgy_id','a.user_id','b.address','a.f_name','a.m_name','a.l_name','a.mobile_number','c.brgy_name')
            ->where('a.user_id',$user_id)
            ->first();
       
        $oldCart = Session::get('cart');
        $newcart = new Cart($oldCart);
        $cartCounts =$newcart->items;
        // return dd( $cartCounts[]);
        $total = 0;
        // $total += $sub_total;
        foreach($cartCounts as $cart )
        {

            $sub_total = $cart['price'] * $cart['qty'];
            $total += $sub_total;
           
//             echo "<pre>events: ";
// print_r($cart);
// echo"</pre>";
        };
        
        // return dd($total);
       
        
        // return dd($cart->items[9]);
    // return dd($user);
        // return dd($cart->items);
      
        // return view('buyer_subpages.cart',['products' => $cart->items]);
        
        
        return view('buyer_subpages.checkout',['carts' => $cartCounts, 'user'=>$user,'total'=>$total, 'sub_total' => $sub_total]);
    }


    public function orderReceivedIndex()

    {
        return view('buyer_subpages.order-received');

    }

    public function orderReturn()
    {
        return view('buyer_subpages.orders-return');
    }

    public function viewOrderDetails()
    {
        return view ('buyer_subpages.view-order-details');
    }


    public function orderMyOrder ()
    {

        
        return view('buyer_subpages.myorders-order');
    }

    public function orderMyReturn()
    {

        return view('buyer_subpages.myorders-return');

    }
    public function orderMyCancellation()
    {
        return view('buyer_subpages.myorders-cancellation');

    }

}
