<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    //ログインしようとした時すでにログイン済みだった時の遷移先設定
     public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //リダイレクト先をindexへ
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
