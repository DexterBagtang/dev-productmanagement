<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        //Admin role and Pm supervisor role exempted
      if ($request->user() && $request->user()->role != '1' && $request->user()->role != '3')
      {
        auth()->logout();
        return redirect('/login')->withErrors(['You tried to access a module without sufficient privileges.']);
      }
      return $next($request);
    }
}
