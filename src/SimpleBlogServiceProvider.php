<?php

namespace Abr4xas\SimpleBlog;

use Illuminate\Support\ServiceProvider;

class SimpleBlogServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPublishables();

        $this->registerCustomMiddleware();
    }

    protected function registerPublishables(): self
    {
        if ($this->app->runningInConsole()) {

            // $this->publishes([
            //     __DIR__ . '/../resources/views' => base_path('resources/views/vendor/simple-blog'),
            // ], 'views');

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'simpleblog-migrations');

            $this->publishes([
                __DIR__.'/../stubs/Controllers' => app_path('Http/Controllers/Front/Articles'),
			], 'simpleblog-controllers');

            $this->publishes([
                $this->publishRoute()
            ], 'simpleblog-route');
        }

        return $this;
    }

    protected function publishRoute(): void
    {
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/../stubs/Routes/routes.stub'),
            FILE_APPEND
        );
    }

    protected function registerViews(): self
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'simple-blog');

        return $this;
    }

    protected function registerCustomMiddleware(): void
    {
        $router = $this->app->make(\Illuminate\Routing\Router::class);
        $router->aliasMiddleware('is.live', \Abr4xas\SimpleBlog\Middleware\Is\Live::class);
    }
}
