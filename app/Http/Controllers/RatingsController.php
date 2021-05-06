<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Rating;
use DB;
use App\User;
class RatingsController extends Controller
{
    public function __construct()
    {
    //    if(!Auth::check())
    //    {
    //        return redirect('/login');
    //    }
    }
    public function sellerIndex()
    {
        $id = Auth::id();
        $seller_id = User::find($id)->seller->seller_id;
        $ratings = DB::table('ratings as a')
            ->join('orders as b','b.order_id','a.order_id')
            ->join('buyers as c','c.buyer_id','b.buyer_id')
            ->join('payments as d','d.order_id','b.order_id')
            ->join('fees as e','e.fee_id','d.fee_id')
            ->join('sellers as f','f.seller_id','e.seller_id')
            ->join('users as g','g.user_id','c.user_id')
            ->where('f.seller_id',$seller_id)
            ->get();
        
  
        return view('Seller_view.seller-ratings',compact('ratings'));
    }

    public function orderMyOrderRatings($id)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

        return view('buyer_subpages.buyer-ratings',compact('id'));
    }
    // public function buyerIndex()
    // {

    //     return view('buyer_subpages.buyer-ratings');
    // }

    public function buyerStore(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }
        
        $rating = new Rating;

        $rating->order_id = $request->input('order');
        $rating->rating = $request->input('rating');
        $rating->comment = $request->input('comment');

        $rating->save();

        return redirect()->route('buyer.order')->with('thanks','Thank you for the ratings!');

    }
}
