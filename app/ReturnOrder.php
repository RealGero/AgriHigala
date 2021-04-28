<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ReturnOrder extends Model
{
    protected $table = "return_orders";
    protected $primaryKey = "return_id";
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'order_id');
    }

    public function reason()
    {
        return $this->belongsTo('App\Reason');
    }

    public static  function getOrderLines($id) 
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
}
