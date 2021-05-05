<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\CustomerService;
use Auth;
use App\User;
use App\Notifications\NewCustomerService;
class CustomerServiceController extends Controller
{
    public function buyerCustomerServiceIndex()
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
     

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
    if (!Auth::check()){
        return redirect()->route('login');
    }
   
      
    //   dd($request->input('user'));
    $validated = $request->validate([
        'message' => ['required']
    ]);
    
    
        $customerService =  new CustomerService;
        $customerService->user_id = Auth::id();
        $customerService->message = $request->input('message');
        $customerService->sender = 'user';
        $customerService->save();
    

    if ($customerService){
        request()->session()->flash('success','Message Sent!');
    }else{
        request()->session()->flash('error','Reply not sent');
    }

    $admin_id = User::find(8)->user_id;
    // $notify_id = Seller::find($seller)->user->user_id;

    // ASSIGN VALUES
    $notify_user = $admin_id; // ID sa e-notify; NOT NULL
    $notify_info = $customerService; // Query gihimu; NOT NULL
    $notify_title = 'Customer Service '; // Title or table; NOT NULL
    $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
    $notify_subtitle = 'New customer service'; // Title description; NOT NULL            
    $notify_url = route('admin.customer-service') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
    
   
    // SAVE TO NOTIFY_INFO
    $notify_info->title = $notify_title;
    $notify_info->table_id = $notify_table_id.': ';
    $notify_info->subtitle = $notify_subtitle;
 
    $notify_info->action_url = $notify_url;
    User::find($notify_user)->notify(new NewCustomerService($notify_info));
    
    return redirect()->back();
  }


}
