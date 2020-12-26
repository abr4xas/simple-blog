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
     */
    public function handle($request, Closure $next, $model)
    {

		if ($request->{$model}->isNotLive()) {
			return abort(404);
		}

        return $next($request);
    }
}
