<?php
namespace Abr4xas\SimpleBlog\Tests\Unit;

use Abr4xas\SimpleBlog\Models\Article;
use Abr4xas\SimpleBlog\Tests\TestCase;

class ArticleTest extends TestCase
{
    /** @test */
    public function test_it_has_an_author_type()
    {
        $article = Article::factory()->create(['author_type' => 'Fake\User']);

        $this->assertEquals('Fake\User', $article->author_type);
    }

    /** @test */
    public function test_it_user_can_create_a_post()
    {
        $user = \Abr4xas\SimpleBlog\Tests\Models\User::factory()->create();

        $article = $user->articles()->create([
            'title' => 'My first fake post',
            'slug' => 'my-first-post',
            'excerpt' => 'The excerpt of this fake post',
            'body' => 'The body of this fake post',
            'status' => 'PUBLISHED',
            'file' => 'https://i.pinimg.com/originals/4f/e7/06/4fe7066d4f3aa7201e38484230fc32b3.jpg',
        ]);

        $this->assertInstanceOf(\Abr4xas\SimpleBlog\Models\Article::class, $article);
    }
}
