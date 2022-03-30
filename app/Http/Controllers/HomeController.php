<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try{
            // Sort active an inactive users count
            $active = User::where('status',1)->count();
            $inactive = User::where('status',0)->count(); 
            $role = Role::all();

            // sort usercount as per departments/roles, store in an array 
            foreach( $role as $r){
                $userCount[] = User::where('role_id',$r->role_id)->count();
            }
            return view('home',compact('userCount','active','inactive','role'));
        }catch(\Exception $ex){
            return view('layouts.pagenotfound')->with('error', $ex->getMessage());
        }
        
    }

    public function logout(){
        Auth::logout();             // logout function
        return redirect('auth.login');
    }
}
