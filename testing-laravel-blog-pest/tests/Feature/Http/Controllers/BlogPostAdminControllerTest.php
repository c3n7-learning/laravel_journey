<?php

use App\Http\Controllers\BlogPostAdminController;
use App\Models\BlogPost;
use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('will update a blog post when an admin is logged in', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  $post = BlogPost::factory()->make();

  $sendRequest = fn () =>   post(action([BlogPostAdminController::class, 'update'], $post->slug), [
    'title' => 'test',
    'author' => $post->author,
    'body' => $post->body,
    'date' => $post->date->format('Y-m-d')
  ]);

  $sendRequest()->assertRedirect(route('login'));

  // https://github.com/bmewburn/vscode-intelephense/issues/2163#issuecomment-1059662486
  // actingAs(User::factory()->create());
  test()->actingAs(User::factory()->create());

  $sendRequest();

  $post->refresh();

  expect($post->title)->toBe('test');

  // assertDatabaseHas(BlogPost::class, [
  //   'title' => $post->title,
  //   'author' => $post->author,
  //   'body' => $post->body,
  // ]);
});
