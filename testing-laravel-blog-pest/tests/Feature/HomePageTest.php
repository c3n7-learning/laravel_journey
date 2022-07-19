<?php

use App\Models\BlogPost;
use App\Models\Enums\BlogPostStatus;

it('can render the homepage', function () {
  /** @var TestCase $this */
  $this->get('/')
    ->assertSee('My Blog');
});


it('will only show published blogposts', function () {
  /** @var TestCase $this */
  $publishedPost = BlogPost::factory()->published()->create();

  $draftPost = BlogPost::factory()->draft()->create();


  $this->get('/')
    ->assertSee($publishedPost->title)
    ->assertDontSee($draftPost->title);
});
