<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class company
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
        //check if this user is company or not

        if(Auth::check() && Auth::user()->isRole()=="company"){
            return $next($request);
        }

        return redirect('login');
        //if not company redirct to login
    }
}
