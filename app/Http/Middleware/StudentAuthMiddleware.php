<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
           // Check if the user is authenticated as a teacher
           if (Auth::guard('studentlogin')->check()) {
            return $next($request);
        }

        // If not authenticated, redirect to the frontend login page
        return redirect()->route('frontend.login');
    }
}
