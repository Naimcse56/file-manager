<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle($request, Closure $next)
    {
        $statusFile = storage_path('app/public/installed_status.json');

        $isInstalled = false;

        if (file_exists($statusFile)) {
            $json = file_get_contents($statusFile);
            $data = json_decode($json, true);

            if (isset($data['installed']) && $data['installed'] === true) {
                $isInstalled = true;
            }
        }

        $isInstallRoute = $request->routeIs('install.*');
        if (!$isInstalled && !$isInstallRoute) {
            return redirect()->route('install.first_step');
        }

        if ($isInstalled && $isInstallRoute) {
            return redirect('/');
        }

        return $next($request);
    }
}
