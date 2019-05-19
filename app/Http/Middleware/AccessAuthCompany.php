<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AccessAuthCompany
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
        if (!session()->get('accessAuth')) {
            return redirect('company/');
        }
        return $next($request);
    }
}

