<?php

use App\Http\Controllers\BlogPostAdminController;
use App\Models\BlogPost;
use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

beforeEach(function () {
  $this->post = BlogPost::factory()->create();
});

it('will update a blog post when an admin is logged in', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */


  $sendRequest = fn () => post(action([BlogPostAdminController::class, 'update'], $this->post->slug), [
    'title' => 'test',
    'author' => $this->post->author,
    'body' => $this->post->body,
    'date' => $this->post->date->format('Y-m-d')
  ]);

  $sendRequest()->assertRedirect(route('login'));

  login();

  $sendRequest()
    ->assertRedirect(action([BlogPostAdminController::class, 'edit'], $this->post->slug));

  expect($this->post->refresh()->title)->toBe('test');
});


it('validates required fields on the post edit form', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  login();

  post(action([BlogPostAdminController::class, 'update'], $this->post->slug), [])
    ->assertSessionHasErrors([
      'title', 'author', 'body', 'date'
    ]);

  post(action([BlogPostAdminController::class, 'update'], $this->post->slug), [
    'title' => 'test',
    'author' => $this->post->author,
    'body' => $this->post->body,
    'date' => $this->post->date->format('Y-m-d')
  ])
    ->assertSessionHasNoErrors();
});


it('will validate the date format on the edit blog post screen', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  login();

  post(action([BlogPostAdminController::class, 'update'], $this->post->slug), [
    'title' => 'test',
    'author' => $this->post->author,
    'body' => $this->post->body,
    'date' => '02/02/2022'
  ])
    ->assertSessionHasErrors(['date' => 'The date does not match the format Y-m-d.']);
});
