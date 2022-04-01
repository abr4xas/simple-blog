<?php

namespace Abr4xas\SimpleBlog\Tests;

use Abr4xas\SimpleBlog\SimpleBlogServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
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
        config()->set('database.default', 'testing');

        $create_users_table = include __DIR__ .'/database/migrations/create_users_table.php.stub';
        $create_articles_table = include __DIR__.'/../database/migrations/create_articles_table.php.stub';
        $create_categories_table = include __DIR__.'/../database/migrations/create_categories_table.php.stub';
        $add_category_id_to_articles_table = include __DIR__.'/../database/migrations/add_category_id_to_articles_table.php.stub';
        $add_morph_to_columns_to_articles_table = include __DIR__.'/../database/migrations/add_morph_to_columns_to_articles_table.php.stub';


        $create_users_table->up();
        $create_articles_table->up();
        $create_categories_table->up();
        $add_category_id_to_articles_table->up();
        $add_morph_to_columns_to_articles_table->up();
    }
}
