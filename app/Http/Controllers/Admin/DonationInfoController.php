<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\DonationInfo;


class DonationInfoController extends Controller
{


    public function index()
    {
        $donations = DonationInfo::orderBy('created_at');
        return view('admin.pages.donor.donation_info',compact('donations'));

    }


    public function donation_details_info($id)
    {
        $donation = DonationInfo::find($id);
        return view('admin.pages.donor.donation_details_info',compact('donation'));

    }






}

