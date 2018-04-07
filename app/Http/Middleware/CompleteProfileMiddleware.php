<?php

namespace App\Http\Middleware;

use Closure;

class CompleteProfileMiddleware
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
        if(auth()->user()->profile()->first()){
            return $next($request);
        }

        return redirect()->route('profile.index');
    }
}
