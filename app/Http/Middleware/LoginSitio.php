<?php

namespace App\Http\Middleware;

use App\Services\Firebase\Autenticacion\AutenticadorHelper;
use Closure;

class LoginSitio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!AutenticadorHelper::estaLogueado()) {
            return back();
        }
        return $next($request);
    }
}
