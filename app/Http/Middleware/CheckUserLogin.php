<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->isVerify=='VED'){
                return $next($request);
            } elseif (auth()->user()->isVerify=='0') {  
                    auth()->user()->logout();
            
                    return false;
            }
        } else {
            return false;
        }
    }
}