<?php

use Abr4xas\SimpleBlog\Models\Article;
use Illuminate\Database\Eloquent\Builder;

test('it has author type', function () {
    $article = Article::factory()->withAuthor()->create();
    expect($article->author_type)->toEqual('Abr4xas\SimpleBlog\Tests\Models\User');
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

    expect($article)->toBeInstanceOf(Article::class);
});

test('it live scope is working', function() {
    $scope = Article::live();

    expect($scope)->toBeInstanceOf(Builder::class);
});
