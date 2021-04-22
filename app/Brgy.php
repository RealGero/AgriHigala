<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brgy extends Model
{
    protected $table="brgys";

    protected $primaryKey = "brgy_id";
    protected $guarded =[];


    public function buyers()
    {
        return $this->hasMany(Buyer::class,'brgy_id','brgy_id');
    }

    public function orgs()
    {
        return $this->hasMany(Org::class,'brgy_id','brgy_id');
    }

    

    public function fees()
    {
        return $this->hasMany('App\Fee');
    }
}
