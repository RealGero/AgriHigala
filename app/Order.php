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
        return $this->hasOne('App\ReturnOrder');
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
}
