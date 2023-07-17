<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Admin\DonationInfo;
use App\Models\DonationReq;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        return view('admin.app.dashboard_admin',compact('users'));
    }

    public function profile_view($id)
    {
        
        $datas = DonationInfo::where('donor_id',$id)->orderBy('created_at','desc')->get();
        $reqs = DonationReq::where('recipient_id', $id)->orderBy('created_at','desc')->get();

        $current_donations = DonationInfo::where('donor_id',$id)->where('donation_completed', NULL)->orderBy('created_at','desc')->get();
        $current_reqs = DonationReq::where('recipient_id',$id)->where('donation_status', 0)->orderBy('created_at','desc')->get();

        $donor = User::findorfail($id);
        return view('front_end.auth.profile_view',compact('donor','datas','reqs','current_reqs','current_donations'));


    }

    public function profile_update($id)
    {
        $donor = User::findorfail($id);
        return view('front_end.auth.profile_update',compact('donor'));

    }


    public function profile_update_post(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric|regex:/^(01)[0-9]{9}$/',
            'gender' => 'required|string',
            'dob' =>  'required|date|before: 18 years ago',
            'address' => 'required|string',
            'city' => 'required|numeric',

            // health information
            'weight' => 'required|string',
            'height' => 'required|string',
            'blood_group' => 'required|numeric',
            'aids' => 'required|string',
            'malaria' => 'required|string',
            'diabetes' => 'required|string',
            'bp' => 'required|string',
        ]);

         // converting height from feet to meter

        // diving with 3.28 because 1feet = 3.28m
        $user_height = $request->height / 3.28;

        // restrict to only 2digit after point 
        $user_height = number_format((float)$user_height, 2, '.', '');

        // calculating the square of the value
        $height_squared = $user_height * $user_height;

        // calculating BMI value formula = weight/height^2
        $bmi_value = ($request->weight / $height_squared);
        // print_r($data);

        $user = User::find($id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->DOB =  $request->dob;
        $user->city_id = $request->city;
        $user->address = $request->address;

        // health information
        $user->weight = $request->weight;
        $user->height = $request->height;
        $user->blood_id = $request->blood_group;
        $user->AIDS = $request->aids;
        $user->malaria = $request->malaria;
        $user->diabetes = $request->diabetes;
        $user->BP = $request->bp;  
        $user->BMI = $bmi_value;
        $user->save();
        
        return redirect()->route('profile_update',$id)->with('success', 'Profile has been updated');











    }














}
