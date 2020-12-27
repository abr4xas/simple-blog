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

            if (! file_exists(database_path('migrations/2020_12_27_000000_create_categories_table.php'))) {
                $this->publishes([
                    __DIR__.'/../database/migrations' => database_path('migrations'),
                ], 'simpleblog-migrations');
            }

            $this->publishes([
                __DIR__.'/../stubs/Controllers' => app_path('Http/Controllers/Front/Articles'),
            ], 'simpleblog-controllers');

            $this->publishes([
                __DIR__.'/Models' => app_path('Models'),
            ], 'simpleblog-models');
        }

        return $this;
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
