<?php

// App\Http\Middleware\AuthSuperAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ensure correct import
use Symfony\Component\HttpFoundation\Response;

class AuthSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user()->type_role;
        // dd($user);
        if ( $user || $user != 0) {
            return redirect()->back()->with('error', 'You are not authorized to access this page.');
        }
        return $next($request);
    }
}
