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
            // $this->publishes([
            //     __DIR__ . '/../resources/views' => base_path('resources/views/vendor/simple-blog'),
            // ], 'views');

            // $this->publishes([
            //     $this->publishControllers(),
            // ], 'controllers');

            $migrationFileNames = [
                'create_articles_table.php',
                'create_categories_table.php',
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

    /**
     * Undocumented function
     *
     * @return \Illuminate\Support\Collection
     */
    protected function publishControllers(): void
    {
        if (! is_dir($directory = app_path('Http/Controllers/Front/Articles'))) {
            mkdir($directory, 0755, true);
        }

        $filesystem = new Filesystem;

        collect($filesystem->allFiles(__DIR__.'/../stubs/Controllers'))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    app_path('Http/Controllers/Front/Articles/'.Str::replaceLast('.stub', '.php', $file->getFilename()))
                );
            });
    }
}
