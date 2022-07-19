<?php

it('can render the homepage', function () {
  /** @var TestCase $this */
  $blogPost = \App\Models\BlogPost::factory()->create();

  $this->get('/')
    ->assertSee('My Blog')
    ->assertSee($blogPost->title);
});
