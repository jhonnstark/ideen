<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || ! $request->user()->isActive()) {
            return $request->expectsJson()
                ? abort(403, 'Your user is not active.')
                : Redirect::route('deactivated');
        }
        return $next($request);
    }
}
