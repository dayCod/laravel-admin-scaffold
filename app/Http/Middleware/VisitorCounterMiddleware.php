<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Actions\VisitorCounter;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class VisitorCounterMiddleware
{
    /**
     * Constructs a new VisitorCounterMiddleware instance with the given VisitorCounter dependency.
     *
     * @param VisitorCounter $visitorCounter The VisitorCounter instance to use for counting visitors.
     */
    public function __construct(
        protected VisitorCounter $visitorCounter,
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->visitorCounter->recordVisitor([
            'user_id' => $request->user()?->id,
            'session_id' => $request->session()->getId(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return $next($request);
    }
}
