<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Rider;
use App\User;
use App\Buyer;
use App\Seller;
use Hash;
use DB;
class RidersController extends Controller
{
    public function __construct()
    {
    //    if(!Auth::check())
    //    {
    //        return redirect('/login');
    //    }
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
     public function index()
     {

        return view ('Seller_view.createrider');
     }
     public function store(Request $request)
     {
        
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
            'mobile_number' => 'required|digits:11',
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
        $user->mobile_number =  $request->input('mobile_number');
        $user->username = $request->input('first_name').$request->input('last_name');;
        $user->user_type = 3;
        $user->password = Hash::make($request->input('mobile_number'));

        $rider = new Rider();


        $rider->seller_id   =   $sellerId;
        
      
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
        return view('Rider_view.orders-summary');


    }

    public function orderDetails()
    {

        return view('Rider_view.transaction-history');
    }

    public function dashboard()
    {

        return view('Rider_view.rider-dashboard');
    }
}
