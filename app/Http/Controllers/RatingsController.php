<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Rating;
use DB;
use App\User;
use App\Order;
use App\Fee;
use App\Seller;
use App\Notifications\NewRating;
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

        
         $countRatings = DB::table('ratings as a')
            ->join('orders as b','b.order_id','a.order_id')
            ->join('buyers as c','c.buyer_id','b.buyer_id')
            ->join('payments as d','d.order_id','b.order_id')
            ->join('fees as e','e.fee_id','d.fee_id')
            ->join('sellers as f','f.seller_id','e.seller_id')
            ->join('users as g','g.user_id','c.user_id')
            ->where('f.seller_id',$seller_id)
            ->count(); 
        
        $ratingsSum = DB::table('ratings as a')
        ->join('orders as b','b.order_id','a.order_id')
        ->join('payments as d','d.order_id','b.order_id')
        ->join('fees as e','e.fee_id','d.fee_id')
        ->join('sellers as f','f.seller_id','e.seller_id')
        ->where('f.seller_id',$seller_id)
        ->sum('rating');

        if($countRatings){
            $average =   ($ratingsSum / $countRatings) ;
        }else{
            $average = 0;
        }

      
        
      
        // return $average;

        return view('Seller_view.seller-ratings',compact('ratings','average'));
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
        
        $this->validate($request,[
            'comment' => 'required',
            
            
        ]);
        $rating = new Rating;

        $rating->order_id = $request->input('order');
        $rating->rating = $request->input('rating');
        $rating->comment = $request->input('comment');

        $rating->save();

        $id = $rating->order_id;

        $fee_id = Order::find($id)->payment->fee_id;
        $seller_id = Fee::find($fee_id)->seller_id;
        $user_id = Seller::find($seller_id)->user->user_id;

        
        // $buyer_id = Buyer::find($buyer)->user->user_id;
      
        // $notify_id = Seller::find($seller)->user->user_id;
   
        // ASSIGN VALUES
        $notify_user =  $user_id; // ID sa e-notify; NOT NULL
        $notify_info = $rating; // Query gihimu; NOT NULL
        $notify_title = 'Rating '; // Title or table; NOT NULL
        $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'You have a new rating'; // Title description; NOT NULL            
        $notify_url = route('seller.ratings.index') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
       
        // SAVE TO NOTIFY_INFO
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
     
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewRating($notify_info));

        return redirect()->route('buyer.order')->with('thanks','Thank you for the ratings!');

    }
}
