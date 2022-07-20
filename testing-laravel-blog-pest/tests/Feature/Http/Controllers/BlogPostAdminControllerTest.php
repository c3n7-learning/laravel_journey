<?php

use App\Http\Controllers\BlogPostAdminController;
use App\Models\BlogPost;
use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('will update a blog post when an admin is logged in', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  $post = BlogPost::factory()->create();

  $sendRequest = fn () => post(action([BlogPostAdminController::class, 'update'], $post->slug), [
    'title' => 'test',
    'author' => $post->author,
    'body' => $post->body,
    'date' => $post->date->format('Y-m-d')
  ]);

  $sendRequest()->assertRedirect(route('login'));

  login();

  $sendRequest()
    ->assertRedirect(action([BlogPostAdminController::class, 'edit'], $post->slug));

  expect($post->refresh()->title)->toBe('test');
});


it('validates required fields on the post edit form', function () {
  $post = BlogPost::factory()->create([
    'title' => 'test'
  ]);

  // post(action([BlogPostAdminController::class, 'update'], $post->slug), []);
});
