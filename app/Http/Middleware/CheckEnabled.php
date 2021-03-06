<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class CheckEnabled
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
	    if ($request->user() && $request->user()->status != 'active') {
	        Auth::logout();
	        flash('Dieser User ist inaktiv und muss erst manuell freigeschaltet werden! Wenn du freigeschaltet werden möchtest, schreib mir bitte eine E-Mail an alex@hofstaetter.io mit einer Begründung sowie dem Nutzen, den diese Anwendung für dich schafft.')->error()->important();
	        return redirect()->route('login');
	    }

	    return $next($request);
	}
}
