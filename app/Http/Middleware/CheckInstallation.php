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

        // Check if file exists
        if (file_exists($statusFile)) {

            // Read file
            $json = file_get_contents($statusFile);

            // Decode JSON
            $data = json_decode($json, true);

            // If installed = true → block installer
            if (isset($data['installed']) && $data['installed'] === true) {
                return redirect('/');   // Already installed
            }
        }

        // Otherwise continue
        return $next($request);
    }
}
