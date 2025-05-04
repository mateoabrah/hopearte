<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyMiddleware
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
        // Verifica si el usuario está autenticado y es de tipo empresa o admin
        if ($request->user() && ($request->user()->role === 'company' || $request->user()->role === 'admin')) {
            return $next($request);
        }

        // Si no es empresa ni admin, redirigir al dashboard con mensaje de error
        return redirect()->route('dashboard')->with('error', 'No tienes permisos para acceder a esta sección.');
    }
}