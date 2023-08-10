<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        if($request->user()->role !== $role){
            if($request->user()->role == "admin"){
                $url = 'admin/dashboard';
            }
            elseif($request->user()->role == "agent"){
                $url = 'agent/dashboard';
            }else{
                $url = '/dashboard';   
            }
            return redirect($url);
        }
        return $next($request);
    }
}
