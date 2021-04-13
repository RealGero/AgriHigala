<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Stock extends Model
{
    protected $table = "stocks";
    protected $primaryKey = "stock_id";
    protected $guarded = [];
    use SoftDeletes;
    protected $dates= ['deleted_at'];

    public function products()
    {
        return $this->belongsTo('App\Product','product_id','product_id');
    }

    public function orderLines ()
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

}
