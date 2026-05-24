<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Verified
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(! auth()?->check()) {
            return redirect('/login');
        }

        if(! auth()?->user()?->is_verified ) {
            return redirect()->route('verify');
        }

        return $next($request);
    }
}
