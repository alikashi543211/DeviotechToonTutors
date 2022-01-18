<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Tutor
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
        if (auth()->user()->role == 'tutor') {
            if (auth()->user()->tutor_profile->status == "approved") {
                return $next($request);
            } else {
                return redirect()->route('tutor.pending.review');
            }

        }
        return redirect('/');
    }
}
