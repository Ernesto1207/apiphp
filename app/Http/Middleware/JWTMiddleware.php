<?php

namespace App\Http\Middleware;

use Closure;
use Doctrine\Common\Lexer\Token;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'invalid token'], 400);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'expired token'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'token not found'], 401);
        }
        
        return $next($request);
    }
}
