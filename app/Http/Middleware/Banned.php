<?php

namespace App\Http\Middleware;

use Closure;

class Banned
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
        if(isset(auth()->user()->role) && auth()->user()->role == "blocked") return response("Your account is banned");
        
        return $next($request);
    }
}
