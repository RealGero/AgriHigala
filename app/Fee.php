<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use SoftDeletes;

    protected $table = "fee";
    protected $primaryKey = "fee_id";
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function payment()
    {
        return $this->hasOne('App\Payment','fee_id','fee_id');
    }
}
