<?php

namespace Abr4xas\SimpleBlog;

use Abr4xas\SimpleBlog\Commands\InstallSimpleBlogCommand;
use Illuminate\Support\ServiceProvider;

class SimpleBlogServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this
            ->registerPublishables()
            ->registerCommands();
    }

    protected function registerPublishables(): self
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

        return $this;
    }

    protected function registerCommands(): self
    {
        if (! $this->app->runningInConsole()) {
            return $this;
        }

        $this->commands([
            InstallSimpleBlogCommand::class,
        ]);

        return $this;
    }

    protected function registerViews(): self
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'simple-blog');

        return $this;
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
