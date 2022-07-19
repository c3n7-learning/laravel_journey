<?php

use App\Models\BlogPost;
use App\Models\BlogPostLike;
use App\Models\Enums\BlogPostStatus;

it('can render the homepage', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */
  $this->get('/')
    ->assertSee('My Blog');
});


it('will only show published blogposts', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */
  $publishedPost = BlogPost::factory()->published()->create();

  $draftPost = BlogPost::factory()->draft()->create();


  $this->get('/')
    ->assertSee($publishedPost->title)
    ->assertDontSee($draftPost->title);
});


it('can create models with relationships', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  $post = BlogPost::factory()
    ->has(BlogPostLike::factory()->count(5), 'postLikes')
    ->create();

  expect($post->postLikes)->toHaveCount(5);
});
