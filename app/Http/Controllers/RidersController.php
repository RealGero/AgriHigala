<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Rider;
use App\User;
use App\Buyer;
use App\Seller;
use App\Order;
use Hash;
use DB;
use Illuminate\Validation\Rule;
class RidersController extends Controller
{
    public function __construct()
    {
    //    if(!Auth::check())
    //    {
    //        return redirect('/login');
    //    }
     }

     public function createRider()
     {
         return view('Seller_view.createrider');
     }
     public function viewSellerRider()
     {  
        $id = Auth::id();
        $seller_id = User::find($id)->seller->seller_id;
         $riders = DB::table('users as a')
            ->join('riders as b','b.user_id','a.user_id')
            ->where('b.seller_id', $seller_id)
            ->get();


        return view('Seller_view.view-rider',compact('riders'));
     }
     public function profileIndex()
     {

        $id = Auth::id();
        $rider_id = User::find($id)->rider->rider_id; 
        $rider = DB::table('users as a')
            ->join('riders as b','b.user_id','a.user_id')
            ->where('b.rider_id',$rider_id)
            ->first();

        $seller = DB::table('users as a')
            ->join('sellers as b','b.user_id','a.user_id')
            ->join('riders as c','c.seller_id','b.seller_id')
            ->join('orgs as d','d.org_id','b.org_id')
            ->where('c.rider_id',$rider_id)
            ->first();


        return view ('Rider_view.rider-profile',compact('seller','rider'));
     }

     public function imageUpdate(Request $request)
     {
        

        $id = Auth::id();
        $user = User::find($id);
        
        $this->validate($request,[
            'user_image' => 'max:1999',
        ]);

        if($request->hasFile('user_image'))
        {
            $filenameWithExt = $request->file('user_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('user_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'.'.time().'.'.$extension;
            $path = $request->file('user_image')->storeAs('public/user',$filenameToStore); 

             $user->user_image = $filenameToStore;
            
        };
      
       $user->save();

       return redirect()->back()->with('image','Successfully uploaded an image');
     }

     public function profileUpdate(Request $request)
     {
       
        $id = Auth::id();
        $user = User::find($id);
    
         $this->validate($request,[
            'first_name' => ['required','min:2',
            function ($attribute, $value, $fail) {
                if (preg_match('~[0-9]+~', $value)) {
                    $fail('The first name is invalid');
                }
                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)){
                    $fail('The first name is invalid');
                }
            }
        ],
        
        'middle_name' => ['required','min:2',
            
            function ($attribute, $value, $fail) {
                if (preg_match('~[0-9]+~', $value)) {
                    $fail('The first name is invalid');
                }
                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)){
                    $fail('The first name is invalid');
                }
            }
        ],
        'last_name' => ['required','min:2',
                
            function ($attribute, $value, $fail) {
                if (preg_match('~[0-9]+~', $value)) {
                    $fail('The last name is invalid');
                }
                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)){
                    $fail('The last name is invalid');
                }
            }
        ],

            'mobile_number' => ['required', 'string', 'digits:11',Rule::unique('users')->ignore($id, 'user_id')],
            'username' => ['required',Rule::unique('users')->ignore($id, 'user_id')],
        
            'email' => ['required',Rule::unique('users')->ignore($id, 'user_id')],  
         ]);
        
      
        $rider = User::find($id)->rider;


        $user->f_name = $request->input('first_name');
        $user->m_name = $request->input('middle_name');
        $user->l_name = $request->input('last_name');
        $user->mobile_number = $request->input('mobile_number');
        $user->email = $request->input('email');
        $user->username = $request->input('username');

        $rider->rider_description = $request->input('description');
  

        $user->save();
        $rider->save();

        return redirect()->back()->with('details','Successfully Edit your profile!');

     }

     public function passwordUpdate(Request $request)
     {

        $this->validate($request,[

            'current_password'=> 'required',
            'new_password'=>'required|string|min:8',
            'password_confirmation' =>'required|min:8|same:new_password'
    
            ]);

        if(!(Hash::check($request->get('current_password'),Auth::user()->password)))
        {
            return redirect()->back()->with('error','The current password does not match with your old password');
        }

        if(strcmp($request->get('current_password'),$request->get('new_password'))==0)
        {
            return redirect()->back()->with('error','The current password cannot be the same with the new password');
        }



        $user = Auth::user();

        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect()->back()->with('password','Password successfully changed');
     }

    public function updateRiderProfileImage()
    {

        $id = Auth::id();
        $user = User::find($id);

        
        $this->validate($request,[
            'user_image' => 'max:1999',
        ]);
        
        if($request->hasFile('user_image'))
        {
            $filenameWithExt = $request->file('user_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('user_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'.'.time().'.'.$extension;
            $path = $request->file('user_image')->storeAs('public/user',$filenameToStore); 

             $user->user_image = $filenameToStore;
            
        };
      
       $user->save();

       return redirect('/seller/profile')->with('image','Successfully uploaded an image');
    }

     public function store(Request $request)
     {
        
        $id = Auth::id();
        $data = $request->validate([

            'first_name' => ['required','min:2',
                function ($attribute, $value, $fail) {
                    if (preg_match('~[0-9]+~', $value)) {
                        $fail('The first name is invalid');
                    }
                    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)){
                        $fail('The first name is invalid');
                    }
                }
            ],
            'middle_name' => ['required','min:2',
            
            function ($attribute, $value, $fail) {
                if (preg_match('~[0-9]+~', $value)) {
                    $fail('The first name is invalid');
                }
                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)){
                    $fail('The first name is invalid');
                }
            }
        ],

        'last_name' => ['required','min:2',
            
        function ($attribute, $value, $fail) {
            if (preg_match('~[0-9]+~', $value)) {
                $fail('The last name is invalid');
            }
            if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)){
                $fail('The last name is invalid');
            }
        }
    ],
            'email' => ['required',Rule::unique('users')->ignore($id, 'user_id')],
            'mobile_number' => ['required', 'string', 'digits:11',Rule::unique('users')->ignore($id, 'user_id')],
            'rider_image'  => 'nullable|max:1999'
            
        ]);
        // $b = Seller::has('riders')->get();
        //  dd( $b);
        // $seller_id = auth()->user()->seller;
       
        // $seller_id = Seller::where('user_id',Auth::id())->first();
        // return $seller_id['id'];
        
        $id = Auth::id();

        $sellerId = User::find($id)->seller->seller_id;
       
        // return 123;
        $user = new User();
        $user->f_name = $request->input('first_name');
        $user->m_name = $request->input('middle_name');
        $user->l_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->mobile_number =  $request->input('mobile_number');
        $user->username = str_replace(' ','',$request->input('first_name').$request->input('last_name'));
        $user->user_type = 3;
        $user->password = Hash::make($request->input('mobile_number'));

        $rider = new Rider();


        $rider->seller_id   =  $sellerId;
        
      
        if($request->hasFile('rider_image'))
        {
            $filenameWithExt = $request->file('rider_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('rider_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'.'.time().'.'.$extension;
            $path = $request->file('rider_image')->storeAs('public/rider',$filenameToStore); 

            $rider->rider_image = $filenameToStore;
        };
        
        
        $user->save();
        $user->rider()->save($rider);

        // $user->riders()->create([
        //     'first_name' => $request->input('first_name'),
        //     'middle_name' => $request->input('middle_name'),
        //     'last_name' => $request->input('last_name'),
        //     'mobile_number' => $request->input('mobile_number'),
        //     'rider_image'=> 'hello.jpg',
        //     'seller_id ' => Auth::id(),
        // ]);
        
        

        // $user->rider()->save($rider);
        
        // $seller_id = Seller::select('id')->where('user_id',Auth::id())->first();
        // $seller = Seller::find($seller_id['id']);


    //    $seller->riders()->create([
    //        'first_name' => $request->input('first_name'),
    //        'middle_name' => $request->input('middle_name'),
    //        'last_name' => $request->input('last_name'),
    //        'mobile_number' => $request->input('mobile_number'),
    //        'rider_image'=> 'hello.jpg',
    //     //    $rider->seller_id = Auth::id();
    //    ]);
    
        
        
       
        // $seller->riders()->save($rider);
       
        
       
        // $rider->save();
        
        // $data = array();
        // $data['first_name']=$request->first_name;
        // $data['middle_name']=$request->middle_name;
        // $data['last_name']=$request->last_name;
        // $data['mobile_number']=$request->mobile_number;
        
        // $request['user_id'] =  $user_id;
        // $request['seller_id'] =  $seller_id;
        // $image = $request->file('rider_image');

        // if ($image)
        // {
        //     $image_name = date('dmy_H_s_i');
        //     $ext = strlower($image->getClientOriginalExtension());
        //     $image_full_name = $image_name.'.'.$ext;
        //     $upload_path = 'public/media/';
        //     $image_url = $upload_path.$image_full_name;
        //     $success = $image->move($upload_path,$image_full_name);

        //     $request['rider_image'] = $image_url;
        //     // $rider_image = DB::table('riders')->insert($request);

           
        //  }
        //  ('Seller_view.createrider')
        // Rider::create($request->all());
        return redirect()->back()->with('message','Successfully added a new buyer');
        
     }

    public function orders()
    {
        $id = Auth::id();
        $rider_id = User::find($id)->rider->rider_id;

        $orders = DB::table('orders as a')
        ->join('payments as b','b.order_id','a.order_id')
        ->join('fees as c','c.fee_id','b.fee_id')
        ->join('buyers as d','d.buyer_id','a.buyer_id')
        ->join('riders as e','e.rider_id','a.rider_id')
        ->join('users as f','f.user_id','d.user_id')
        ->join('brgys as g','g.brgy_id','d.brgy_id')
        ->select('c.*','d.address','a.*','b.*','g.brgy_name','f.*','e.*','f.f_name as buyer_fname','f.m_name as buyer_mname','f.l_name as buyer_lname')
        ->where('a.rider_id',$rider_id)
        ->get();
        
        // dd($orders);
        
        return view('Rider_view.rider-order',compact('orders'));


    }
    public function riderDeliveredAt(Request $request,$id)
    {
        $response = $request->input('response');
        if ($response == 'delivered'){
            $order = Order::find($id);
            $order->delivered_at = now();
            $order->save();
            request()->session()->flash('success','Order Delivered');
        }

        return redirect()->route('rider.order.index',[$id]);

    }

    public function orderDetails()
    {
        $id = Auth::id();
        $rider_id = User::find($id)->rider->rider_id;

        $orders = DB::table('orders as a')
        ->join('payments as b', 'a.order_id', 'b.order_id')
        ->leftJoin('return_orders as c', 'c.order_id', 'a.order_id')
        ->join('fees as d', 'b.fee_id', 'd.fee_id')
        ->select('a.*', 'b.*', 'a.accepted_at as order_accepted_at', 'a.created_at as order_created_at', 'b.created_at as payment_created_at', 'c.return_id', 'c.reason_id', 'c.description', 'c.accepted_at as return_accepted_at', 'c.denied_at as return_denied_at', 'c.created_at as return_created_at', 'c.description as reason_description', 'd.seller_id')
         ->orderBy('a.created_at','desc')
         ->where('a.rider_id',$rider_id)
         ->whereNotNull('a.completed_at')
        ->get();

      
        return view('Rider_view.rider-history',compact('orders'));
    }

    public function dashboard()
    {

        return view('Rider_view.rider-dashboard');
    }
}
