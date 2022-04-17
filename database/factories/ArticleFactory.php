<?php

namespace Abr4xas\SimpleBlog\Database\Factories;

use Abr4xas\SimpleBlog\Models\Article;
use Abr4xas\SimpleBlog\Models\Enums\ArticleStatus;
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

        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'excerpt' => $this->faker->realText(),
            'body' => $this->content(),
            'file' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([
                ArticleStatus::PUBLISHED(),
                ArticleStatus::DRAFT()
            ]),
            'created_at' => $this->faker->dateTimeBetween('-20 weeks', 'now')
        ];
    }

    public function published()
    {
        return $this->state([
            'status' => ArticleStatus::PUBLISHED()
        ]);
    }

    public function draft()
    {
        return $this->state([
            'status' => ArticleStatus::DRAFT()
        ]);
    }

    public function withAuthor(): ArticleFactory
    {
        $author = \Abr4xas\SimpleBlog\Tests\Models\User::factory()->create();
        return $this->state([
            'author_id' => $author->id,
            'author_type' => \Abr4xas\SimpleBlog\Tests\Models\User::class,
        ]);
    }

    public function content(): string
    {
        return '
            ## hello world
            this is a test
        ';
    }
}
