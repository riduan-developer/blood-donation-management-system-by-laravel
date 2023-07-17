<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin_Role;
use Carbon\Carbon;







class Admin_Role_Controller extends Controller
{
    public function index()
    {
        $admin_roles = Admin_Role::orderBy('role_authority','asc')->get();
        return view('admin.pages.role.admin_role',compact('admin_roles'));
    }


    public function search_role(Request $request)
    {
                
        if($request->email != ''){

            $request->validate([
                'email' => 'email',
            ]);
            
            $user = User::where('email',$request->email)->first();
            if(!$user){
                return redirect()->route('role_manage')->with('error', 'User Not Found! Try Again');
            }     
            return redirect()->route('role_manage')->with('user',$user);
        }
        
        if($request->phone != ''){

            $request->validate([
                'phone' => 'numeric|regex:/^(01)[0-9]{9}$/'
            ]);

            $user = User::where('phone',$request->phone)->first();
            if(!$user){
                return redirect()->route('role_manage')->with('error', 'User Not Found! Try Again');
            }   
            return redirect()->route('role_manage')->with('user',$user);
        }
        
        return redirect()->route('role_manage');
    }    


    // role setting page

    public function role_setting()
    {
        $roles = Admin_Role::orderBy('role_authority','asc')->get();
        return view('admin.pages.role.role_setting',compact('roles'));

    }

    // add a role

    public function role_add(Request $request)
    {
        
       
        
        $request->validate([
            'role_title' => 'required|string|unique:admin__roles',
            'role_authority' => 'required|numeric'
        ]);


        $new_role = new Admin_Role;
        $new_role->role_title = $request->role_title;
        $new_role->role_authority = $request->role_authority;
        $new_role->save();
        return redirect()->route('role_setting')->with('success', 'A new role is added!');
        
    }


    public function role_del($id)
    {
        $role = Admin_Role::where('id',$id)->first();
        $role->delete();
        return redirect()->route('role_setting')->with('error', 'Role is deleted!');
    }

    

}
