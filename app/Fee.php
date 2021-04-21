<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{


    protected $table = "fees";
    protected $primaryKey = "fee_id";
    protected $guarded = [];


    public function payment()
    {
        return $this->hasOne('App\Payment','fee_id','fee_id');
    }
}
