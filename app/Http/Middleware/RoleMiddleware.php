<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            abort(403, 'Harap Login Terlebih Dahulu');
        }

        if($roles){
            $userRole = Auth::user()->role;
            if (in_array($userRole, $roles)) {
                return $next($request);
            }else{
               abort(404);
            }
        }else{
            Auth::guard('web')->logout();
            abort(404);
        }

        abort(403, 'Harap Login Terlebih Dahulu');
    }
}
