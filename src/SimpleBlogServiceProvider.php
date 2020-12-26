<?php

namespace Abr4xas\SimpleBlog;

use Illuminate\Support\ServiceProvider;
use Abr4xas\SimpleBlog\Commands\SimpleBlogCommand;

class SimpleBlogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/simple-blog.php' => config_path('simple-blog.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/simple-blog'),
            ], 'views');

            $migrationFileName = 'create_simple_blog_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                SimpleBlogCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'simple-blog');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/simple-blog.php', 'simple-blog');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
