<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        if (Auth::user()->role == 'admin' && Auth::user()->status == 1) {
            return $next($request);
        }

        session()->flash('messages', 'У вас нет прав для доступа к этому разделу !');

        return redirect()->back();
    }
}
