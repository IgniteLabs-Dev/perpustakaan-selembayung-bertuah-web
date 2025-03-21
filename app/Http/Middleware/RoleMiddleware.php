<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRole = session('role');

        if (!$userRole) {
            return redirect()->route('login');
        }

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        $redirectRoutes = [
            // 'sdm' => route('pengajuan-perdin'),
            // 'pegawai' => route('perdinku'),
        ];

        return redirect($redirectRoutes[$userRole] ?? '/');
    }
}
