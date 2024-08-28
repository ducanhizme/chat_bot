<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckUserOrCustomerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , $type): Response
    {
        try {
            $authenticated = auth()->user();
            if($type=='user' && auth() && $authenticated instanceof \App\Models\User) {
                auth()->shouldUse('api');
            }else if ($type=='customer' && auth() && $authenticated instanceof \App\Models\Customer) {
                auth()->shouldUse('api-customer');
            }else{
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }catch (JWTException $exception){
            return response()->json(['error' => 'Invalid token'], 401);
        }
        return $next($request);
    }
}
