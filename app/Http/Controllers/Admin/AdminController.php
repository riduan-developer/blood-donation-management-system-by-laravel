<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;

class AdminController extends Controller
{
    public function admin_add($admin_id, Request $request)
    {
        
        $request->validate([
            'role_id' => 'required|numeric',
        ]);

  
        $new_admin = new Admin;
        $new_admin->admin_id = $admin_id;
        $new_admin->role_id = $request->role_id;
        $new_admin->save();

        return redirect()->route('role_manage')->with('success', 'A new admin is added!');


    }
}
