<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Blood;
use App\Models\Admin\District;
class DonorController extends Controller
{
    

    
    public function donor_list_view()
    {
        $cities = District::all();
        $bloods = Blood::all();
        $donors = User::orderBy('avail_to_donate','desc')->paginate(15);
        return view('front_end.feature.donor_lists',compact('donors','bloods','cities'));
    }


    public function filter_donor(Request $request)
    {   
 
        $cities = District::all();
        $bloods = Blood::all();
        if($request->blood == NULL && $request->city == NULL ){

            return redirect()->route('donor_list_view')->with('error', 'Select a option to filter.');

        }elseif($request->blood != NULL && $request->city != NULL ){

            $blood_id = $request->blood; 
            $city_id = $request->city; 

            $donors = User::where('blood_id',$blood_id)->where('city_id',$city_id)->orderBy('avail_to_donate','desc')->paginate(10);
            return view('front_end.feature.donor_lists',compact('donors','bloods','cities'))->with('success', 'Showing results of filter by blood and location');

        }elseif($request->blood != NULL)
            {
                $blood_id = $request->blood; 
                $donors = User::where('blood_id','=',$blood_id)->orderBy('avail_to_donate','desc')->paginate(10);

                return view('front_end.feature.donor_lists',compact('donors','bloods','cities'))->with('success', 'Showing results of filter by blood');
                

            }elseif($request->city != NULL){

                $city_id = $request->city; 
                $donors = User::where('city_id',$city_id)->orderBy('avail_to_donate','desc')->paginate(10);
                return view('front_end.feature.donor_lists',compact('donors','bloods','cities'))->with('success', 'Showing results of filter by location');
            }

        else{
            return back('error','Something is wrong. Try Again');
        }

        

    }

    public function search_donor(Request $request){


        $request->validate([
            'donor_search' => 'required'
        ]);



        
        $cities = District::all();
        $bloods = Blood::all();
        

        $search = $request->donor_search;
        $donors = User::where('name','LIKE','%'.$search.'%')
                    ->orWhere('address','LIKE','%'.$search.'%')
                    ->paginate(5);

        return view('front_end.feature.donor_lists',compact('donors','bloods','cities'))->with('success', 'Showing search result');
    }
    





}
