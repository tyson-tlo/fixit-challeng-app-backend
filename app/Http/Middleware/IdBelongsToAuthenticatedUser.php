<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IdBelongsToAuthenticatedUser
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
        if (!$request->user()->isAdmin() && $request->user_id != $request->user()->id) {
            return response("Not Authorized.", 403);
        }

        return $next($request);
    }
}
