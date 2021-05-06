<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedBack;
use Auth;
use App\User;
use App\Notifications\NewFeedBack;
class FeedBacksController extends Controller
{
    public function buyerFeedbackIndex()
    {

        return view ('buyer_pages.feedback');

    }

    public function buyerFeedbackStore(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

        $feedback = new FeedBack;

        $feedback->email = $request->input('email');
        $feedback->rating = $request->input('rating');
        $feedback->comment = $request->input('comment');
        $feedback->platform = 'Web';

        $feedback->save();

        $id =  User::find(8)->user_id;

        $notify_user = $id; // ID sa e-notify; NOT NULL
        $notify_info = $feedback; // Query gihimu; NOT NULL
        $notify_title = 'FeedBack'; // Title or table; NOT NULL
        $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'New feedback'; // Title description; NOT NULL            
        $notify_url = route('admin.feedbacks') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewFeedBack($notify_info));

        return redirect()->back()->with('success','Thank you for your comment Have a good Day!');

    }

    public function sellerFeedbackIndex()
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }

        return view ('Seller_view.seller-feedback');
        
    }
    public function sellerFeedbackStore(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }

        $feedback = new FeedBack;

        $feedback->email = $request->input('email');
        $feedback->rating = $request->input('rating');
        $feedback->comment = $request->input('comment');
        $feedback->platform = 'Web';

        $feedback->save();

        $id =  User::find(8)->user_id;

        $notify_user = $id; // ID sa e-notify; NOT NULL
        $notify_info = $feedback; // Query gihimu; NOT NULL
        $notify_title = 'FeedBack'; // Title or table; NOT NULL
        $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'New feedback'; // Title description; NOT NULL            
        $notify_url = route('admin.feedbacks') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewFeedBack($notify_info));

        return redirect()->back()->with('success','Thank you for your comment Have a good Day!');

    }
}
