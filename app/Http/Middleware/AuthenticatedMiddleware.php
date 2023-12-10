<?php

// app/Http/Middleware/AuthenticatedMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthenticatedMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if 'user' session exists
        if (!Session::has('user')) {
            return redirect()->route('login'); // Adjust the route name accordingly
        }

        return $next($request);
    }
}

