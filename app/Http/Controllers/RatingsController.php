<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
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

    public function buyerIndex()
    {

        return view('buyer_subpages.buyer-ratings');
    }

    public function buyerStore()
    {
        return 123;
    }
}
