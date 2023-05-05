<?php

namespace Abr4xas\SimpleBlog;

use Abr4xas\SimpleBlog\Extensions\TorchlightWithCopyExtension;
use Abr4xas\SimpleBlog\Middleware\Is\Live;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\TaskList\TaskListExtension;
use League\CommonMark\MarkdownConverter;
use SimonVomEyser\CommonMarkExtension\LazyImageExtension;
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
            ->hasMigrations([
                'create_articles_table',
                'create_categories_table',
                'add_category_id_to_articles_table',
                'add_morph_to_columns_to_articles_table',
                'create_tags_table',
            ]);
    }

    /** @throws BindingResolutionException */
    public function packageBooted()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('is.live', Live::class);

		$this->publishes([
			__DIR__ . '/../resources/dist/js/codeBlock.js' => base_path('resources/js/codeBlock.js'),
		], 'simple-blog-assets');
    }

    public function bootingPackage()
    {
        $this->generateMarkdownMacro();
    }

    public function generateMarkdownMacro()
    {
        Str::macro('markdownsb', function ($content) {
            $environment = new Environment([
                'external_link' => [
                    'internal_hosts' => config('app.url'),
                    'open_in_new_window' => true,
                    'html_class' => 'underline',
                    'nofollow' => '',
                    'noopener' => 'external',
                    'noreferrer' => 'external',
                ],
            ]);

            $environment->addExtension(new CommonMarkCoreExtension());

            if (! empty(config()->get('torchlight.token'))) {
                $environment->addExtension(new TorchlightWithCopyExtension());
            }

            $environment->addExtension(new AutolinkExtension());

            $environment->addExtension(new ExternalLinkExtension());

            $environment->addExtension(new AttributesExtension());

            $environment->addExtension(new LazyImageExtension());

            $environment->addExtension(new TaskListExtension());

            return (new MarkdownConverter($environment))
                ->convert($content);
        });
    }
}
