<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;

class InboxController extends Controller
{
    
    public function sellerInboxIndex()
    {
        $id = Auth::id();
        $seller_id = User::find($id)->seller->seller_id;

        $buyers = DB::table('inbox as a')
            ->leftJoin('buyers as b','b.buyer_id','a.buyer_id')
            ->leftJoin('users as c','c.user_id','b.user_id')
            ->leftJoin('sellers as d','d.seller_id','a.seller_id')
            ->where('a.seller_id',$seller_id)
            ->select('c.username','c.user_image','b.buyer_id','c.f_name','c.m_name','c.l_name','a.inbox_id')
            ->get();
        // dd($buyers);
        

        return view('Seller_view.seller-inbox',compact('buyers'));

    }

    public function buyerInboxIndex()
    {
        $id = Auth::id();
        $buyer_id = User::find($id)->buyer->buyer_id;
        
        $sellers = DB::table('inbox as a')
            ->leftJoin('sellers as b','b.seller_id','a.seller_id')
            ->leftJoin('users as c','c.user_id','b.user_id')
            ->leftJoin('buyers as d','d.buyer_id','a.buyer_id')
            ->where('a.buyer_id',$buyer_id)
            ->select('c.username','c.user_image','b.seller_id','c.f_name','c.m_name','c.l_name','a.inbox_id')
            ->get();

        return view('buyer_pages.buyer-inbox',compact('sellers'));
    }


}
