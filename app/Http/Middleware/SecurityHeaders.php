<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Only apply strict headers in production
        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
            $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://code.jquery.com https://cdnjs.cloudflare.com https://cdn.ckeditor.com https://www.youtube.com https://www.youtube-nocookie.com https://www.gstatic.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.bunny.net https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://cdn.ckeditor.com; font-src 'self' https://fonts.gstatic.com https://fonts.bunny.net https://cdnjs.cloudflare.com; img-src 'self' data: https://* https://www.gstatic.com https://i.ytimg.com; connect-src 'self' ws: wss: https://www.youtube.com https://www.gstatic.com; frame-ancestors 'self'; frame-src 'self' https://www.youtube.com https://www.youtube-nocookie.com https://www.google.com https://www.google.com/maps https://maps.google.com; worker-src 'self' blob:;");
        } else {
            // Permissive CSP for development to avoid blocking Vite/Hot Reload
            $response->headers->set('Content-Security-Policy', "default-src * 'unsafe-inline' 'unsafe-eval' data: blob:; script-src * 'unsafe-inline' 'unsafe-eval' data: blob:; style-src * 'unsafe-inline' data: blob:; img-src * data: blob:; connect-src * ws: wss:; frame-ancestors 'self'; frame-src *; worker-src *;");
        }
        
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        return $response;
    }
}
