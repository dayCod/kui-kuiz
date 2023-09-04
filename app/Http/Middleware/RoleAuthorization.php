<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $roles = str_contains($roles, '|') ? explode('|', $roles) : array($roles);

        if (!in_array(Auth::user()->role, $roles)) {

            if (!$request->expectsJson()) abort(401);

            return response()->json([
                'response_code' => 401,
                'success' => false,
                'message' => 'Unauthorized User',
                'data' => [],
            ]);

        }

        return $next($request);
    }
}
