<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{


    protected $table = "fees";
    protected $primaryKey = "fee_id";
    protected $guarded = [];


    public function payments()
    {
        return $this->hasMany('App\Payment','fee_id','fee_id');
    }

    public function brgy()
    {
        return $this->belongsTo('App\Brgy');

    }

    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }
}
