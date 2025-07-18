<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogTokenUsage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            $tokenUse = new TokenUse();
            $tokenUse->method = $request->method();
            $tokenUse->URL = $request->fullUrl();
            $tokenUse->IP = $request->ip();
            $tokenUse->userAgent = $request->header('User-Agent');
            $tokenUse->tokenId = $request->user()->currentAccessToken()->id;
            $tokenUse->save();
        }

        return $next($request);
    }
}
