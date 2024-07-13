<?php

namespace App\Http\Middleware;

use App\Foundation\Status;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureClientHasActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->subscriptions()->whereIn('stripe_status', [Status::active, Status::trialing])->count()) return redirect()->route('pricing');

        return $next($request);
    }
}
