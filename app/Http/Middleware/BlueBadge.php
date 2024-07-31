<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlueBadge
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->user()->auth_request && auth()->user()->auth_request->status == 'accepted') {
            return $next($request);
        } else {
            return $this->apiResponse('Only accounts with blue badge are allowed to do this action',null,false);
        }
    }
}
