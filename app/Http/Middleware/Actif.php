<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class Actif
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
			if ($request->user()->actif)
			{
				return $next($request);
			}
            return redirect('login')->with('status', 'Veuillez prendre contact avec un administrateur !'.
                                                     '\n Votre compte est inactif pour le moment.');
    }
}
