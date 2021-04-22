<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table="units";

    protected $primaryKey = "unit_id";
    protected $guarded =[];


   

    public function srps()
    {

        return $this->hasMany('App\Srp');
    }

    public function prices()
    {
        return $this->hasMany('App\Price');
    }
}
