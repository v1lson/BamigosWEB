<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RolUser;

class CheckFlagB
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $auth = false;

        if (!auth()->guest()) {
            $userRol = auth()->user()->rol;
            $flags = RolUser::select('flags')->where('id', $userRol)->value('flags');

            if (strpos($flags, 'b') !== false) {
                $auth = true;
            }
        }

        if (!$auth) {
            abort(403, 'No tienes permiso para acceder a esta ruta.');
        }

        return $next($request);
    }
}
