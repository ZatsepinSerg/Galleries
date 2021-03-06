<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUser
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
        if (Auth::user()->role == 'user' && Auth::user()->status == 1) {
            return $next($request);
        }

        session()->flash('message', 'У вас нет прав для просмотра этого раздела !Пожалуйста войдите в свою учётную запись !');

        return redirect()->back();
    }
}
