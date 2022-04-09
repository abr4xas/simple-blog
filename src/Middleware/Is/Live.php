<?php

namespace Abr4xas\SimpleBlog\Middleware\Is;

use Closure;

class Live
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @psalm-suppress MissingParamType
     */
    public function handle($request, Closure $next, string $model)
    {
        if (! $request->{$model}->isPublished()) {
            return abort(404);
        }

        return $next($request);
    }
}
