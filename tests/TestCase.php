<?php

namespace Abr4xas\SimpleBlog\Tests;

use Abr4xas\SimpleBlog\SimpleBlogServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Abr4xas\\SimpleBlog\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            SimpleBlogServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        include_once __DIR__.'/../database/migrations/2020_11_16_025332_create_articles_table.php';
        include_once __DIR__.'/../database/migrations/2020_11_16_210105_create_categories_table.php';
        include_once __DIR__.'/../database/migrations/2020_11_16_210339_add_category_id_to_articles_table.php';
        include_once __DIR__.'/../database/migrations/2020_12_27_000002_add_morph_to_columns_to_articles_table.php';
        include_once __DIR__.'/database/migrations/create_users_table.php.stub';

        (new \CreateUsersTable())->up();
        (new \CreateArticlesTable())->up();
        (new \AddMorphToColumnsToArticlesTable())->up();
        (new \CreateCategoriesTable())->up();
        (new \AddCategoryIdToArticlesTable())->up();
    }
}
