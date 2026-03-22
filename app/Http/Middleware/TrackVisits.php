<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Visit;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track successful GET requests to non-admin pages
        if ($request->isMethod('GET') && 
            !$request->is('admin*') && 
            !$request->is('api*') && 
            !$request->is('_debugbar*') &&
            !$request->ajax() &&
            $response->getStatusCode() === 200) {
            
            Visit::create([
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'path' => $request->path(),
                'referer' => $request->header('referer'),
                'method' => $request->method(),
            ]);
        }

        return $response;
    }
}
