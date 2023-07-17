<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationInfo extends Model
{
    use HasFactory;



    protected $dates = ['donor_accepted','donation_completed'];




    protected $fillable = [
        'blood_request_id',
        'donor_id',
        'b_req_code',
    ];


    public function relation_to_users()
    {
        return $this->belongsTo('App\Models\User', 'donor_id');
    }



    public function relation_to_donate_req()
    {
        return $this->belongsTo('App\Models\DonationReq', 'b_req_code', 'b_req_code');
    }



}
