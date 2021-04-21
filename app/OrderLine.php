<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class OrderLine extends Model
{
    protected $table = "orderlines";
    protected $primaryKey = "orderline_id";
    protected $guarded=[];
    public function  stock()
    {
        return $this->belongsTo('App\Stock');

    }
    public function  order()
    {
        return $this->belongsTo('App\Order','order_id','order_id');

    }

    public static function getOrderLines($id)
    {
        $orderLine = DB::table('orderlines as a')
                ->join('stocks as b','b.stock_id','a.stock_id')
                ->join('products as c','c.product_id','b.product_id')
                ->join('product_types as d','d.product_type_id','c.product_type_id')
                ->where('a.order_id',$id)
                ->get();

        $quantity = DB::table('orderlines')
                ->where('order_id',$id)
                ->sum('order_qty');


       

        if($orderLine)
        {
            $data = (object)[];

            $data->orderLine = $orderLine;
            $data->quantity = $quantity;
    
            return $data;
        }

            return 0;
    }

    

}
