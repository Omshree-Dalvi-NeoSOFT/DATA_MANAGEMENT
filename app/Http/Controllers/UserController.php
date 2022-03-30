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
    // return all the roles form record.
    public function index(){
        try{
            $role = Role::all();
            return view('user.adduser')->with('roles',$role);
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function addUser(Request $req){
        // add new user record
        // validate the form data received.
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
                // add user data to database.
                User::create([
                    'firstname' => $req->firstname,
                    'lastname' => $req->lastname,
                    'email' => $req->email,
                    'password' => Hash::make($req->password),
                    'role_id' => $req->role_id,
                    'status' => $req->status
                ]);

                // define veriable for data to display in mail.
                $data = ['fname' => $req->firstname,'lname' => $req->lastname,'email' => $req->email,'password' => $req->password];
                $user['to'] = $req->email;      // assign mail id to be send.

                // Mail function to send mail after successful registration .
                Mail::send('email.register',$data,function($message) use ($user){
                $message->to($user['to']);
                $message->subject('Registration Confirmed !');  // mail subject
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
            // display user data with pagination and user except superadmin and current user loggedin .. display user with latest entry first 

            $users = User::paginate(10)->where('role_id', '!=', '1')->except(Auth::id())->reverse();
            $roles = Role::all();
            return view('user.showuser',compact('users','roles'));
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function editUser($id){
        try{
            // get data of selected user with user id.
            $user = User::where('id',$id)->firstorFail();
            $userrole = Role::where('role_id',$user->role_id)->firstorFail();   // get selected user role
            $roles = Role::all();
            return view('user.edituser',compact('user','userrole','roles'));
        }catch(\Exception $exception){
            return view('layouts.pagenotfound')->with('error', $exception->getMessage());
        }
        
        
    }
    
    // update user (edited)
    public function postEditUser(Request $req){
        // validate user edited form data.
        $validateData = $req->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$req->id], // check unique email
            'role_id' => ['required'],
            'status' => ['required']
        ]);
        if($validateData){
            try{
                // update query to alter the changes..
            User::where('id',$req->id)->update([
                'firstname' => $req->firstname,
                'lastname' => $req->lastname,
                'email' => $req->email,
                'password' => Hash::make($req->password),   // hashing function for password encryption
                'role_id' => $req->role_id,
                'status' => $req->status
            ]);
            $r = Role::where('role_id',$req->role_id)->first(); // get user selected role
            $role = $r->role_name;  // get user role name
            if($req->status == 0){
                $stat = "In-Active";
            }else{
                $stat = "Active";
            }

            // data array to send data on email blade file.... mail after update.
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

    // delete user (Softdelete function)
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
            $users = User::onlyTrashed()->get();    // get data of users who are deleted (softdeleted)
            $roles = Role::all();
            return view('user.trashuser',compact('users','roles'));
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function restoreUser($id){
        try{
            $user = User::withTrashed()->find($id);     // find the user in trash with perticular user id
            if(!is_null($user)){
                $user->restore();           // function to restore deleted data
            }
            return back()->with('status',"User restored successfully");
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }

    public function removeUser(Request $req){
        try{
            $user = User::withTrashed()->find($req->aid);   // find the user in trash with perticular user id
            if(!is_null($user)){
                $user->forceDelete();               // function to permanently delete user data
            }
            return back()->with('status',"User deleted successfully");
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
    }
}
