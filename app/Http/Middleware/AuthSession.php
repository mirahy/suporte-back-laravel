<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthSession
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
        // Verifica se o usuario não esta logado e existe token gerado.  
        if ((!Auth::user() && $request->user()->tokens)){
            // limpa a sessão do usuario
            $request->session()->flush();
            // retrona messagem de sessão expirada
            return  response(['msg' => 'Sua sessão expirou!'], 401);
        }
        return $next($request);
    }

}
