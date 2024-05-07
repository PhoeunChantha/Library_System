<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
        if(Auth::check()){
            /**@var App\Models\User */
            $user = Auth::user();
            if($user->hasRole(['super-admin','admin','user','staff'])){
                return $next($request);
            }
            abort(403,"User does not have correct role");
        }
        abort(401);
    }
}
