<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;


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
    protected $redirectTo = RouteServiceProvider::HOME;



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
            // personal information
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'numeric', 'regex:/^(01)[0-9]{9}$/'],
            'gender' => ['required', 'string'],
            'dob' =>  ['required', 'date', 'before: 18 years ago'],
            'address' => ['required', 'string'],
            'city' => ['required', 'numeric'],

            // health information
            'weight' => ['required', 'string'],
            'height' => ['required', 'string'],
            'blood_group' => ['required', 'numeric'],
            'diabetes' => ['required', 'string'],
            'bp' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        // converting height from feet to meter

        // diving with 3.28 because 1feet = 3.28m
        $user_height = $data['height'] / 3.28;

        // restrict to only 2digit after point 
        $user_height = number_format((float)$user_height, 2, '.', '');

        // calculating the square of the value
        $height_squared = $user_height * $user_height;

        // calculating BMI value formula = weight/height^2
        $bmi_value = ($data['weight'] / $height_squared);
        // print_r($data);

        
        // $ext = $data['user_photo']->getClientOriginalExtension();
        // $final_name = $data['email'].".".$ext;
        // $data['user_photo']->move(public_path('uploads/frontEnd/images/users/user_dp/'),$final_name);
       
        $now = Carbon::now()->format('Y-m-d H:m:s');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'DOB' =>  $data['dob'],
            'city_id' => $data['city'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => $now,

            // health information
            'weight' => $data['weight'],
            'height' => $data['height'],
            'blood_id' => $data['blood_group'],
            'diabetes' => $data['diabetes'],
            'BP' => $data['bp'],  
            'BMI' => $bmi_value, 
        ]);

        $email = $user['email'];
        $mail_data = ([
            'name' => $user['name'],
        ]);
        Mail::to($email)->send(new RegistrationMail($mail_data));
        return $user;

        


    }
}
