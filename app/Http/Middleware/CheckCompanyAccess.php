<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->canManageCompanies()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Only admins and managers can access company management.'], 403);
            }
            
            return redirect('/')->with('error', 'Unauthorized. Only admins and managers can access company management.');
        }

        return $next($request);
    }
} 