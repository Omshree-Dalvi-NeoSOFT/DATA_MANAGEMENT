<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //$userRole = User::find(Auth::id());
        if(Auth::check()){
            if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2'){
                return $next($request);
            }
            else{
                return redirect('home')->with('status',"Un-Autherized !! Access denied");
            }
        }
        else{
            return redirect('/login')->with(Auth::logout());
        }
    }
}
