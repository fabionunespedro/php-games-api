<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckGameYaer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('post') && $request->input('ano') <= 2000) {
            return response()->json([
                'message' => 'Não é permitido criar jogos com ano anterior a 2001.'
            ], 403);
        }
        
        return $next($request);
    }
}