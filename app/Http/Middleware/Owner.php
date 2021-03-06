<?php

namespace App\Http\Middleware;

use Closure;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string                   $resource
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $resource)
    {
        // Throw 404 error if authenticated user is not the owner of the resource
        if (intval($request->{$resource}->user_id) !== \Auth::id()) {
            abort(404);
        }

        return $next($request);
    }
}
