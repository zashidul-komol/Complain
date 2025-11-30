<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
//use Illuminate\Support\Facades\Vite;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Vite::useCspNonce();
        
        $response = $next($request);
        return $response->header('X-Content-Type-Options', 'nosniff')
                 ->header('X-Frame-Options', 'SAMEORIGIN')
                 ->header('X-XSS-Protection', '1; mode=block')
                 ->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload')
                 ->header('Referrer-Policy', 'no-referrer-when-downgrade');
    }
}
