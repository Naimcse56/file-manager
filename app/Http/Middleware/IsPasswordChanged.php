<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Brian2694\Toastr\Facades\Toastr;

class IsPasswordChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $isPasswordReset = $user->password_changed_for_first_time == 1 ? 1 : null;
        
        $currentRoute = $request->route() ? $request->route()->getName() : null;
        
        $allowedRoutes = [
            'change_password',
            'update_change_password',
            'logout',
        ];
        
        if (in_array($currentRoute, $allowedRoutes)) {
            return $next($request);
        }
        
        if ($isPasswordReset == null) {
            Toastr::success("Please Change your Password First!");
            return redirect()->route('change_password');
        }
        return $next($request);
    }
}
