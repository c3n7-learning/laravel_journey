<?php

it('can render the homepage', function () {
  /** @var TestCase $this */
  \App\Models\BlogPost::create([
    'title' => 'Parallel php',
    'author' => 'author',
    'date' => now(),
    'body' => 'body',
    'status' => \App\Models\Enums\BlogPostStatus::PUBLISHED(),
  ]);

  \App\Models\BlogPost::create([
    'title' => 'Another One',
    'author' => 'author',
    'date' => now(),
    'body' => 'body',
    'status' => \App\Models\Enums\BlogPostStatus::PUBLISHED(),
  ]);

  $this->get('/')
    ->assertSee('My Blog')
    ->assertSee('Parallel php')
    ->assertSee('Another One');
});
