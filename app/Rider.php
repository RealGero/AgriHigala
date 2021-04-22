<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    protected $table = "riders";
    protected $primaryKey = "rider_id";
    protected $guarded = [];

    // protected $fillable=[
    //     'user_id','seller_id','first_name','middle_name','last_name','mobile_number','rider_image'
    // ];
   

    public function user()
    {
        return $this->belongsTo('App\User','user_id','user_id');
    }

    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }


}
