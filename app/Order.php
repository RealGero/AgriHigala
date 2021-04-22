<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
