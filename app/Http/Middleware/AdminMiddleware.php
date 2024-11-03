<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->path() == 'admin/dashboard' && !$request->session()->has('user')) {
            return redirect('/login'); // Redirect if not logged in
        }

        // Optionally add logic for other routes, like the login route
        if ($request->path() == 'login' && $request->session()->has('user')) {
            return redirect('/'); // Redirect logged-in users away from the login page
        }

        return $next($request);
    }
}
