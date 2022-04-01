<?php

namespace Abr4xas\SimpleBlog\Database\Factories;

use Abr4xas\SimpleBlog\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;


class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $author = \Abr4xas\SimpleBlog\Tests\Models\User::factory()->create();

        $title = $this->faker->sentence;

        return [
			'title' => $title,
			'excerpt' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
			'body' => $this->faker->realText($maxNbChars = 800, $indexSize = 2),
			'status' => 'PUBLISHED',
            'file' => $this->faker->imageUrl($width = 1200, $height = 400),
            'author_id' => $author->id,
            'author_type' => \Abr4xas\SimpleBlog\Tests\Models\User::class,
        ];
    }
}
