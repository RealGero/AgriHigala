<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rider extends Model
{
    protected $table = "riders";
    protected $primaryKey = "rider_id";
    protected $guarded = [];

    // protected $fillable=[
    //     'user_id','seller_id','first_name','middle_name','last_name','mobile_number','rider_image'
    // ];
   

    public function user()
    {
        return $this->belongsTo('App\User','user_id','user_id');
    }

    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public static function getRiderBySeller($id){
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


    // public static function orderLines($id)
    // {

    //     $riderOrderLines = DB::table('orderlines as a')
    //     ->join('stocks as b','b.stock_id','a.stock_id')
    //     ->join('products as c','c.product_id','b.product_id')
    //     ->join('product_types as d','d.product_type_id','c.product_type_id')
    //     ->join('prices as e','e.stock_id','b.stock_id')
    //     ->join('units as f','f.unit_id','e.unit_id')
    //     ->where('a.order_id',$id)
    //     ->get(); 
    // } 
        
    public static function orderLines($id)
    {
       
        $riderOrderLines = DB::table('orderlines as a')
        ->join('stocks as b','b.stock_id','a.stock_id')
        ->join('products as c','c.product_id','b.product_id')
        ->join('product_types as d','d.product_type_id','c.product_type_id')
        ->join('prices as e','e.stock_id','b.stock_id')
        ->join('units as f','f.unit_id','e.unit_id')
        ->where('a.order_id',$id)
        ->get();  
        
       
        if($riderOrderLines)
        {
           
            return $riderOrderLines;

        }else{
            return 0;
        }
    }

}
