<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\FeedBack;
use App\CustomerService;
use App\User;
use App\Notifications\NewAnnouncement;

class SettingsController extends Controller
{
    protected $check_auth;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // CHECK IF AUTHENTICATED & ADMIN
            if (Auth::check()){
                if (Auth::user()->user_type != 1){
                    return back();
                }
            }
            else{
                return redirect()->route('admin.login');
            }

            return $next($request);
        });
    }

    // FEEDBACK
    public function feedbacks(){

        // GET RATINGS
        $feedbacks = FeedBack::paginate(10);

        return view('admin.settings.feedback',compact('feedbacks'));
    }

    // ANNOUNCEMENT
    public function announcements(){

        // SET TITLE
        $title = 'announcement';
        // GET ANNOUNCEMENTS
        $announcements = DB::table('customer_services as a')
            ->leftJoin('users as b', 'a.user_id', 'b.user_id')
            ->select('a.*','a.created_at as announcement_created_at', 'b.f_name', 'b.l_name', 'b.username')
            ->latest('announcement_created_at')
            ->where('a.user_id', null)
            ->where('a.deleted_at', null)
            ->paginate(10);
            // ->get();

        return view('admin.settings.announcements',compact('announcements', 'title'));
    }

    // CREATE ANNOUNCEMENT
    public function createAnnouncements(){

        return view('admin.settings.create-announcement');
    }

    // STORE ANNOUNCEMENT
    public function storeAnnouncements(Request $request){
        
        // VALIDATOR FOR ANNOUNCEMENT
        $validated = $request->validate([
            'announcement' => ['required']
        ]);

        $announcement =  new CustomerService;
        $announcement->message = $request->input('announcement');
        $announcement->sender = 'admin';
        $announcement->save();

        if ($announcement){
            // SET NOTIFY
            $notify_user = 17; // ID sa e-notify; NOT NULL
            $notify_info = $announcement; // Query gihimu; NOT NULL
            $notify_title = 'Announcement'; // Title or table; NOT NULL
            $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
            $notify_subtitle = 'New announcement'; // Title description; NOT NULL            
            $notify_url = false ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
            
            $notify_info->title = $notify_title;
            $notify_info->table_id = $notify_table_id.': ';
            $notify_info->subtitle = $notify_subtitle;
            $notify_info->action_url = $notify_url;
            User::find($notify_user)->notify(new NewAnnouncement($notify_info));

            request()->session()->flash('success','Announcement sent');
        }else{
            request()->session()->flash('error','Announcement not sent');
        }

        return redirect()->route('admin.announcements');
    }

    // DESTROY ANNOUNCEMENT
    public function destroyAnnouncements($id){

        $announcement = CustomerService::find($id);
        $announcement->delete();

        if ($announcement){
            request()->session()->flash('success','Announcement deleted');
        }
        else{
            request()->session()->flash('error','Announcement not deleted');
        }

        return redirect()->route('admin.announcements');
    }

    // CUSTOMER SERVICE
    public function customerService(){

        // SET TITLE
        $title = 'customer service';

        // // GET USERS
        // $users = DB::table('customer_services')
        //     ->select('user_id')
        //     ->distinct('user_id')
        //     ->where('user_id', '<>', null)
        //     ->paginate(10);

        // GET ANNOUNCEMENTS
        $announcements = DB::table('customer_services as a')
            ->leftJoin('users as b', 'a.user_id', 'b.user_id')
            ->select('a.*','a.created_at as announcement_created_at', 'b.f_name', 'b.l_name', 'b.username')
            ->where('a.user_id', '<>', null)
            ->where('a.deleted_at', null)
            ->latest('announcement_created_at')
            ->paginate(10);
        
        return view('admin.settings.announcements', compact('announcements', 'title'));
    }

    // REPLY CUSTOMER SERVICE
    public function replyCustomerService($id){
        
        // GET CUSTOMER MESSAGE
        $message = DB::table('customer_services as a')
            ->leftJoin('users as b', 'a.user_id', 'b.user_id')
            ->select('a.*','a.created_at as announcement_created_at', 'b.f_name', 'b.l_name', 'b.username')
            ->where('a.customer_service_id', $id)
            ->first();
            
        return view('admin.settings.create-cs', compact('message'));
    }

    // STORE CUSTOMER SERVICE
    public function storeCustomerService(Request $request){
        
        // VALIDATOR FOR CUSTOMER SERVICE
        $validated = $request->validate([
            'message' => ['required']
        ]);
        
        if ($request->input('user')){
            $message =  new CustomerService;
            $message->user_id = $request->input('user');
            $message->message = $request->input('message');
            $message->sender = 'admin';
            $message->save();
        }
        else{
            return back();
        }

        if ($message){
            request()->session()->flash('success','Replied successfully');
        }else{
            request()->session()->flash('error','Reply not sent');
        }
        return redirect()->route('admin.customer-service');
    }
}
