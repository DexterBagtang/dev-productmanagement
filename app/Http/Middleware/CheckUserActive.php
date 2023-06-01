<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->user()->active == 'No') {
            auth()->logout();
            return redirect('/login')->withErrors(['You tried to access a module without sufficient privileges.']);
        }
        return $next($request);
    }
}
