<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Auth as Auth_role;

use Closure;

class authAdm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(Auth_role::user()->role=="1"){
                return $next($request);
        }else{
                return redirect(route('index_route'));
        }
    }
}
