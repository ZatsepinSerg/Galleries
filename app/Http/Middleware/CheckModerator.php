<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckModerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 'moderator') {
            return $next($request);
        }
        
        session()->flash('message', 'У вас нет доступа к этому разделу!');

        return redirect()->back();
    }
}
    