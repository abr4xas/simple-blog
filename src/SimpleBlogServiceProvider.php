<?php

namespace Abr4xas\SimpleBlog;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SimpleBlogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('simple-blog')
            ->hasConfigFile()
            ->hasMigrations([
                'create_articles_table',
                'create_categories_table',
                'add_category_id_to_articles_table',
                'add_morph_to_columns_to_articles_table',
                'create_tags_table',
            ]);
    }

    public function packageBooted()
    {
        $router = $this->app->make(\Illuminate\Routing\Router::class);
        $router->aliasMiddleware('is.live', \Abr4xas\SimpleBlog\Middleware\Is\Live::class);
    }
}
