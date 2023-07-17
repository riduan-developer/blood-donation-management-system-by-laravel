<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{
    use HasFactory;



    // relation with donation request model
    
    public function to_donation_req()
    {
        return $this->hasMany('App\Models\DonationReq', 'donor_id');
    }








}
