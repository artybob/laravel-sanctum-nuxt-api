<?php

namespace App\Http\Middleware;

use App\Helpers\SocialServices;
use Closure;
use Illuminate\Http\Request;

class SocialMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $enabledServices = [];

        foreach (SocialServices::AVAILABLE_SERVICES as $service) {
            if (config('services.' . $service)) {
                $enabledServices[] = $service;
            }
        }

        if (!in_array(strtolower($request->service), $enabledServices)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'invalid social service'
                ], 403);
            }
            return redirect()->back();
        }
        return $next($request);
    }
}
