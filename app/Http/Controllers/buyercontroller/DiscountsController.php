<?php

namespace App\Http\Controllers\buyercontroller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class DiscountsController extends Controller
{
    public function __construct()
    {
    //    if(!Auth::check())
    //    {
    //        return redirect('/login');
    //    }
    }
    public function index()
    {
        return view('buyer_pages.discount');
    }
}
