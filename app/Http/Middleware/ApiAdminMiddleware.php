<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAdminMiddleware
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
        if(Auth::check()) {
            if(auth()->user()->tokenCan('server:admin')){
                return $next($request);
            }else{
                return response()->json([
                    'status' => 403,
                    'message' => 'Access denied.! as you are not an admin'
                ]);
            }
        }else {
            return response()->json([
                'status' => 401,
                'message' => 'You have to login'
            ]);
        }
        
    }
}
