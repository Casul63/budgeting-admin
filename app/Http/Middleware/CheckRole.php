<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        dd('Hello');
        if (!auth()->check()) {
            return redirect('/login');
        }

        foreach ($roles as $role) {
            if (auth()->user()->roles == $role) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
