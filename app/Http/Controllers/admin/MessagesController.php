<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Inbox;

class MessagesController extends Controller
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
    
    // INDEX
    public function index(){
        $inboxes = DB::table('inbox as a')
            ->join('buyers as b', 'a.buyer_id', 'b.buyer_id')
            ->join('users as c', 'b.user_id', 'c.user_id')
            ->join('sellers as d', 'a.seller_id', 'd.seller_id')
            ->join('users as e', 'd.user_id', 'e.user_id')
            ->select('a.*', 'c.f_name as buyer_f_name', 'c.l_name as buyer_l_name', 'c.username as buyer_username', 'e.f_name as seller_f_name', 'e.l_name as seller_l_name', 'e.username as seller_username')
            ->paginate(10);
            // ->get();

        // return dd($inboxes);
        if ($inboxes){
            return view('admin.messages.index',compact('inboxes'));
        }
        return back();

    }

    // CREATE
    public function create(){
        return back();
    }

    // STORE
    public function store(Request $request){
        return back();
    }

    // SHOW
    public function show($id){

        $messages = DB::table('messages as a')
            ->join('inbox as b', 'a.inbox_id', 'b.inbox_id')
            ->select('a.*', 'b.*', 'a.created_at as message_created_at')
            ->where('a.inbox_id', $id)
            ->latest('message_created_at')
            ->get();

        $users = DB::table('inbox as a')
            ->join('buyers as b', 'a.buyer_id', 'b.buyer_id')
            ->join('users as c', 'b.user_id', 'c.user_id')
            ->join('sellers as d', 'a.seller_id', 'd.seller_id')
            ->join('users as e', 'd.user_id', 'e.user_id')
            ->select('a.*', 'c.f_name as buyer_f_name', 'c.l_name as buyer_l_name', 'c.username as buyer_username', 'e.f_name as seller_f_name', 'e.l_name as seller_l_name', 'e.username as seller_username')
            ->where('a.inbox_id', $id)
            ->first();
        
        if ($messages){
            return view('admin.messages.show',compact('messages', 'users'));
        }
        return back();
    }

    // EDIT
    public function edit($id){
        return back();
    }

    // UPDATE
    public function update(Request $request, $id){
        return back();
    }

    // DESTROY
    public function destroy($id){
        return back();
    }
}
