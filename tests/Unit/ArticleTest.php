<?php

use Abr4xas\SimpleBlog\Models\Article;


test('it has author type', function () {
    $article = Article::factory()->create(['author_type' => 'Fake\User']);
    $this->assertEquals('Fake\User', $article->author_type);
});

test('it user can create a post', function () {

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
});
