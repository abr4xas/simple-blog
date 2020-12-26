<?php

namespace Abr4xas\SimpleBlog;

use Illuminate\Support\ServiceProvider;

class SimpleBlogServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/simple-blog'),
            ], 'views');

            $migrationFileNames = [
                'create_articles_table.php',
                'create_categories_table.php',
                'add_category_id_to_articles_table.php',
            ];

            foreach ($migrationFileNames as $key) {
                if (! $this->migrationFileExists($key)) {
                    $this->publishes([
                        __DIR__ . "/../database/migrations/{$key}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $key),
                    ], 'migrations');
                }
            }
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'simple-blog');
    }

    public function register()
    {
        //
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
