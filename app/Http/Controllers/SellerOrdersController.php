<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerOrdersController extends Controller
{
    

    public function orderRequest()
    {


        return view('Seller_view.order-request');
    }
}
