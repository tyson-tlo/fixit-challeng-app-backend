<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientJobBelongsToUser
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
        // if ($request->user()->isAdmin()) {
        //     return $next($request);
        // }

        $job = $request->route('job');

        dd($job);

    }
}
