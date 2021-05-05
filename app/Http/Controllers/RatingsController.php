<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Rating;
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

        return view('Seller_view.seller-ratings');
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
