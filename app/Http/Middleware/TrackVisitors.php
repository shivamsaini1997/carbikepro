<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;

class TrackVisitors
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();

        // Check if the visitor's IP is already logged today
        if (!Visitor::where('ip_address', $ip)
                ->whereDate('created_at', now()->toDateString())
                ->exists()) {
            Visitor::create(['ip_address' => $ip]);
        }

        return $next($request);
    }
}
