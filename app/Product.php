<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    public static function getProductByProductType($id){
        $data = Product::where('product_type_id', $id)->get();

        if ($data){
            return $data;
        }
        return false;
    }

}
