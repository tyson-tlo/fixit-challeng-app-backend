<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddressBelongsToUser
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
        if ($request->user()->isAdmin()) {
            return $next($request);
        }

        $address = $request->route('address');

        if ($address) {
            if ($address->user_id === $request->user()->id) {
                return $next($request);
            }
        }

        return response('Not Authorized.', 403);
    }
}
