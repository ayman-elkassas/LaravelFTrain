<?php

namespace App\Http\Middleware;

use Closure;

class News
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
    	//return dd(auth()->check());
	    
    	//if user not auth redirect to login
    	if(!auth()->user())
	    {
	    	return redirect('manual/login');
	    }
        return $next($request);
    }
}
