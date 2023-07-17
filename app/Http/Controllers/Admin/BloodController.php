<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Blood;
use App\Models\Admin\Blood_Element;

class BloodController extends Controller
{
    public function index(){

        $bloods = Blood::all();
        return view('admin.pages.blood.blood_list',compact('bloods'));

    }

    public function blood_group_submit(Request $request)
    {
        
        $request->validate([
            'blood_group' => ['required', 'regex:/^(A|a|B|b|AB|ab|O|o)[+-]$/'],
        ]);
        $new_blood = new Blood;
        $new_blood->blood_group = strtoupper($request->blood_group);

        $new_blood->save();

        return redirect()->route('blood_list')->with('success', 'A new blood group is added!');
    }

    
    public function blood_del($id)
    {
        $blood = Blood::where('id',$id)->first();
        $blood->delete();
        return redirect()->route('blood_list')->with('error', 'Blood is deleted!');
    }

    
    public function blood_element(){

        $elements = Blood_Element::all();
        return view('admin.pages.blood.blood_element',compact('elements'));

    }

    
    
    public function blood_element_submit(Request $request)
    {
        
        $request->validate([
            'blood_element' => 'required|string',
        ]);
        $new_element = new Blood_Element;
        $new_element->element_type = strtoupper($request->blood_element);

        $new_element->save();

        return redirect()->route('blood_element')->with('success', 'A new blood element is added!');
    }
    
    
    
    public function element_del($id)
    {
        $element = Blood_Element::where('id',$id)->first();
        $element->delete();
        return redirect()->route('blood_element')->with('error', 'Element is deleted!');
    }



}
