<?php

namespace Abr4xas\SimpleBlog\Middleware\Is;

use Closure;
use Illuminate\Http\Request;

class Live
{
    /** Handle an incoming request. */
    public function handle(Request $request, Closure $next, string $model): mixed
    {
        if (! $request->{$model}->isPublished()) {
            return abort(404);
        }

        return $next($request);
    }
}
