<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $table="buyers";

    protected $primaryKey = "buyer_id";
   
    protected $guarded =[];

    // protected $fillable=[
    //     'buyer_email', 'mobile_number','f_name','middle_name', 'last_name',
    //     'street', 'barangay',  'birth_date', 'gender',   'buyer_image',
    //     'valid_id',  'user_id'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function messeages()
    {
        return $this->hasMany('App\Message');
    }

    public function brgy()
    {
        return $this->belongsTo(Brgy::class);
    }

    public function buyerMailing()
    {
        return $this->hasOne('App\BuyerMaling');
    }

    public function inboxes()
    {
        return $this->hasMany('App\Inbox');
    }
}
