<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Inbox extends Model
{
    protected $table = "inbox";
    protected $primaryKey = "inbox_id";
    protected $guarded = [];
    
    public function buyers()
    {
        return $this->belongsTo('App\Buyer');
    }

    public function sellers()
    {
        return $this->belongsTo('App\Seller');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }


    public static function sellerInbox($id)
        {
            $buyer_message = DB::table('messages as a')
            ->join('inbox as b','b.inbox_id','a.inbox_id')
            ->where('b.inbox_id',$id)
            ->latest('a.created_at')
            ->get();
            // dd($buyer_message);
             return $buyer_message;
        }

    public static function getCreatedAt($id)

        {
            $buyer_message = DB::table('messages as a')
            ->join('inbox as b','b.inbox_id','a.inbox_id')
            ->where('b.inbox_id',$id)
            ->select('a.created_at')
            ->latest('a.created_at')
            ->first();    

            return $buyer_message->created_at;
        }
       
}
