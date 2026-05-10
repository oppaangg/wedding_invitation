<?php

namespace App\Http\Middleware;

use Closure;

class AdminBasicAuth
{
    public function handle($request, Closure $next)
    {
        $user = $request->getUser();
        $pass = $request->getPassword();

        // Ganti sesuai keinginan
        if ($user !== 'noppeng' || $pass !== 'noval007@') {
            return response('Unauthorized', 401, [
                'WWW-Authenticate' => 'Basic realm="Admin Panel"'
            ]);
        }

        return $next($request);
    }
}