<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Cart;
use App\Fee;
use App\Order;
use App\Payment;
use App\OrderLine;
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
    


    // public function index (){


    //     return 123;
    //     return view('buyer_pages.order');
        
    // }

    // public function cartIndex(){

    //     return view('buyer_subpages.cart');
    // }

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
        // $total = 0;  
        $seller = $id;
     
      
        // return view('buyer_subpages.cart',['products' => $cart->items]);
        
        
        return view('buyer_subpages.checkout',['carts' => $cartCounts, 'user'=>$user, 'seller' => $seller ]);
    }

    public function clickedPlaceOrder(Request $request, $id)
    {

        // return $id;
       $cart =  $request->session()->get('cart');
        $cartCounts = $cart->items;
        $total= 0;

        if($cartCounts)
        {
            $fee = Fee::where('seller_id',$id)->latest('created_at')->first(); 
           $auth_id =  Auth::id();
            $buyer_id = User::find($auth_id)->buyer->buyer_id;

            $order = new Order;
            $order->buyer_id =   $buyer_id;
            $order->save();
   
            foreach($cartCounts as $cartCount)
            {   
             
                
                // return dd($cartCount);
                    if($cartCount['item']->seller_id == $id)
                    {
                     
                       
                        $stock_id = $cartCount['item']->stock_id;
                    //    return print_r($cartCount[$stock_id]); die;
                        $orderLine = new OrderLine;
                        $orderLine->stock_id = $cartCount['item']->stock_id;
                        $orderLine->order_qty = $cartCount['qty'];

                        $order->orderLines()->save($orderLine);
              
                        $sub_total = $cartCount['price'] * $cartCount['qty'];
                        $total += $sub_total;

                        $cart = $request->session()->get('cart');
                        if(array_key_exists($stock_id,$cart->items))
                        {
                            unset($cart->items[$stock_id]);
                        }
                        $oldCart =  $request->session()->get('cart');

                        $updatedCart = new Cart($oldCart);
                        $updatedCart->updatePriceAndQuantity();

                        $request->session()->put('cart', $updatedCart);

                     
                    }
                    
                   
            }
          
          
           
            if($request->input('payment_method') == 1)
            {
                $payment = new Payment;
    
                $payment->fee_id = $fee->fee_id;
                $payment->payment_order = $total;
                $payment->payment_total = $total + $fee->fee_delivery + $fee->fee_other;
                
                
                $order->payment()->save($payment);
                    
                return redirect()->route('buyer.order')->with('success' ,'Order Added! Please wait for seller confirmation');
               
            }
    
                
            elseif($request->input('payment_method') == 2){

                $payment = new Payment;
                $payment->payment_method='online';
                $payment->fee_id = $fee->fee_id;
                $payment->payment_order = $total;
                $payment->payment_total = $total + $fee->fee_delivery + $fee->fee_other;
                $order->payment()->save($payment);
              
                // return ($buyer_id);
                $seller = DB::table('seller_banks as a')
                ->join('sellers as b','b.seller_id','a.seller_id')
                ->where('a.seller_id',$id)->first();



                $payment = DB::table('payments as a')
                ->join('orders as b','b.order_id','=','a.order_id')
                // ->leftJoin('buyers as c','c.buyer_id','b.buyer_id')
                ->where('b.buyer_id','=', Auth::id())
                ->latest('a.created_at')
                ->first();
                
                
                // return dd($payment->buyer_id);

            
                return view('buyer_subpages.payment',compact('seller','payment'));
            }

        }
    }
        // return dd($cartCounts);
       
        
    //     public function paymentIndex()
    //    {

        
    //     return view('buyer_subpages.payment');

    //    }

        // $a = reset($cart->items);
        // $seller_id = $a['item']->seller_id;
        // return dd($cart);
       

        // return ($cart->items['item']->seller_id);
        // $oldCart = $cart['items'];
       
      
        // $fee_id = 

        // $payment = new Payment;
        // $payment->fee_id = 
        // $order = new Order;
        //     $order->payment_id =    
        //     $order->buyer_id =    

     
        // elseif () {
            
        // }
        // else{

        // }
       
    public function changeToCod(Request $request,$id)
    {
        
        $paymentCod = Payment::find($id);

      
        $paymentCod->payment_method = 'cod';

        $paymentCod->save();

        return redirect()->route('buyer.order')->with('success','Order Added! Please wait for seller confirmation');

    }

      public function paymentImage(Request $request,$id)
      {
        
        // $this->validate($request,[
        //     'payment-img' => ['required', 'max:1999']
        //  ]);
         
        $payment = Payment::find($id);
      
        if($request->hasFile('payment-img'))
        {
            $filenameWithExt = $request->file('payment-img')->getClientOriginalName();
           
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('payment-img')->getClientOriginalExtension();
            $filenameToStore = $filename.'.'.time().'.'.$extension;
            $path = $request->file('payment-img')->storeAs('public/payment',$filenameToStore); 
            

             $payment->payment_image = $filenameToStore;
             $payment->payment_method = 'online';
             $payment->save();
          
        }
        
        

       

        return redirect()->route('buyer.order')->with('success','Order Added! Please wait for seller confirmation');
      }  

      public function orderMyOrder($id=null)
    {
       
        $status = $id;
        switch ($status) {
            // requesting
            case '1':
                $orders = DB::table('orders as a')
                ->join('payments as b','b.order_id','a.order_id')
                ->whereNull('a.accepted_at')
                ->orderBy('a.order_id','desc')
                ->get();
            //    dd($orders);
            break;

            // pending
            case '2':
                $orders = DB::table('orders as a')
                ->join('payments as b','b.order_id','a.order_id')
                ->whereNotNull('a.accepted_at')
                ->whereNull('a.packed_at')
                ->orderBy('a.order_id','desc')
                ->get();
            break;

            // delivery
            case '3':
                $orders = DB::table('orders as a')
                ->join('payments as b','b.order_id','a.order_id')
                ->whereNotNull('a.packed_at')
                ->whereNull('a.delivered_at')
                ->orderBy('a.order_id','desc')
                ->get();
            break;

            // recieved
            case '4':
                $orders = DB::table('orders as a')
                ->join('payments as b','b.order_id','a.order_id')
                ->whereNotNull('a.delivered_at')
                ->whereNull('a.completed_at')
                ->orderBy('a.order_id','desc')
                ->get();

            break;
            
            default:
                
                $orders = DB::table('orders as a')
                ->join('payments as b','b.order_id','a.order_id')
                ->orderBy('a.created_at','desc')
                ->get();
                break;
            // ->select('a.order_id','a.created_at','b.payment_total')
            // ->join('orderlines as c','c.order_id','a.order_id')
            // ->join('stocks as d','d.stock_id','c.stock_id')
            // ->join('sellers as e','e.seller_id','d.seller_id')
           
        }
        
        
        return view('buyer_subpages.myorders-order',compact('status','orders'));
    }

    public function viewMoreOrder($id)
    {
        // return $id;
        $order = DB::table('orders as a')
                ->leftJoin('payments as b','b.order_id','a.order_id')
                ->leftJoin('fees as c','c.fee_id','b.fee_id')
                ->leftJoin('sellers as d','d.seller_id','c.seller_id')
                ->leftJoin('riders as e','e.seller_id','d.seller_id')
                ->join('orgs as f','f.org_id','d.org_id')
                ->where('a.order_id',$id)
                ->first();
        // dd($order);
        
         $orderLine = DB::table('orderlines as a')
                ->join('stocks as b','b.stock_id','a.stock_id')
                ->join('products as c','c.product_id','b.product_id')
                ->join('product_types as d','d.product_type_id','c.product_type_id')
                ->join('prices as e','e.stock_id','b.stock_id')
                ->join('units as f','f.unit_id','e.unit_id')
                ->where('a.order_id',$id)
                ->get();  
        // return dd($orderLine);
        // return dd($orderLine);
        return view('buyer_subpages.myorders-viewmore',compact('order','orderLine'));
    }
    
    public function uploadImageInViewOrder(Request $request,$id)
    {
        $payment = Payment::find($id);

        if($request->hasFile('online-payment-img'))
        {
            $filenameWithExt = $request->file('online-payment-img')->getClientOriginalName();
           
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('online-payment-img')->getClientOriginalExtension();
            $filenameToStore = $filename.'.'.time().'.'.$extension;
            $path = $request->file('online-payment-img')->storeAs('public/payment',$filenameToStore); 
            

             $payment->payment_image = $filenameToStore;
             $payment->payment_method = 'online';
             $payment->save();
          
        }

        return redirect()->back()->with('success','Successfully Uploaded a Payment Photo, Wait for the confirmation Thank you!');

    }


    // Serller Order Side -----------------------------------------------------------------------
    public function orderRequest()
    {

        $title = 'order';

        // GET ORDER, PAYMENT, & RETURN ORDER
        $orders = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'd.seller_id')
            ->where('a.completed_at', null)
            ->where('c.return_id', null)
            ->paginate(10);

        return view('Seller_view.order-request',compact('orders','title'));
    }

    public function sellerOrderRequest(Request $request, $id){
        
        // CHECK IF THERE'S A RESPONSE
        $response = $request->input('response');
        if ($response == 'accept'){
            $order = Order::find($id);
            $order->accepted_at = now();
            $order->save();
            request()->session()->flash('success','Order accepted');
        }
        elseif ($response == 'reject') {
            $order = Order::find($id);
            $order->completed_at = now();
            $order->save();
            request()->session()->flash('success','Order rejected');
        }
        else{
            request()->session()->flash('error','Error occurred while updating order');
        }
        return redirect()->route('order.request.index',[$id]);
    }

    public function orderPacked(Request $request,$id)
    {
          // VALIDATOR FOR RIDER
          $validated = $request->validate([
            'rider' => ['required']
        ]);

        // CHECK IF THERE'S A RESPONSE
        $response = $request->input('response');
        if ($response == 'packed'){
            $order = Order::find($id);
            $order->rider_id = $request->input('rider');
            $order->packed_at = now();
            $order->save();
            request()->session()->flash('success','Order packed');
        }

        return redirect()->route('order.request.index',[$id]);
    }

    public function sellerViewmore($id)
    {
        $title = 'order';

        // FIND ORDER
        $order = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->join('sellers as e','e.seller_id','d.seller_id')
            ->join('orgs as f','f.org_id','e.org_id')
            ->select('f.org_name','d.*','a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'd.seller_id')
            ->where('a.order_id', $id)
            ->first();

            $orderLine = DB::table('orderlines as a')
            ->join('stocks as b','b.stock_id','a.stock_id')
            ->join('products as c','c.product_id','b.product_id')
            ->join('product_types as d','d.product_type_id','c.product_type_id')
            ->join('prices as e','e.stock_id','b.stock_id')
            ->join('units as f','f.unit_id','e.unit_id')
            ->where('a.order_id',$id)
            ->get();

            return view('seller_view.seller-viewmore',compact('order','title','orderLine'));

        // if ($order){
           
        // }
        // else{
        //     request()->session()->flash('error','Order not found');
        //     return redirect()->route('');
        // }
    }

    // Order ----- RIDER SIDE -------------------------------------------------------------------

    


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


    

    public function orderMyReturn()
    {

        return view('buyer_subpages.myorders-return');

    }
    public function orderMyCancellation()
    {
        return view('buyer_subpages.myorders-cancellation');

    }

}
