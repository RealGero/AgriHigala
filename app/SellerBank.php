<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerBank extends Model
{
    protected $table = "seller_banks";
    protected $primaryKey = "seller_account_id";

    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }
}
