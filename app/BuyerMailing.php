<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerMailing extends Model
{
    protected $table="buyer_mailing";

    protected $primaryKey = "buyer_mailing_id";
   
    protected $guarded =[];


    public function buyer()
    {
        return $this->belongsTo('App\Buyer');
    }

}
