<?php

namespace Abr4xas\SimpleBlog\Database\Factories;

use Abr4xas\SimpleBlog\Models\Article;
use Abr4xas\SimpleBlog\Models\Enums\ArticleStatus;
use Abr4xas\SimpleBlog\Tests\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = Article::class;

    /** Define the model's default state. */
    public function definition(): array
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'excerpt' => $this->faker->realText(),
            'slug' => str()->slug($title),
            'body' => $this->content(),
            'file' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([
                ArticleStatus::PUBLISHED(),
                ArticleStatus::DRAFT(),
            ]),
            'created_at' => $this->faker->dateTimeBetween('-20 weeks', 'now'),
        ];
    }

    public function published(): ArticleFactory
    {
        return $this->state([
            'status' => ArticleStatus::PUBLISHED(),
        ]);
    }

    public function draft(): ArticleFactory
    {
        return $this->state([
            'status' => ArticleStatus::DRAFT(),
        ]);
    }

    public function withAuthor(): ArticleFactory
    {
        $author = User::factory()->create();

        return $this->state([
            'author_id' => $author->id,
            'author_type' => User::class,
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
