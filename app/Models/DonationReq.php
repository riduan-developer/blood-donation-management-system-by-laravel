<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationReq extends Model
{
    use HasFactory;


    protected $dates = ['blood_require_time'];

    public function relation_to_users()
    {
        return $this->belongsTo(User::class);
    }


    // relation with blood model
    public function relation_to_blood()
    {
        return $this->belongsTo(Admin\Blood::class, 'blood_id');
    }



    // relation with blood model
    public function relation_to_blood_element()
    {
        return $this->belongsTo(Admin\Blood_Element::class, 'element_type');
    }


    // relation with blood model
    public function relation_to_city()
    {
        return $this->belongsTo(Admin\District::class, 'city_id');
    }

    

    // relation with blood model
    public function relation_to_donation_info()
    {
        return $this->hasMany(Admin\DonationInfo::class, 'b_req_code', 'b_req_code');
    }



}
