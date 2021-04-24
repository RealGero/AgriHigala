<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedBack;
class FeedBacksController extends Controller
{
    public function buyerFeedbackIndex()
    {

        return view ('buyer_pages.feedback');

    }

    public function buyerFeedbackStore(Request $request)
    {

        $feedback = new FeedBack;

        $feedback->email = $request->input('email');
        $feedback->comment = $request->input('comment');
        $feedback->platform = 'Web';

        $feedback->save();

        return redirect()->back()->with('success','Thank you for your comment Have a good Day!');

    }

    public function sellerFeedbackIndex()
    {

        return view ('Seller_view.seller-feedback');
        
    }
    public function sellerFeedbackStore(Request $request)
    {

        $feedback = new FeedBack;

        $feedback->email = $request->input('email');
        $feedback->comment = $request->input('comment');
        $feedback->platform = 'Web';

        $feedback->save();

        return redirect()->back()->with('success','Thank you for your comment Have a good Day!');

    }
}
