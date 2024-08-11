<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $path = $request->path();
        if (strpos($path, 'admin') !== false) {
            $route = 'admin.login';
        } else {
            $route = 'login';
        }
        return $request->expectsJson() ? null : route($route);
    }
}
