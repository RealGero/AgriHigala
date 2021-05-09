<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use App\Cart;
use App\Fee;
use App\Order;
use App\Payment;
use App\OrderLine;
use App\User;
use App\ReturnOrder;
use App\Seller;
use App\Notifications\NewOrder;
use App\Buyer;
use App\Rider;
class OrdersController extends Controller
{
   

    public function checkoutIndex($id)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

     

       
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
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }
       
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
            $order->buyer_id = $buyer_id;
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
                
                // NOTIFICATION
                 $seller = Seller::find($id)->user->user_id;
                // $notify_id = Seller::find($seller)->user->user_id;
           
                // ASSIGN VALUES
                $notify_user = $seller; // ID sa e-notify; NOT NULL
                $notify_info = $order; // Query gihimu; NOT NULL
                $notify_title = 'Order '; // Title or table; NOT NULL
                $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
                $notify_subtitle = 'New Order COD'; // Title description; NOT NULL            
                $notify_url = route('order.request.index') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
                
               
                // SAVE TO NOTIFY_INFO
                $notify_info->title = $notify_title;
                $notify_info->table_id = $notify_table_id.': ';
                $notify_info->subtitle = $notify_subtitle;
             
                $notify_info->action_url = $notify_url;
                User::find($notify_user)->notify(new NewOrder($notify_info));
                      

                return redirect()->route('buyer.order')->with('success' ,'Order Added! Please wait for seller confirmation');
               
            }
    
                
            elseif($request->input('payment_method') == 2){
              
                $payment = new Payment;
                $payment->payment_method='online';
                $payment->fee_id = $fee->fee_id;
                $payment->payment_order = $total;
                $payment->payment_total = $total + $fee->fee_delivery + $fee->fee_other;
            
                $order->payment()->save($payment);
                $seller = DB::table('seller_banks as a')
                ->join('sellers as b','b.seller_id','a.seller_id')
                ->where('a.seller_id',$id)->first();

                $seller_id = Seller::find($id)->user->user_id;
                // $notify_id = Seller::find($seller)->user->user_id;
           
                // ASSIGN VALUES
                $notify_user = $seller_id; // ID sa e-notify; NOT NULL
                $notify_info = $order; // Query gihimu; NOT NULL
                $notify_title = 'Order '; // Title or table; NOT NULL
                $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
                $notify_subtitle = 'New Order Online payment'; // Title description; NOT NULL            
                $notify_url = route('order.request.index') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
                
               
                // SAVE TO NOTIFY_INFO
                $notify_info->title = $notify_title;
                $notify_info->table_id = $notify_table_id.': ';
                $notify_info->subtitle = $notify_subtitle;
             
                $notify_info->action_url = $notify_url;
                User::find($notify_user)->notify(new NewOrder($notify_info));
           

            
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
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }
        
        $order = Payment::find($id);

       
        $order->payment_method = 'cod';

        $order->save();

        
        $fee_id = Payment::find($id)->fee_id;
        $seller_id = Fee::find($fee_id)->seller_id;
        $user_id = Seller::find($seller_id)->user->user_id;
        $order = Order::find($order->order_id);
        // $buyer_id = Buyer::find($buyer)->user->user_id;
      
        // $notify_id = Seller::find($seller)->user->user_id;
   
        // ASSIGN VALUES
        $notify_user =  $user_id; // ID sa e-notify; NOT NULL
        $notify_info = $order; // Query gihimu; NOT NULL
        $notify_title = 'Order '; // Title or table; NOT NULL
        $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'New order cod'; // Title description; NOT NULL            
        $notify_url = route('order.request.index') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
       
        // SAVE TO NOTIFY_INFO
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
     
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewOrder($notify_info));


        return redirect()->route('buyer.order')->with('success','Order Added! Please wait for seller confirmation');

    }

      public function paymentImage(Request $request,$id)
      {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }
        
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
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

        $buyer_id = Auth::id();
        $buyer = User::find($buyer_id)->buyer->buyer_id;
        $status = $id;
        switch ($status) {
            // requesting
            case '1':
                $orders = DB::table('orders as a')
                ->join('payments as b', 'a.order_id', 'b.order_id')
                ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
                ->join('fees as d', 'b.fee_id', 'd.fee_id')
                ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
                ->whereNull('a.accepted_at')
                ->where('a.buyer_id',$buyer)
                ->orderBy('a.order_id','desc')
                ->get();
            //    dd($orders);
            break;

            // pending
            case '2':
                $orders = DB::table('orders as a')
                ->join('payments as b', 'a.order_id', 'b.order_id')
                ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
                ->join('fees as d', 'b.fee_id', 'd.fee_id')
                ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
                ->whereNotNull('a.accepted_at')
                ->whereNull('a.packed_at')
                ->where('a.buyer_id',$buyer)
                ->orderBy('a.order_id','desc')
                ->get();
            break;

            // delivery
            case '3':
                $orders = DB::table('orders as a')
                ->join('payments as b', 'a.order_id', 'b.order_id')
                ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
                ->join('fees as d', 'b.fee_id', 'd.fee_id')
                ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
                ->whereNotNull('a.packed_at')
                ->whereNull('a.delivered_at')
                ->where('a.buyer_id',$buyer)
                ->orderBy('a.order_id','desc')
                ->get();
            break;

            // recieved
            case '4':
                $orders = DB::table('orders as a')
                ->join('payments as b', 'a.order_id', 'b.order_id')
                ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
                ->join('fees as d', 'b.fee_id', 'd.fee_id')
                 ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
                 ->whereNotNull('a.delivered_at')
                 ->where('c.return_id', null)
                ->whereNull('a.completed_at')
                ->where('a.buyer_id',$buyer)
                ->orderBy('a.order_id','desc')
                ->get();

            break;

            case '5':
                $orders = DB::table('orders as a')
                ->join('payments as b', 'a.order_id', 'b.order_id')
                ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
                ->join('fees as d', 'b.fee_id', 'd.fee_id')
                ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
                 ->whereNotNull('a.completed_at')
                ->orderBy('a.order_id','desc')
                ->where('a.buyer_id',$buyer)
                ->get();
                break;

            case '6':
                $orders = DB::table('orders as a')
                ->join('payments as b', 'a.order_id', 'b.order_id')
                ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
                ->join('fees as d', 'b.fee_id', 'd.fee_id')
                ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
                ->orderBy('a.created_at','desc')
                ->where('c.return_id','<>', null)
                ->get();
                break;
            default:
                
                $orders = DB::table('orders as a')
                ->join('payments as b', 'a.order_id', 'b.order_id')
                ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
                ->join('fees as d', 'b.fee_id', 'd.fee_id')
                ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
                 ->orderBy('a.created_at','desc')
                 ->where('a.buyer_id',$buyer)
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
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }
        // return $id;
        $buyer_id = Auth::id();
        $buyer = User::find($buyer_id)->buyer->buyer_id;
       
        $order = DB::table('orders as a')
                ->leftJoin('payments as b','b.order_id','a.order_id')
                ->leftJoin('fees as c','c.fee_id','b.fee_id')
                ->leftJoin('sellers as d','d.seller_id','c.seller_id')
                ->leftJoin('riders as e','e.seller_id','d.seller_id')
                ->join('orgs as f','f.org_id','d.org_id')
                ->where('a.order_id',$id)
                ->where('a.buyer_id',$buyer)
                ->first();
     
        // dd($order);
        
         $orderLines = DB::table('orderlines as a')
                ->join('stocks as b','b.stock_id','a.stock_id')
                ->join('products as c','c.product_id','b.product_id')
                ->join('product_types as d','d.product_type_id','c.product_type_id')
                
                ->where('a.order_id',$id)
                ->get();  
        // return dd($orderLines);
        // return dd($orderLine);
       
        return view('buyer_subpages.myorders-viewmore',compact('order','orderLines'));
    }
    
    public function uploadImageInViewOrder(Request $request,$id)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

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

    public function orderMyOrderCancel(Request $request,$id)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

        $response = $request->input('response');
        if ($response == 'cancel'){
            return 123;
            $order = Order::find($id);
            $order->completed_at = now();
            $order->save();
            request()->session()->flash('success','Order cancelled');
        }

        $fee_id = Order::find($id)->payment->fee_id;
        $seller_id = Fee::find($fee_id)->seller_id;
        $user_id = Seller::find($seller_id)->user->user_id;

        // $buyer_id = Buyer::find($buyer)->user->user_id;
      
        // $notify_id = Seller::find($seller)->user->user_id;
   
        // ASSIGN VALUES
        $notify_user =  $user_id; // ID sa e-notify; NOT NULL
        $notify_info = $order; // Query gihimu; NOT NULL
        $notify_title = 'Order '; // Title or table; NOT NULL
        $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'Your order has been cancelled'; // Title description; NOT NULL            
        $notify_url = route('order.request.index') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
       
        // SAVE TO NOTIFY_INFO
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
     
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewOrder($notify_info));
   

        return redirect()->route('buyer.order');

    }

    public function orderMyOrderReceived(Request $request,$id)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }
        
        $response = $request->input('response');
        if ($response == 'received'){

            $order = Order::find($id);
            $order->completed_at = now();
            $order->save();
            
            $payment = Payment::find($id);
            $payment->paid_at = now();
            $payment->save();
            
            request()->session()->flash('success','Order complete');
        }



        $fee_id = Order::find($id)->payment->fee_id;
        $seller_id = Fee::find($fee_id)->seller_id;
        $user_id = Seller::find($seller_id)->user->user_id;

        // $buyer_id = Buyer::find($buyer)->user->user_id;
      
        // $notify_id = Seller::find($seller)->user->user_id;
   
        // ASSIGN VALUES
        $notify_user =  $user_id; // ID sa e-notify; NOT NULL
        $notify_info = $order; // Query gihimu; NOT NULL
        $notify_title = 'Order '; // Title or table; NOT NULL
        $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'Your order has been received'; // Title description; NOT NULL            
        $notify_url = route('order.request.index') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
       
        // SAVE TO NOTIFY_INFO
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
     
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewOrder($notify_info));

        return redirect()->route('buyer.ratings.index',[$id]);
    }


     public function buyerOrderReturnStore(Request $request,$id)
     {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

      
        $response = $request->input('response');
        $id = $request->input('order');
        $order = Order::find($id);

        if ($response == 'return' && $order){
            // CREATE RETURN ORDER
            $return = new ReturnOrder;
            $return->order_id = $id;
            $return->reason_id = $request->input('reason');
            $return->description = $request->input('description');
            $return->save();
     }
        return redirect()->route('buyer.order');
    }

    // Serller Order Side -----------------------------------------------------------------------

    public function orderRequest()
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }

        $id = Auth::id();
        $seller = User::find($id)->seller->seller_id;
        $title = 'order';

        // GET ORDER, PAYMENT, & RETURN ORDER
        // $orders = DB::table('orders as a')
        //     ->join('payments as b', 'a.order_id', 'b.order_id')
        //     ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
        //     ->join('fees as d', 'b.fee_id', 'd.fee_id')
        //     ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'd.seller_id')
        //     ->where('a.completed_at', null)
        //     ->where('c.return_id', null)
        //     ->where('d.seller_id', $seller)
        //     ->paginate(10);

        $orders = DB::table('orders as a')
        ->join('payments as b', 'a.order_id', 'b.order_id')
        ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
        ->join('fees as d', 'b.fee_id', 'd.fee_id')
        ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
         ->orderBy('a.created_at','desc')
         ->where('d.seller_id',$seller)
        ->get();
        // print_r($orders);die;
        return view('Seller_view.order-request',compact('orders','title'));
    }

    public function sellerOrderRequest(Request $request, $id)
    { 
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }
        
        // CHECK IF THERE'S A RESPONSE
        $response = $request->input('response');
        if ($response == 'accept'){
            $order = Order::find($id);
            $order->accepted_at = now();
            $order->save();

            $buyer = Order::find($id)->buyer_id;
            $buyer_id = Buyer::find($buyer)->user->user_id;
          
            // $notify_id = Seller::find($seller)->user->user_id;
       
            // ASSIGN VALUES
            $notify_user =  $buyer_id; // ID sa e-notify; NOT NULL
            $notify_info = $order; // Query gihimu; NOT NULL
            $notify_title = 'Order '; // Title or table; NOT NULL
            $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
            $notify_subtitle = 'Your order has been accepted'; // Title description; NOT NULL            
            $notify_url = route('buyer.order',[$id]) ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
            
           
            // SAVE TO NOTIFY_INFO
            $notify_info->title = $notify_title;
            $notify_info->table_id = $notify_table_id.': ';
            $notify_info->subtitle = $notify_subtitle;
         
            $notify_info->action_url = $notify_url;
            User::find($notify_user)->notify(new NewOrder($notify_info));
       

            request()->session()->flash('success','Order accepted');
        }
        elseif ($response == 'reject') {

            $order = Order::find($id);
            $order->completed_at = now();
            $order->save();


            $buyer = Order::find($id)->buyer_id;
            $buyer_id = Buyer::find($buyer)->user->user_id;
          
            // $notify_id = Seller::find($seller)->user->user_id;
       
            // ASSIGN VALUES
            $notify_user =  $buyer_id; // ID sa e-notify; NOT NULL
            $notify_info = $order; // Query gihimu; NOT NULL
            $notify_title = 'Order '; // Title or table; NOT NULL
            $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
            $notify_subtitle = 'Your order has been rejected'; // Title description; NOT NULL            
            $notify_url = route('buyer.order',[$id]) ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
            
           
            // SAVE TO NOTIFY_INFO
            $notify_info->title = $notify_title;
            $notify_info->table_id = $notify_table_id.': ';
            $notify_info->subtitle = $notify_subtitle;
         
            $notify_info->action_url = $notify_url;
            User::find($notify_user)->notify(new NewOrder($notify_info));
       
            request()->session()->flash('success','Order rejected');


          
        }
        else{
            request()->session()->flash('error','Error occurred while updating order');
        }
        return redirect()->route('order.request.index',[$id]);
    }

    public function orderPacked(Request $request,$id)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }
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

        // NOTIFICATIONS FOR RIDER

        $rider = Order::find($id)->rider_id;
        $rider_id = Rider::find($rider)->user->user_id;
      
        // $notify_id = Seller::find($seller)->user->user_id;
   
        // ASSIGN VALUES
        $notify_user =  $rider_id; // ID sa e-notify; NOT NULL
        $notify_info = $order; // Query gihimu; NOT NULL
        $notify_title = 'Order'; // Title or table; NOT NULL
        $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'New order added'; // Title description; NOT NULL            
        $notify_url = route('rider.order.index') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
       
        // SAVE TO NOTIFY_INFO
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
     
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewOrder($notify_info));


        // NOTIFICATION FOR BUYER
        $buyer = Order::find($id)->buyer_id;
        $buyer_id = Buyer::find($buyer)->user->user_id;
      
        // $notify_id = Seller::find($seller)->user->user_id;
   
        // ASSIGN VALUES
        $notify_user =  $buyer_id; // ID sa e-notify; NOT NULL
        $notify_info = $order; // Query gihimu; NOT NULL
        $notify_title = 'Order'; // Title or table; NOT NULL
        $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'Your order has been packed'; // Title description; NOT NULL            
        $notify_url = route('buyer.order',[$id]) ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
       
        // SAVE TO NOTIFY_INFO
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
     
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewOrder($notify_info));

        return redirect()->route('order.request.index',[$id]);
    }

    public function sellerViewmore($id)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }
        
        $seller_id = Auth::id();
        $seller = User::find($seller_id)->seller->seller_id;
        $title = 'order';

        // FIND ORDER
        $order = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->join('buyers as e','e.buyer_id','a.buyer_id')
            ->join('users as f','f.user_id','e.user_id')
            ->join('brgys as g','g.brgy_id','e.brgy_id')
            ->select('g.brgy_name','e.*','f.*','d.*','a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at')
            ->where('a.order_id', $id)
            ->where('d.seller_id',$seller)
            ->first();

            
            $orderLine = DB::table('orderlines as a')
            ->join('stocks as b','b.stock_id','a.stock_id')
            ->join('products as c','c.product_id','b.product_id')
            ->join('product_types as d','d.product_type_id','c.product_type_id')
            ->where('a.order_id',$id)
            // ->where('d.seller_id',$seller)
            ->get();

            return view('seller_view.seller-viewmore',compact('order','title','orderLine'));

    }

    public function buyerReturnRequest(Request $request, $id)
    {
        
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }
        $response = $request->input('response');
        $return = Order::find($id)->returnOrder;

        if ($response == 'accept' && $return){
            $return->accepted_at = now();
            $return->save();
            request()->session()->flash('success','Return order accepted');
        }
        elseif ($response == 'reject') {
            $return->denied_at = now();
            $return->save();
            
            $order =Order::find($id);
            $order->completed_at = now();
            $order->save();
            request()->session()->flash('success','Return order rejected');
        }
        
        return redirect()->back();
    }

    // Order ----- RIDER SIDE -------------------------------------------------------------------

}
