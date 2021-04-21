<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";
    protected $primaryKey = "payment_id";
    protected $guarded = [];
    protected $dates = [
        
        'created_at',
        'updated_at',
    ];

    public function order()
    {
        return $this->belongsTo('App\Order','order_id','order_id');
    }

    public function fee()
    {
        return $this->belongsTo('App\Fee');
    }


}
