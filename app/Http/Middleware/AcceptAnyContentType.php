<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcceptAnyContentType
{
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Accept', '*/*');

        if (!$request->headers->has('Content-Type') || $request->headers->get('Content-Type') === '') {
            $request->headers->set('Content-Type', 'application/x-www-form-urlencoded');
        }

        return $next($request);
    }
}
