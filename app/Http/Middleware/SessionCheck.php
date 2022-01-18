<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Illuminate\Http\Request;

class SessionCheck
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
        if (Route::currentRouteName() != "student.payment.form" && Route::currentRouteName() != "student.payment.save") {
            session()->forget('request_tutor');
        }
        return $next($request);
    }
}
