<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admin extends Model
{
    protected $table="admins";

    protected $primaryKey = "admin_id";
    protected $guarded =[];

    public function adminType()
    {
        return $this->belongsTo('App\AdminType');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
