<?php

use App\Http\Livewire\VoteButton;
use App\Models\BlogPost;
use Livewire\Livewire;

it('it can toggle a like', function () {
  /** @var Illuminate\Foundation\Testing\TestCase this */

  /** @var post */
  $post = BlogPost::factory()->create();

  $component = Livewire::test(VoteButton::class, [
    'post' => $post
  ]);

  $component->call('like');
  expect($post->refresh()->likes)->toBe(1);



  // Test as another user. Anothr UUID is generated
  $otherComponent = Livewire::test(VoteButton::class, [
    'post' => $post
  ]);

  $otherComponent->call('like');
  expect($post->refresh()->likes)->toBe(2);

  $otherComponent->call('like');
  expect($post->refresh()->likes)->toBe(1);

  $component->call('like');
  expect($post->refresh()->likes)->toBe(0);
});
