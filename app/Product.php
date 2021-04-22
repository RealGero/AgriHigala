<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $table = "products";
    protected $primaryKey = "product_id";
    protected $guarded = [];
   
   
    protected $dates = ['deleted_at'];
    
    public function productType()
    {
        return $this->belongsTo('App\ProductType');

    }

    public function stocks()
    {
        return $this->hasMany('App\Stock','product_id','product_id');
        
    }

    public function srp()

    {
        return $this->hasMany('App\SRP');


    }

}
