<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheck
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
        // セッションの値を確認
        if (true == $request->session()->get("admin_auth")) {
            return redirect()->route('admin.home');
        }
        return $next($request);
    }
}
