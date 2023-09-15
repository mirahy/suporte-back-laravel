<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
            // list allow hosts
            $allowed_domains = ['http://localhost:8088', 'http://127.0.0.1:4200'];

            // if source host is from another server get origin otherwise get host
            if($request->headers->has('origin'))
                $host = $request->headers->get('origin');
            if(!$request->headers->has('origin'))
                $host = $request->server->get('REQUEST_SCHEME').'://'.$request->server->get('HTTP_HOST');
            $server = in_array($host, $allowed_domains) ? $host : '';

            return $next($request)
            ->header('Access-Control-Allow-Origin', $server)
            ->header('Access-Control-Allow-Credentials', "true")
            ->header('Access-Control-Allow-Methods', "PUT, POST, DELETE, GET, OPTIONS, PATCH")
            ->header('Access-Control-Allow-Headers', "Accept, Authorization, Content-Type");
        
    }
}
