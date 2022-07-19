<?php

use App\Models\BlogPost;

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
