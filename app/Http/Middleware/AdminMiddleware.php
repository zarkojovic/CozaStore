<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        // check if the session 'authUser' exists
        if (Session::exists('authUser')) {
            if (strtolower(Session::get('authUser')->role->role_name) == 'admin') {
                return $next($request);
            }
            return redirect('/');
        }
        // if it doesn't exists, redirect to the home page
        return redirect('/');
    }

}
