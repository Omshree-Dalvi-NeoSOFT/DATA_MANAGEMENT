<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // function return all the roles present in database.
    public function showRole(){
        try{
            $role = Role::all();
            return view('role.role',compact('role'));
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    // function to add new role in record.
    public function postaddRole(Request $re){
        $validateData = $re->validate([
            'rolename' => ['required']
        ]);
        
        if($validateData){
            try{
                $role = new Role();                 // initiate new role variable
                $role->role_name = $re->rolename;
                $role->save();                      // save role
                return back()->with('success','Role Added Successfully !!');
            }catch(\Exception $ex){
                return view('layouts.pagenotfound')->with('error',$ex->getMessage());
            }
        }

    }

    // delete role from record.
    public function deleteRole(Request $req){
        try{
            Role::where('role_id',$req->aid)->delete();         // aid -> role id assigned..
            return back()->with('status',"Role deleted successfully");
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }
}
