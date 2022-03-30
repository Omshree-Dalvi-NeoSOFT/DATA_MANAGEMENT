<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    
    public function index(){
        try{
            $role = Role::all();
            return view('user.adduser')->with('roles',$role);
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function addUser(Request $req){
        $validateData = $req->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            'role_id' => ['required'],
            'status' => ['required']
        ]);

        if($validateData){
            try{
                User::create([
                    'firstname' => $req->firstname,
                    'lastname' => $req->lastname,
                    'email' => $req->email,
                    'password' => Hash::make($req->password),
                    'role_id' => $req->role_id,
                    'status' => $req->status
                ]);

                $data = ['fname' => $req->firstname,'lname' => $req->lastname,'email' => $req->email,'password' => $req->password];
                $user['to'] = $req->email;

                Mail::send('email.register',$data,function($message) use ($user){
                $message->to($user['to']);
                $message->subject('Registration Confirmed !');
                });
                return back()->with('success','User Registered Successfully !!');

            }catch(\Exception $ex){
                return view('layouts.pagenotfound')->with('error', $ex->getMessage());
            }
        }
        else{
            return back()->with('error','Fail to Register User');
        }
    }

    public function showUser(){
        try{
            $users = User::paginate(10)->where('role_id', '!=', '1')->except(Auth::id());
            $roles = Role::all();
            return view('user.showuser',compact('users','roles'));
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function editUser($id){
        try{
            $user = User::where('id',$id)->firstorFail();
            $userrole = Role::where('role_id',$user->role_id)->firstorFail();
            $roles = Role::all();
            return view('user.edituser',compact('user','userrole','roles'));
        }catch(\Exception $exception){
            return view('layouts.pagenotfound')->with('error', $exception->getMessage());
        }
        
        
    }
    
    // update user (edited)
    public function postEditUser(Request $req){
        $validateData = $req->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$req->id],
            'role_id' => ['required'],
            'status' => ['required']
        ]);
        if($validateData){
            try{
            User::where('id',$req->id)->update([
                'firstname' => $req->firstname,
                'lastname' => $req->lastname,
                'email' => $req->email,
                'password' => Hash::make($req->password),
                'role_id' => $req->role_id,
                'status' => $req->status
            ]);
            $r = Role::where('role_id',$req->role_id)->first();
            $role = $r->role_name;
            if($req->status == 0){
                $stat = "In-Active";
            }else{
                $stat = "Active";
            }
            $data = ['fname' => $req->firstname,'lname' => $req->lastname,'email' => $req->email,'password' => $req->password, 'role' =>$role , 'status' =>$stat];
                $user['to'] = $req->email;

                Mail::send('email.update',$data,function($message) use ($user){
                $message->to($user['to']);
                $message->subject('Details Updated !');
                });
            return back()->with('success','User Updated Successfully !!');
            }catch(\Exception $exception){
                return view('layouts.pagenotfound')->with('error', $exception->getMessage());
            }
        }
    }

    // delete user
    public function deleteUser(Request $req){
        try{
            User::where('id',$req->aid)->delete();
            return back()->with('status',"User moved to trash !!");
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function showUsertrash(){
        try{
            $users = User::onlyTrashed()->get();
            $roles = Role::all();
            return view('user.trashuser',compact('users','roles'));
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function restoreUser($id){
        try{
            $user = User::withTrashed()->find($id);
            if(!is_null($user)){
                $user->restore();
            }
            return back()->with('status',"User restored successfully");
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function removeUser(Request $req){
        try{
            $user = User::withTrashed()->find($req->aid);
            if(!is_null($user)){
                $user->forceDelete();
            }
            return back()->with('status',"User deleted successfully");
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }
}
