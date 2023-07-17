<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\DonationInfo;
use App\Models\DonationReq;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DummyMail;

class frontEndController extends Controller
{



    public function index()
    {
        $donors = User::orderBY('donate_number','desc')->limit(3)->get();
        $datas = DonationReq::where('donation_status', 1)->orderBy('created_at', 'DESC')->limit(3)->get();
        return view('home',compact('datas','donors'));
    }








}
