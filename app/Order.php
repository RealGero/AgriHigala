<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Order extends Model
{
    protected $table= "orders";
    protected $primaryKey = "order_id";
    protected $guarded = [];

    protected $dates = [

    'created_at',
    'updated_at',
    ];
    
    public function payment()
    {
        return $this->hasOne('App\Payment','order_id','order_id');
    }

    public function buyer()
    {
        return $this->belongsTo('App\Buyer');
    }

    public function orderLines()
    {
        return $this->hasMany('App\OrderLine','order_id','order_id');
    }

    

    public function returnOrder()
    {
        return $this->hasOne('App\ReturnOrder', 'order_id', 'order_id');
    }

    public function rider()
    {
        return $this->belongsTo('App\Rider');
    }

    public function rating()
    {
        return $this->hasOne('App\Rating');
    }


    public static function getBuyerWaddress($id)
    {
        $data = DB::table('users as a')
            ->join('buyers as b', 'a.user_id', '=', 'b.user_id')
            ->join('brgys as c', 'c.brgy_id', 'b.brgy_id')
            ->where('b.buyer_id', $id)
            ->first();

        if($data){
            return $data;
        }
        return 0;
    }

    public static function getRiders($id)
    {

        $data = DB::table('riders as a')
        ->join('users as b', 'a.user_id', 'b.user_id')
        ->select('a.rider_id','a.seller_id', 'b.username', 'b.f_name', 'b.l_name', 'b.username')
        ->where('a.seller_id', $id)
        ->where('b.deleted_at', null)
        ->orderBy('b.f_name')
        ->orderBy('b.l_name')
        ->get();

        if($data){
        return $data;
        }
        return false;
    }

    public static function countOrder($order){

        switch($order)
        {
            case 'active':
                $data=Order::whereNull('delivered_at')->count();
                if($data){
                    return $data;
                }

            case 'complete':
                $data=Order::whereNotNull('delivered_at')->count();
                if($data){
                    return $data;
                }
                
            default:
                return 0;
        }
    }

    public static  function viewMore($id) 
    {

        $orderLine = DB::table('orderlines as a')
                ->join('stocks as b','b.stock_id','a.stock_id')
                ->join('products as c','c.product_id','b.product_id')
                ->join('product_types as d','d.product_type_id','c.product_type_id')
                ->join('prices as e','e.stock_id','b.stock_id')
                ->join('units as f','f.unit_id','e.unit_id')
                ->where('a.order_id',$id)
                ->get();  
        
                // dd($orderLine);
        if($orderLine)
        {
            return $orderLine;

        }
        else{
            return 0; 
        }
    }
    public static function countSellerDashboard($id,$order=null)
    {

        $orders = DB::table('orders as a')
        ->join('payments as b', 'a.order_id', 'b.order_id')
        ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
        ->join('fees as d', 'b.fee_id', 'd.fee_id')
         ->where('d.seller_id',$id)
         ->count();


        if($order == 'OR' )
        {
            $orders = DB::table('orders as a')
                ->join('payments as b', 'a.order_id', 'b.order_id')
                ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
                ->join('fees as d', 'b.fee_id', 'd.fee_id')
                ->where('d.seller_id',$id)
                ->whereNull('a.accepted_at')
                ->count();
        }
        elseif( $order =='P')
        {
            $orders = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->where('d.seller_id',$id)
            ->whereNotNull('a.accepted_at')
            ->whereNull('a.packed_at')
            ->count();
        }
        elseif( $order =='D')
        {   
            $orders = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->where('d.seller_id',$id)
            ->whereNotNull('a.packed_at')
            ->whereNull('a.delivered_at')
            ->count();
        }
        elseif($order =='RR')
        {
            $orders = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->where('d.seller_id',$id)
            ->whereNotNull('c.created_at')
            ->whereNull('c.accepted_at')
            ->count();
            
        }
        elseif($order =='C')
        {
            $orders = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->where('d.seller_id',$id)
            ->whereNotNull('a.completed_at')
            ->count();

        }
        elseif($order =='RC')
        {
            $orders = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->where('d.seller_id',$id)
            ->whereNotNull('a.completed_at')
            ->whereNull('a.accepted_at')
            ->count();
        }
        elseif($order =='RE')
        {
            $orders = DB::table('orders as a')
            ->join('payments as b', 'a.order_id', 'b.order_id')
            ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
            ->join('fees as d', 'b.fee_id', 'd.fee_id')
            ->where('d.seller_id',$id)
            ->where('c.return_id','<>', null)
            ->count();
        }       
        
        return $orders;
    }

    public static function getOrderlines($id){
        $orderLines = DB::table('orderlines as a')
            ->join('stocks as b','b.stock_id','a.stock_id')
            ->join('products as c','c.product_id','b.product_id')
            ->join('product_types as d','d.product_type_id','c.product_type_id')
            ->join('prices as e','e.stock_id','b.stock_id')
            ->join('units as f','f.unit_id','e.unit_id')
            ->where('a.order_id',$id)
            ->get();
        return $orderLines;
    }

    public static function showOrder($id){
        $order = DB::table('orders as a')
            ->leftJoin('payments as b','b.order_id','a.order_id')
            ->leftJoin('fees as c','c.fee_id','b.fee_id')
            ->leftJoin('sellers as d','d.seller_id','c.seller_id')
            ->leftJoin('riders as e','e.seller_id','d.seller_id')
            ->join('orgs as f','f.org_id','d.org_id')
            ->where('a.order_id',$id)
            ->first();
        return $order;
    }
}
