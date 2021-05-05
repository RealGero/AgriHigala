<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Buyer;
use App\User;
use App\Seller;
use App\Brgy;
use App\Org;
use App\ProductType;
use DB;
use Hash;
use Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    // public function __construct()
    // {
    // //    if(!Auth::check())
    // //    {
    // //        return redirect('/login');
    // //    }
    // }
    
    // update the address mobile number in checkout page
    public function updateProfileCheckout(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

        $id = Auth::id();
        $user = User::find($id); 
        $buyer = User::find($id)->buyer;

        $user->mobile_number = $request->input('mobile_number');
        $buyer->address = $request->input('address');
        $buyer->brgy_id = $request->input('brgy');

        $user->save();
        $buyer->save();
        return redirect()->back()->with('success','Successfully edited your profile');

    }
   
    public function index(){



    }

    public function store(Request $request){

        
    }

    private function getValidation(){

        
    }


    public function updateUserImage(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

        $id = Auth::id();
        $user = User::find($id);
        // $this->validate($request,[
        //     'mobile_number' => ['required', 'string', 'digits:11',Rule::unique('users')->ignore($id, 'user_id')],
        //     'address' => ['required','string']
        //  ]);

        
        
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

        return redirect()->route('buyer.profile.edit')->with('success','Successfully uploaded an image');

    }

    public function update(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }
        
   
        $id = Auth::id();
        $user = User::find($id);
    
         $this->validate($request,[
            'first_name' => ['required', 'string', 'min:2','regex:/^[\pL\s\-]+$/u'],
            'middle_name' => ['required', 'string', 'min:2' ,'regex:/^[\pL\s\-]+$/u'],
            'last_name' => ['required', 'string', 'min:2', 'regex:/^[\pL\s\-]+$/u'],
            'mobile_number' => ['required', 'string', 'digits:11',Rule::unique('users')->ignore($id, 'user_id')],

            'brgy' => ['required'],
            'address' => ['required'],
            // 'email' => "required|unique:users,email",
            'email' => ['required',Rule::unique('users')->ignore($id, 'user_id')],
            'birthdate' =>['required','date_format:Y-m-d','before:today'],
            'gender' =>['required'],
         ]);

      
        $buyer = User::find($id)->buyer;


        $user->f_name = $request->input('first_name');
        $user->m_name = $request->input('middle_name');
        $user->l_name = $request->input('last_name');
        $user->mobile_number = $request->input('mobile_number');
        $user->email = $request->input('email');


        $buyer->address = $request->input('address');
        $buyer->birthdate = $request->input('birthdate');
        $buyer->gender = $request->input('gender');
        $buyer->brgy_id =$request->input('brgy');

        $user->save();
        $buyer->save();
        // $brgys = Brgy::all();


        return redirect()->back()->with('success','Successfully edited');
    }

    public function edit()
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

        $id = Auth::id();
        $user = User::find($id);
        $brgys = Brgy::all();
      

        $buyer = User::find($id)->buyer;

        // return $user;
        // return $buyer;
        return view('buyer_subpages.create_profile',compact('user','brgys','buyer'));
    }
    

    // public function update(){

    //     return view('showprofile.edit-profile');
    // }

    public function userAccount()
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }
        
        $id = Auth::id();
        $user = User::find($id);
       
        return view('showprofile.user-account',compact('user'));
    }

    public function updateAccountUsername(Request $request)
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
        'username' => ['required', 'string', 'max:50','unique:users'],
        ]);
        
        $id = Auth::id();
        $user = User::find($id);
        
        $user->username = $request->input('username');
        $user->save();

        return redirect()->back()->with('username','Successfully Edited your username!');
    }

    public function updateAccountPassword(Request $request)
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

            'current_password'=> 'required',
            'new_password'=>'required|string|min:8',
            'password_confirmation' =>'required|min:8|same:new_password'
    
            ]);

        if(!(Hash::check($request->get('current_password'),Auth::user()->password)))
        {
            return redirect()->route('buyer.useraccount')->with('error','The current password does not match with your old password');
        }

        if(strcmp($request->get('current_password'),$request->get('new_password'))==0)
        {
            return redirect()->route('buyer.useraccount')->with('error','The current password cannot be the same with the new password');
        }



        $user = Auth::user();

        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect()->route('buyer.useraccount')->with('password','Password successfully changed');
    }

    public function updateValidId(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 4){
                return back();
            }
        }

         //    $buyer_id = Buyer::select('buyer_id')->where('user_id',Auth::id())->first();
         //    $seller = Buyer::find($buyer_id['id']);
         $id = Auth::id();
        $user = User::find($id);
      
       $buyer = User::find($id)->buyer;

       $this->validate($request,[
        'idfront' => 'max:1999',
        'idback' => 'max:1999',
        
    ]);
 
       if($request->hasFile('idfront'))
       {
           $filenameWithExt = $request->file('idfront')->getClientOriginalName();
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
           $extension = $request->file('idfront')->getClientOriginalExtension();
           $filenameToStore = $filename.'.'.time().'.'.$extension;
           $path = $request->file('idfront')->storeAs('public/buyer/valid-id-front',$filenameToStore); 

           $buyer->valid_id_front = $filenameToStore;
           
       };

       if($request->hasFile('idback'))
       {
           $filenameWithExt = $request->file('idback')->getClientOriginalName();
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
           $extension = $request->file('idback')->getClientOriginalExtension();
           $filenameToStore = $filename.'.'.time().'.'.$extension;
           $path = $request->file('idback')->storeAs('public/buyer/valid-id-back',$filenameToStore); 

            $buyer->valid_id_back = $filenameToStore;
           
       };
     
      $buyer->save();

    //   dd($buyer);
       return view('showprofile.user-account',compact('user','buyer'))->with('success','Successfully uploaded an image');
    }

   
    public function sellerProfile()
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }
        
    
        $id = Auth::id();
        $user =  User::find($id);
        $brgys = Brgy::all();
        $brgy =  User::find($id)->seller;

        // $brgy = User::find($id)->seller->org->brgy->brgy_name;
      
        

    

        // $brgys = Brgy::all();
        // $brgy_id = $brgys->find(1);

        // $orgs = Org::all();
        // $org_id = $orgs->find(2);
        


        // $user = new User;
        // $user->username = 'gero12345';
        // $user->user_type = '2';
        // $user->password = Hash::make('1234567890');
        // $user->f_name = 'asdasd';
        // $user->m_name = 'asdasdd';
        // $user->l_name = 'asdasds';
        // $user->mobile_number = '12345678900';
        // $user->email = 'gero12345@gmail.com';
       
       

        // $seller = new Seller;
        // $seller->schedule_online_time = 'everyday asdasd';
        // $seller->seller_description = 'asdasdasdasdasdasd';
        // $seller->org_id = '2';
        
       
        // $user->save();
        // $user->seller()->save($seller);

      

        return view ('Seller_view.seller-profile',compact('user','brgys'));
    }

    public function updateSellerDetails(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }
        $id = Auth::id();
        $user = User::find($id);
        $org = User::find($id)->seller->org;
        $brgy = User::find($id)->seller->org->brgy;
        $seller = User::find($id)->seller;

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
            'email' => ['required',Rule::unique('users')->ignore($id, 'user_id')],
            'mobile_number' => ['required', 'digits:11',Rule::unique('users')->ignore($id, 'user_id')],
            'address' => ['required'],
            'brgy' => ['required'],
            
            // 'email' => "required|unique:users,email",
          
            'schedule' => 'required|string',
            
         ]);

       
        $user->f_name = $request->input('first_name');
        $user->m_name = $request->input('middle_name');
        $user->l_name = $request->input('last_name');

        $user->email = $request->input('email');
        $user->mobile_number = $request->input('mobile_number');

        $org->address = $request->input('address');
        
        $brgy->brgy_name = $request->input('brgy');

        $seller->schedule_online_time = $request->input('schedule');
        $seller->seller_description = $request->input('description');

        $user->save();
        $org->save();
        $brgy->save();
        $seller->save();
       
        return redirect()->back()->with('details', 'Successfully edited your details');
    }

    public function updateSellerProfileImage(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }


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

       return redirect()->route('seller.profile')->with('image','Successfully uploaded an image');
    }
    public function sellerAccount()
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }

        $id = Auth::id();
        $seller = User::find($id);

        return view('Seller_view.seller-account',compact('seller'));
    }

    public function sellerAccountUpdate(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }

        $id = Auth::id();
        $user = User::find($id);

        $this->validate($request,[
           
            'current_password'=> '',
            'new_password'=>'string|min:8',
            'password_confirmation' =>'min:8|same:new_password'
    
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

        return redirect()->back()->with('success','Account updated successfully');

    }

    public function sellerUpdateUsername(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->user_type != 2){
                return back();
            }
        }
        
        $id = Auth::id();
        $user = User::find($id);
        $this->validate($request,[
        'username' => ['required',Rule::unique('users')->ignore($id, 'user_id')],
        ]);
        

        $user->username = $request->input('username');
        $user->save();

        return redirect()->back()->with('success','Account updated successfully');
    }


}
