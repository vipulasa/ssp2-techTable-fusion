<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$role
    )
    {

        // loop through the role list and check if there is a match
        foreach ($role as $r) {
            if (auth()->user()->role->name == $r) {
                return $next($request);
            }
        }

        abort(403, 'WTF are you doing here?');
    }
}
