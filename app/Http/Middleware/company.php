<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class company
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is a company
        // dd(auth()->user()->role);
        if (auth()->user()->role === 2) {
            return $next($request);
        } else {
            return response()->json(['message' => 'Not a company'], 403);
        }
    }
}
