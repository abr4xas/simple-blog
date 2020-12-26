<?php
namespace Abr4xas\SimpleBlog\Middleware\Is;

use Closure;
use Abr4xas\SimpleBlog\Models\Article;

class Live
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, Article $model)
    {

		if ($request->{$model}->isNotLive()) {
			return abort(404);
		}

        return $next($request);
    }
}
