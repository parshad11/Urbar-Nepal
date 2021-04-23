<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Front\HomeSetting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function RegisterUserPage(){
        $home_settings = HomeSetting::latest()->first();
        return view('ecommerce.register',compact('home_settings'));
    }

    public function store(Request $req)
    {
       
        $createdBy = User::select('id')->where('user_type','=','admin')->first()->id;
        $contact= Contact::where('email',$req->email)->first();
        $type='customer';
        if(!is_null($contact) && $contact->type=='supplier'){
            $type='both';
        }
        elseif(!is_null($contact) && $contact->type!='supplier'){
            return back()->with("User already exist");
        }
        // Unique contact id generation
        $contact_id = 'CO'.rand(1111,9999);
        $contact_id_fetch=contact::where('contact_id',$contact_id)->first();
        if(!is_null($contact_id_fetch)){
            return $contact_id;
        }
        $unique_contact_id=$contact_id;

            
        
        $req->validate(
            [
                'name'              =>      'required|string|max:20',
                'email'             =>      'required|email|unique:contacts,email',
                'phone'             =>      'required|numeric|min:10',
                'password'          =>      'required|string|min:8',
                'address'           =>      'required|string'
            ]
        );
        
        $dataArray      =       array(
            "name"              =>          $req->name,
            "email"             =>          $req->email,
            "mobile"            =>          $req->phone,
            "shipping_address"   =>          $req->address,
            "password"          =>          Hash::make($req['password']),
            "type"              =>          $type,
            "business_id"       =>          '1',
            "created_by"        =>          $createdBy,
            "contact_id"        =>          $unique_contact_id
        );
        $contact           =       Contact::updateOrCreate(
            ['email'=> $req->email],
            $dataArray
        );

        if(!is_null($contact)) {
            return view('ecommerce.login')->with("success", "Success! Registration completed");
        }

        else {
            return back()->with("failed", "Alert! Failed to register");
        }

    }
}
