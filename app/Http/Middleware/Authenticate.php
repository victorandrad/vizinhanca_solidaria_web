<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     * @param Request $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

//    public function handle($request, Closure $next, $guards)
//    {
//        if (!$request->expectsJson()) {
//            return redirect()->route("{$guards}.login");
//        }
//        return $next($request);
//    }
}
