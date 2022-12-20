<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkAdminLogin
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
            if (ucfirst(Auth()->user()->user_group_id)!=1){
                return redirect('account')->withSuccess('Opps! You do not have access1!');
            }
        }else{
            return redirect('account')->withSuccess('Opps! You do not have access1!');
        }
        return $next($request);
    }
}