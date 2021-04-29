<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\ReturnOrder;
use App\Notifications\NewOrder;

class OrdersController extends Controller
{
    protected $check_auth;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // CHECK IF AUTHENTICATED & ADMIN
            if (Auth::check()){
                if (Auth::user()->user_type != 1){
                    return back();
                }
            }
            else{
                return redirect()->route('admin.login');
            }

            return $next($request);
        });
    }

    // INDEX
    public function index()
    {
        // SET TITLE
        $title = 'order';

        // GET ORDER, PAYMENT, & RETURN ORDER
        $orders = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
            ->where('a.completed_at', null)
            ->where('c.return_id', null)
            ->paginate(10);

        $notify_user = Auth::id; // ID sa e-notify; NOT NULL
        $notify_info = $orders; // Query gihimu; NOT NULL
        $notify_title = 'Order'; // Title or table; NOT NULL
        $notify_table_id = '1'; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'Order Received'; // Title description; NOT NULL            
        $notify_url = route('admin.users.index', [1]) ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewOrder($notify_info));
        
        return view('admin.orders.index',compact('orders', 'title'));
    }

    // CREATE
    public function create()
    {
        return back();
    }

    // STORE
    public function store(Request $request)
    {
        return back();
    }

    // SHOW
    public function show($id)
    {
        // SET TITLE
        $title = 'order';

        // FIND ORDER
        $order = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
            ->where('a.order_id', $id)
            ->first();

        if ($order){
            return view('admin.orders.show',compact('order','title'));
        }
        else{
            request()->session()->flash('error','Order not found');
            return redirect()->route('admin.orders.index');
        }
        
    }

    // EDIT
    public function edit($id)
    {
        return back();
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        return back();
    }

    // DESTROY
    public function destroy($id)
    {
        return back();
    }

    /* 
    ORDER REQUEST
    SELLER
     */
    public function sellerOrderRequest (Request $request, $id){
        
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
        // return back();
        return back();
    }

    /* 
    ORDER PENDING
    SELLER
    */
    public function sellerOrderPending (Request $request, $id){
        
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
        else{
            request()->session()->flash('error','Error occurred while updating order');
        }
        return back();
    }

    /* 
    ORDER PENDING
    BUYER
    */
    public function buyerOrderPending (Request $request, $id){
        
        // CHECK IF THERE'S A RESPONSE
        $response = $request->input('response');
        if ($response == 'cancel'){
            $order = Order::find($id);
            $order->completed_at = now();
            $order->save();
            request()->session()->flash('success','Order cancelled');
        }
        else{
            request()->session()->flash('error','Error occurred while updating order');
        }
        return back();
    }

    /* 
    ORDER DELIVERING
    RIDER
    */
    public function riderOrderDelivering (Request $request, $id){
        
        // CHECK IF THERE'S A RESPONSE
        $response = $request->input('response');
        if ($response == 'delivered'){
            $order = Order::find($id);
            $order->delivered_at = now();
            $order->save();
            
            $payment = Order::find($id)->payment;
            $payment->paid_at = now();
            $payment->save();
            request()->session()->flash('success','Order Delivered');
        }
        else{
            request()->session()->flash('error','Error occurred while updating order');
        }
        return back();
    }

    /* 
    ORDER DELIVERED
    BUYER
    */
    public function buyerOrderDelivered (Request $request, $id){
        
        $response = $request->input('response');
        $order = Order::find($id);

        if ($response == 'received' && $order){

            $order = Order::find($id);
            $order->completed_at = now();
            $order->save();
            
            request()->session()->flash('success','Order complete');
        }
        else{
            request()->session()->flash('error','Error occurred while updating order');
        }
        return back();
    }
}
