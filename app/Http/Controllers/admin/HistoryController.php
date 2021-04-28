<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\ReturnOrder;

class HistoryController extends Controller
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
        $title = 'complete, reject, cancel order';

        // GET ORDER, PAYMENT, & RETURN ORDER
        $orders = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
            ->where('a.completed_at', '<>' ,null)
            // ->get();
            ->paginate(10);

        return view('admin.orders.index',compact('orders', 'title'));
    }
    
    //CREATE
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
        $title = 'complete, reject, cancel order';

        // FIND RETURN ORDER
        $order = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->join('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
            ->where('a.order_id', $id)
            ->where('a.completed_at', '<>' ,null)
            ->first();

        if ($order){
            return view('admin.orders.show',compact('order','title'));
        }
        else{
            request()->session()->flash('error','Return order not found');
            return redirect()->route('admin.returns.index');
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
}
