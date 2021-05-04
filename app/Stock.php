<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    use SoftDeletes;

    protected $table = "stocks";
    protected $primaryKey = "stock_id";
    protected $guarded = [];
    protected $dates= ['deleted_at'];

    public function products()
    {
        return $this->belongsTo('App\Product','product_id','product_id');
    }

    public function orderLines()
    {
        return $this->hasMany('App\Orderline');
    }

    public function prices()
    {
        return $this->hasMany('App\Price','stock_id','stock_id');
    }

    public function seller()
    {

        return $this->belongsTo('App\Seller','seller_id','seller_id' );
    }

    public static function countActiveStock(){
        $data=Stock::where('deleted_at', null)->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public static function getQty($id){
        // GET QUANTITIES
    $stock_qty = Stock::find($id)->qty_added;
    $order_qty = OrderLine::where('stock_id', $id)->sum('order_qty');
    $remaining_qty = $stock_qty - $order_qty;
    
    $data = (object)[];
    $data->stock = $stock_qty;
    $data->order = $order_qty;
    $data->remaining = $remaining_qty;
    return $data;

    }

    public static function countStockFromByCategory($id,$category)
    {
        $stock = DB::table('stocks as a')
            ->join('products as b','b.product_id','a.product_id')
            ->where('a.seller_id',$id)
            ->where('b.product_type_id',$category)
            ->count(); 

            return $stock;
    }

    
    // $stock_qty = Stock::find($id)->qty_added;
    // $order_qty = OrderLine::where('stock_id', $id)->sum('order_qty');
    // $remaining_qty = $stock_qty - $order_qty;
    
    // $data = (object)[];
    // $data->stock = $stock_qty;
    // $data->order = $order_qty;
    // $data->remaining = $remaining_qty;
    // return $data;

}
