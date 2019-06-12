<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        //check if this user is admin or not

        if(Auth::check() && Auth::user()->isRole()=="admin"){
            return $next($request);
        }

        return redirect('login');
        //if not admin redirct to login
    }


}
