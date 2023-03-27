<?php

namespace App\Http\Middleware;

use Closure;

class SalesMiddleware
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
      if ($request->user() && $request->user()->role != '8' && $request->user()->role != '1')
      {
        auth()->logout();
        return redirect('/login')->withErrors(['You tried to access a module without sufficient privileges.']);
      }
      return $next($request);
    }
}
