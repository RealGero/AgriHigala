<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\CustomerService;
use Auth;
class CustomerServiceController extends Controller
{
    public function buyerCustomerServiceIndex()
    {

        $messages = DB::table('customer_services as a')
        ->leftJoin('users as b', 'a.user_id', 'b.user_id')
        ->select('a.*','a.created_at as announcement_created_at', 'b.f_name', 'b.l_name', 'b.username')
        ->where('a.user_id', '<>', null)
        ->where('a.deleted_at', null)
        ->where('b.user_id',Auth::id())
        ->latest('announcement_created_at')
        ->paginate(10);
        // $inbox = DB::table('inbox as a')
        // ->join('buyers  as b','b.buyer_id','a.buyer_id')
        // ->join('users  as c','c.user_id','b.user_id')
        // ->where('a.inbox_id',$id)
        // ->first(); 

        return view('buyer_pages.customerservice',compact('messages'));
    }

   

  public function  buyerCustomerServiceStore(Request $request)
  {
      
    //   dd($request->input('user'));
    $validated = $request->validate([
        'message' => ['required']
    ]);
    
    
        $message =  new CustomerService;
        $message->user_id = Auth::id();
        $message->message = $request->input('message');
        $message->sender = 'user';
        $message->save();
    

    if ($message){
        request()->session()->flash('success','Message Sent!');
    }else{
        request()->session()->flash('error','Reply not sent');
    }
    
    return redirect()->back();
  }


}
