<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Buyer;
use App\Notifications\NewBuyer;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/buyer/browse';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [

        //     'username' => ['required', 'string', 'max:50','unique:users'],
        //     // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],

        //     'first_name' => ['required', 'string', 'min:2' , 'regex:/^[a-zA-Z]+$/u'],
        //     'middle_name' => ['required', 'string', 'min:2' , 'regex:/^[a-zA-Z]+$/u'],
        //     'last_name' => ['required', 'string', 'min:2', 'regex:/^[a-zA-Z]+$/u'],
        //     'mobile_number' => ['required', 'string', 'digits:11'],

            
            // 'brgy' => ['required'],
            // 'address' => ['required'],
            // 'email' =>['required','email','unique:buyers'],
            // 'birthdate' =>['required','date_format:Y-m-d','before:today'],
            // 'gender' =>['required'],

        // ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    // protected function create()
    // {
    //     $brgys = Brgy::all();

    //     return view('auth.register',compact('brgys'));

    // }    

    protected function register(Request $request)
    {
         
        $this->validate($request,[

            'username' => ['required', 'string', 'max:50','unique:users'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

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
            'mobile_number' => ['required', 'string', 'digits:11','unique:users'],

            'brgy' => ['required'],
            'address' => ['required'],
            'email' => 'required|unique:users|string',
            'birthdate' =>['required','date_format:Y-m-d','before:today'],
            'gender' =>['required'],
            
        ]);
       
            
        // event(new Registered($user = $this->create($request->all())));
        $user = new User;
         
        $user->user_type = '4';
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->f_name = $request->input('first_name');
        $user->m_name = $request->input('middle_name');
        $user->l_name = $request->input('last_name');
        $user->mobile_number = $request->input('mobile_number');
        $user->email = $request->input('email');
        

        $buyer = new Buyer;
        $buyer->address = $request->input('address');
        $buyer->birthdate = $request->input('birthdate');
        $buyer->gender = $request->input('gender');
        $buyer->brgy_id =$request->input('brgy');

        

        $user->save();
        $user->buyer()->save($buyer);
      
        // $id = $buyer->buyer_id;
        $user_id = User::find(8)->user_id;

        // $buyer_id = Buyer::find($buyer)->user->user_id;
      
        // $notify_id = Seller::find($seller)->user->user_id;
   
        // ASSIGN VALUES
        $notify_user =  $user_id; // ID sa e-notify; NOT NULL
        $notify_info = $buyer; // Query gihimu; NOT NULL
        $notify_title = 'Buyer '; // Title or table; NOT NULL
        $notify_table_id = ''; // ID sa table nga involved; NULLABLE, pwede ra leave blank
        $notify_subtitle = 'A new buyer has been registered'; // Title description; NOT NULL            
        $notify_url = route('admin.users.index') ; //route('admin.users.index') Asa na route ma access ang notifications; NULLABLE, butang false if blank
        
       
        // SAVE TO NOTIFY_INFO
        $notify_info->title = $notify_title;
        $notify_info->table_id = $notify_table_id.': ';
        $notify_info->subtitle = $notify_subtitle;
     
        $notify_info->action_url = $notify_url;
        User::find($notify_user)->notify(new NewBuyer($notify_info));

       return redirect()->route('login')->with('success','Congratulation you already registered! Please Login');
    //     return 123;
    //     $user = new User;
         
    //     $user->user_type = '4';
    //     $user->username = $request->input('username');
    //     $user->password = $request->input('password');
    //     $user->f_name = $request->input('first_name');
    //     $user->m_name = $request->input('middle_name');
    //     $user->l_name = $request->input('last_name');
    //     $user->mobile_number = $request->input('mobile_number');

        
    //     $buyer = new Buyer;
    //     $buyer->address = $request->input('address');
    //     $buyer->buyer_email = $request->input('email');
    //     $buyer->birthdate = $request->input('birthdate');
    //     $buyer->gender = $request->input('gender');
    //     $buyer->brgy_id =$request->input('brgy');

        
    //     $user->save();
    //     $user->buyer()->save($buyer);

    // }
    // protected function create(array $data )
    // {

    //         return User::create([
    //         'username' => $data['username'],
    //         'user_type' => '4',
    //         'password' => Hash::make($data['password']),
    //         'f_name' => $data['first_name'],
    //         'm_name' => $data['middle_name'],
    //         'l_name' => $data['last_name'],
    //         'mobile_number' => $data['mobile_number'],

            
    //         ]);
           
        
    // }
    }
}
