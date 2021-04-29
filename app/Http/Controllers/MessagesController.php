<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\User;
use App\Seller;
use App\Inbox;
use App\Message;
use App\Notifications\NewMessage;

class MessagesController extends Controller
{
    public function __construct()
    {
    //    if(!Auth::check())
    //    {
    //        return redirect('/login');
    //    }
    }
    // public function buyerInboxIndex($id){

        


    //     // dd($buyer_message)
    //     return view('buyer_pages.inbox',compact('buyer_message'));
    // }

    public function sellerInboxIndex(){

        $id = Auth::id();



        return view('Seller_view.seller-inbox');
    }

    // public function buyerMessageFromSideBar()
    // {

    //     return 123;
        
    // }

    public function buyerMessage(Request $request,$id)
    {
        
        $user_type = 'buyer';
        $buyer_id = Auth::id();

        $buyer = User::find($buyer_id)->buyer->buyer_id;
       
        // return $buyer;

        $check_inbox = Inbox::where('buyer_id',$buyer)->where('seller_id',$id)->first();

       
        if($check_inbox)
        {
           
          return redirect()->route('buyer.chat',['id' => $check_inbox->inbox_id]);

        }else{

            $inbox = new Inbox;

            $inbox->buyer_id =  $buyer;
            $inbox->seller_id = $id;
            $inbox->save();

            return redirect()->route('buyerMessage.index');
        }
    }

    public function buyerMessageStore(Request $request,$id)
    {
        $message = new Message;
        $message->sender = 'buyer';
        $message->message = $request->input('input-message');
        $message->inbox_id = $id;
        $message->save();

        // FIND USER ID
        $seller = Inbox::find($id)->seller_id;
        $notify_id = Seller::find($seller)->user->user_id;

        // ASSIGN VALUES
        $notify_user = $notify_id; // ID sa e-notify; NOT NULL
        $notify_info = $message; // Query gihimu; NOT NULL
        $notify_title = 'Inbox '; // Title or table; NOT NULL
        $notify_table_id = $id; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'New message'; // Title description; NOT NULL            
        $notify_url = route('sellerMessage.index', [$id]) ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
        // SAVE TO NOTIFY_INFO
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewMessage($notify_info));

        return redirect()->back();

     }
     public function sellerMessageStore(Request $request,$id)
     {
 
         $message = new Message;
         $message->sender = 'seller';
         $message->message = $request->input('input-message');
         $message->inbox_id = $id;
         $message->save();
 
 
         return redirect()->back();
 
      }


     public function sellerMessageIndex($id)
     {
        // dd(Auth::user()->user_type);
        // $user_type = 'seller';

        $inbox = DB::table('inbox as a')
        ->join('buyers  as b','b.buyer_id','a.buyer_id')
        ->join('users  as c','c.user_id','b.user_id')
        ->where('a.inbox_id',$id)
        ->first(); 
    
         return view('buyer_pages.message',compact('inbox'));

     }

     public function buyerInboxMessage($id)
     {

        $inbox = DB::table('inbox as a')
        ->leftJoin('sellers as b','b.seller_id','a.seller_id') 
        ->leftJoin('users  as c','c.user_id','b.user_id')
        ->where('a.inbox_id', $id )
        ->first(); 
    
        return view('buyer_pages.message',compact('inbox'));


     }
       
    
}
