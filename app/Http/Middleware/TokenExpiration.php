<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenExpiration
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->currentAccessToken() && $request->user()->currentAccessToken()->expires_at < now()) {
            $request->user()->tokens()->delete();
            
            return $this->responseMessageUnAuthorization('Token expired');
        }
        
        return $next($request);
    }
}
