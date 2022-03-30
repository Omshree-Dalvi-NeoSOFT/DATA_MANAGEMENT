<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function showRole(){
        try{
            $role = Role::all();
            return view('role.role',compact('role'));
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function addRole(){
        try{
            $role = Role::all();
            return view('role.addrole',compact('role'));
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function postaddRole(Request $re){
        $validateData = $re->validate([
            'rolename' => ['required']
        ]);
        
        if($validateData){
            try{
                $role = new Role();
                $role->role_name = $re->rolename;
                $role->save();
                return back()->with('success','Role Added Successfully !!');
            }catch(\Exception $ex){
                return view('layouts.pagenotfound')->with('error',$ex->getMessage());
            }
        }

    }

    public function deleteRole(Request $req){
        try{
            Role::where('role_id',$req->aid)->delete();
            return back()->with('status',"Role deleted successfully");
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }
}
