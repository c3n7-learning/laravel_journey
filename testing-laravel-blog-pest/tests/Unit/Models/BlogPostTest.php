<?php

use App\Models\BlogPost;
use App\Models\BlogPostLike;

use function Spatie\PestPluginTestTime\testTime;

it('adds a slug when a blog post is created', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  $blogPost = BlogPost::factory()->create([
    'title' => 'My blogpost'
  ]);

  expect($blogPost->slug)->toEqual('my-blogpost');
});


it('can determine if a blogpost is published', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  $publishedPost = BlogPost::factory()->published()->create();
  expect($publishedPost->isPublished())->toBeTrue();

  $dratPost = BlogPost::factory()->draft()->create();
  expect($dratPost->isPublished())->toBeFalse();
});


it('has a scope to retrieve all published blogposts', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  testTime()->freeze();
  // ARRANGE
  $publishedPost = BlogPost::factory()->published()->create([
    'date' => now(),
  ]);

  $draftPost = BlogPost::factory()->draft()->create([
    'date' => now(),
  ]);


  // ACT
  // When the test is run, wherePublished will be one second behind, so the posts will be in the future
  testTime()->subSecond();
  $publishedPosts = BlogPost::wherePublished()->get();
  expect($publishedPosts)->toHaveCount(0);


  testTime()->addSecond();
  $publishedPosts = BlogPost::wherePublished()->get();

  // ASSERT
  expect($publishedPosts)->toHaveCount(1)
    ->and($publishedPosts[0]->id)
    ->toEqual($publishedPost->id);
});


it('can create models with relationships', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  $post = BlogPost::factory()
    ->has(BlogPostLike::factory()->count(5), 'postLikes')
    ->create();

  expect($post->postLikes)->toHaveCount(5);
});
