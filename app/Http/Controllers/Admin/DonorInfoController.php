<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\DonationInfo;
use App\Models\Admin\DonationReq;
use App\Models\User;

class DonorInfoController extends Controller
{
    

    public function index()
    {

        $users = User::all();
        return view('admin.pages.donor.donor_list',compact('users'));
    }


    
    public function donation_info()
    {

        $donations = DonationInfo::all();
        return view('admin.pages.donor.donation_list',compact('donations'));
    }


    public function donor_details_info($id)
    {
        $donations = DonationInfo::where('donor_id',$id)->get();
        $user = User::findorFail($id);
        return view('admin.pages.donor.donor_details_info',compact('user','donations'));
    }






}
