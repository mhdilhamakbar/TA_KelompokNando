<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class checkRole
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
        if(Auth::check()){
            $user = Auth::user();
            $req_url = explode('/',url()->current());
            if($user->role == "member"){
                if(in_array('user',$req_url)){
                    return $next($request);
                }
            }
            else if ($user->role == "fed"){
                if(in_array('fed',$req_url)){
                    return $next($request);
                }
            }
            else if ($user->role == "ssc"){
                if(in_array('ssc',$req_url)){
                    return $next($request);
                }
            }
            else if ($user->role == "sa"){
                if(in_array('sa',$req_url)){
                    return $next($request);
                }
            }
            return redirect()->back()->with('error','Do not have permission');
        }
        else {
            return redirect()->url('login');
        }
    }
}
