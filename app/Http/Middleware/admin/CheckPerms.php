<?php

namespace App\Http\Middleware\admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;

class CheckPerms
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {   
        $route = Route::getCurrentRoute()->getName();
        if(!Auth::check()) {
            return redirect('/login');
        }

        if (Roles::hasRoutes($route)) {
            return $next($request);
        }
        else {
            return redirect()->back()->with('error', "Vous n'avez pas la permission d'effectuer cette action");
        }
    }
}
