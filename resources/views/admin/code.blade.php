public function name(Request $request)
{
    print_r($request->all());
    die();
    
    $request->validate([
            
        ]);

  
        $new_admin = new Admin;
        $new_admin->save();

        return redirect()->route('role_manage')->with('success', 'A new admin is added!');
}




{{-- delete code --}}

public function role_del($id)
{
    $role = Admin_Role::where('id',$id)->first();
    $role->delete();
    return redirect()->route('role_setting')->with('error', 'Role is deleted!');
}


{{-- RELATION SHIPS --}}


    

public function relation_to_users()
{
    return $this->belongsTo(User::class);
}



public function to_donation_info()
{
    return $this->hasMany(Admin\DonationInfo::class, 'donor_id');
}



public function to_donation_request()
{
    return $this->hasMany(DonationReq::class, 'recipient_id');
}


public function relation_to_users()
{
    return $this->belongsTo('App\Models\User', 'donor_id');
}


















<!-- Count of Job list Start -->
<div class="row">
    <div class="col-lg-12">
        <div class="count-job mb-35">
            <span>39, 782 Jobs found</span>
            <!-- Select job items start -->
            <div class="select-job-items">
                <span>Sort by</span>
                <select name="select">
                    <option value="">None</option>
                    <option value="">job list</option>
                    <option value="">job list</option>
                    <option value="">job list</option>
                </select>
            </div>
            <!--  Select job items End-->
        </div>
    </div>
</div>
<!-- Count of Job list End -->

