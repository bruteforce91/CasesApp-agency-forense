<?php

namespace App\Http\Middleware;
use Cookie;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
          $cookie_name="key_private";
          $cookie_value=Auth::user()->private;
          //$cookie_value=$private_key;
          Cookie::queue(Cookie::forever($cookie_name,$cookie_value));
            return redirect('/home');
        }

        return $next($request);
    }
}
