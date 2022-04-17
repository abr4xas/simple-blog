<?php

namespace Abr4xas\SimpleBlog\Middleware\Is;

use Closure;
use Illuminate\Http\Request;

class Live
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param string $model
     * @return mixed
     */
    public function handle($request, Closure $next, string $model): mixed
    {
        if (! $request->{$model}->isPublished()) {
            return abort(404);
        }

        return $next($request);
    }
}
