<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Admin\DonationInfo;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];







    public function to_donation_info()
    {
        return $this->hasMany(Admin\DonationInfo::class, 'donor_id');
    }



    public function to_donation_request()
    {
        return $this->hasMany(DonationReq::class, 'recipient_id');
    }


    public function relation_to_donor()
    {
        return $this->belongsTo(Admin\Blood::class, 'blood_id');
    }
    


    public function relation_to_division()
    {
        return $this->belongsTo(Admin\Division::class, 'division_id');
    }

    


    public function relation_to_city()
    {
        return $this->belongsTo(Admin\District::class, 'city_id');
    }

    

    public function relation_to_upazila()
    {
        return $this->belongsTo(Admin\Upazila::class, 'upazila_id');
    }



    public function relation_to_role()
    {
        return $this->belongsTo(Admin_Role::class, 'role_id');
    }




}
