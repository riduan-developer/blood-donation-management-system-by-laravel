<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DonationReq;
use App\Models\Admin\DonationInfo;
use App\Models\Admin\Blood;
use App\Models\Admin\Blood_Element;
use App\Models\Admin\Division;
use App\Models\Admin\District;
use App\Models\Admin\Upazila;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BloodRequestMail;
use App\Mail\DonorRequestAcceptMail;
use App\Mail\DonationCompletedMail;


class BloodRequestController extends Controller
{
    public function index()
    {
        $bloods = Blood::all();
        $elements = Blood_Element::all();
        $divisions = Division::all();
        $cities = District::where('division_id', 6)->get();
        return view('front_end.feature.blood_req',compact('bloods','elements','cities'));
    }






    // blood require request function 

    public function request_post(Request $request)
    {


        $request->validate([
            // health information
            'gender' => 'required|string',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric|regex:/^(01)[0-9]{9}$/',

            // health information
            'sickness' => 'required|string|max:255',
            'p_age' =>  'required|numeric',
            'blood_group' => 'required|numeric',
            'blood_element' => 'numeric',
            'quantity' => 'required|numeric',
            'require_time' =>  'required|date|date_format:Y-m-d\TH:i||after:yesterday',

            'city' => 'required|numeric',
            'address' => 'required|string',
        ]);

        $new_req = new DonationReq;
        // creating a code number 
        $b_req_code =  substr($request->phone, -3)."-".date('h-i-s'); // h = hour; i = minute; s = second


        if(Auth::user()){
            $recipient_id = Auth::user()->id;
            $new_req->recipient_id = $recipient_id; 
        }
        
        $new_req->b_req_code = $b_req_code;
        $new_req->recipient_sickness = $request->sickness;
        $new_req->recipient_gender = $request->gender;
        $new_req->recipient_age = $request->p_age;
        $new_req->blood_id  = $request->blood_group;

        $new_req->element_type  = $request->blood_element;
        $new_req->quantity = $request->quantity;
        $new_req->blood_require_time  = Carbon::parse($request->required_time)->format('Y-m-d H:i:s');
        
        $new_req->recipient_email  = $request->email;
        $new_req->recipient_phone = $request->phone;
        $new_req->city_id   = $request->city;
                    
        $new_req->recipient_address = $request->address;
        $new_req->save();

        
        $mail = $new_req->recipient_email;

        $mail_data = ([
            'd_id' => $new_req->id,
            'd_code' => $new_req->b_req_code,
            'd_bg'=> $new_req->relation_to_blood->blood_group,
            'd_b_elmnt'=> $new_req->relation_to_blood_element->element_type,
            'd_qnt'=> $new_req->quantity,
            'd_rqdtm'=> $new_req->blood_require_time,
            'd_city'=> $new_req->relation_to_city->name,
            'd_adrs'=> $new_req->recipient_address,
            'd_cntct'=> $new_req->recipient_phone,
        ]);



        Mail::to($mail)->send(new BloodRequestMail($mail_data));
        return redirect()->route('home')->with('success', 'Your request is sent successfully!');


    }


    public function req_list(){
        $cities = District::all();
        $bloods = Blood::all();
        $datas = DonationReq::orderBy('created_at','desc')->paginate(15);;
        return view('front_end.feature.bld_req_view',compact('datas','cities','bloods'));
    }
    

    public function filter_bld_req(Request $request){


        $cities = District::all();
        $bloods = Blood::all();
        if($request->blood == NULL && $request->city == NULL ){

            return redirect()->route('data')->with('error', 'Select a option to filter.');

        }elseif($request->blood != NULL && $request->city != NULL ){

            $blood_id = $request->blood; 
            $city_id = $request->city; 

            $datas = DonationReq::where('blood_id',$blood_id)->where('city_id',$city_id)->orderBy('created_at','desc')->paginate(15);
            return view('front_end.feature.bld_req_view',compact('datas','bloods','cities'))->with('success', 'Showing results of filter by blood and location');

        }elseif($request->blood != NULL)
            {
                $blood_id = $request->blood; 
                $datas = DonationReq::where('blood_id','=',$blood_id)->orderBy('created_at','desc')->paginate(15);

                return view('front_end.feature.bld_req_view',compact('datas','bloods','cities'))->with('success', 'Showing results of filter by blood');
                

            }elseif($request->city != NULL){

                $city_id = $request->city; 
                $datas = DonationReq::where('city_id',$city_id)->orderBy('created_at','desc')->paginate(15);
                return view('front_end.feature.bld_req_view',compact('datas','bloods','cities'))->with('success', 'Showing results of filter by location');
            }

        else{
            return back('error','Something is wrong. Try Again');
        }




    }


    public function search_request(Request $request){

        $request->validate([
            'search_request' => 'required', 
        ]);
  
        $cities = District::all();
        $bloods = Blood::all();
        

        $search = $request->search_request;
        $datas = DonationReq::where('recipient_sickness','LIKE','%'.$search.'%')
                    ->orWhere('recipient_address','LIKE','%'.$search.'%')
                    ->paginate(15);

   

        return view('front_end.feature.bld_req_view',compact('datas','bloods','cities'))->with('success', 'Showing search result');
    }




    
    public function b_req_update_info(Request $request, $rq_id)
    {


        $donor_id = $request->donor_id;
        
        $donor = User::find($donor_id);
        $data = DonationReq::find($rq_id);


        if($donor)
        {
            $donor_found = DonationInfo::where('donor_id',$donor->id)->where('b_req_code', $data->b_req_code)->first();
           
            if($donor_found){

                return back()->with('error', 'You have already accepted this request! Click view details');

            }else{

                $new_don_info = new DonationInfo;
                $new_don_info->blood_request_id = $data->blood_id; 
                $new_don_info->b_req_code = $data->b_req_code;
                $new_don_info->donor_accepted = Carbon::now();
                $new_don_info->donor_id = $donor->id;
                $new_don_info->save();

                $mail_data = ([
                    'donor_name' => $donor->name,
                    'donor_blood' => $donor->relation_to_donor->blood_group,
                    'donor_address'=> $donor->address,
                    'donor_phone'=> $donor->phone,
                    'donor_acc_time'=> Carbon::parse($new_don_info->donor_accepted)->diffForHumans(),
                    'request_id' => $data->id,
                    'request_code'=> $data->b_req_code,
                    
                ]);

                // sending to recipient
                Mail::to($data->recipient_email)->send(new DonorRequestAcceptMail($mail_data));

                // sending to donor
                Mail::to($donor->email)->send(new DonorRequestAcceptMail($mail_data));

                return view('front_end.feature.donate_req_update',compact('data'))->with('success', 'Contact With our recipient as soon as possible');

            }


        }elseif(Auth()){
            return view('front_end.feature.donate_req_update',compact('data'));
        }else{

            return back()->with('error', 'Please check whether you are logged in or not!');

        }



    }


    public function donation_complete($req_id){

        $req = DonationReq::where('id',$req_id)->first();        
        $req->donation_status = 1;
        $req->save();

        $req_code  = $req->b_req_code;

        $dontn = DonationInfo::where('b_req_code',$req_code)->first();
        $dontn->donation_completed = Carbon::now();
        $dontn->save();


        $mail_data = ([
            'donor_name' => $dontn->relation_to_users->name,
            'donor_blood' => $dontn->relation_to_users->relation_to_donor->blood_group,
            'donor_address'=> $dontn->relation_to_users->address,
            'donor_phone'=> $dontn->relation_to_users->phone,
            'donor_cmpltd_time'=> Carbon::parse($dontn->donor_completed)->diffForHumans(),
            'request_id' => $req->id,
            'request_code'=> $req->b_req_code,
            
        ]);

        // sending to recipient
        Mail::to($req->recipient_email)->send(new DonationCompletedMail($mail_data));

        // sending to donor
        Mail::to($dontn->relation_to_users->email)->send(new DonationCompletedMail($mail_data));
        
        return redirect()->route('profile_view',Auth::id())->with('success', 'Donation Completed Successfully');

    }










}
