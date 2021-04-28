<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
class ReturnsController extends Controller
{
    public function buyerOrderReturn()
    {
        $id = Auth::id();
     
        $buyer_id = User::find($id)->buyer->buyer_id;
      
        $orders = DB::table('orders as a')
        ->join('payments as b', 'a.order_id', 'b.order_id')
        ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
        ->join('fees as d', 'b.fee_id', 'd.fee_id')
        ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
         ->orderBy('a.created_at','desc')
         ->whereNotNull('c.return_id')
        ->where('a.buyer_id',$buyer_id)
        ->get();


        
        

        return view('buyer_subpages.myorders-return',compact('orders'));
    }

    public function sellerOrderReturn()
    {
        $id = Auth::id();
     
        $seller_id = User::find($id)->seller->seller_id;

        $orders = DB::table('orders as a')
        ->join('payments as b', 'a.order_id', 'b.order_id')
        ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
        ->join('fees as d', 'b.fee_id', 'd.fee_id')
        ->join('reasons as e','e.reason_id','c.reason_id')
        ->select('e.*','d.*','a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
         ->orderBy('a.created_at','desc')
         ->whereNotNull('c.return_id')
        ->where('d.seller_id',$seller_id)
        ->get();

        
        // $orderLine = DB::table('orderlines as a')
        // ->join('stocks as b','b.stock_id','a.stock_id')
        // ->join('products as c','c.product_id','b.product_id')
        // ->join('product_types as d','d.product_type_id','c.product_type_id')
        // ->join('prices as e','e.stock_id','b.stock_id')
        // ->join('units as f','f.unit_id','e.unit_id')
        // ->where('a.order_id',$id)
      
        // ->get();  

        return view('Seller_view.order-return',compact('orders'));
    }
    
    public function sellerOrderReturnRequest($id)
    {
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


}