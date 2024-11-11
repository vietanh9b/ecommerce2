<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class User
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
        if(empty(session('user'))){
            if (backpack_auth()->check()
                && !empty($request->getRequestUri()))
            {
                return $next($request);
            }
            return redirect()->route('login.form');
        }
        else{
            return $next($request);
        }
    }
}
