<?php
namespace Abr4xas\SimpleBlog\Middleware\Is;

use Abr4xas\SimpleBlog\Models\Article;
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
    public function handle($request, Closure $next, Article $model)
    {
        if ($request->{$model}->isNotLive()) {
            return abort(404);
        }

        return $next($request);
    }
}
