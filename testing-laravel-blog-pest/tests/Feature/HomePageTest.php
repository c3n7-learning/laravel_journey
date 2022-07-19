<?php

use App\Http\Controllers\ExternalPostSuggestionController;
use App\Mail\ExternalPostSuggestedMail;
use App\Models\BlogPost;
use App\Models\ExternalPost;

use function Pest\Laravel\assertDatabaseHas;

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

it('can accept suggestions', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  Mail::fake();

  $externalPostAttributes = [
    'title' => 'My Title',
    'url' => 'https://example.com',
  ];

  $this->post(action(ExternalPostSuggestionController::class), $externalPostAttributes)
    ->assertSessionHasNoErrors()
    ->assertRedirect('/');

  assertDatabaseHas('external_posts', $externalPostAttributes);

  Mail::assertSent(function (ExternalPostSuggestedMail $mail) use ($externalPostAttributes) {
    if (!$mail->hasTo('admin@yourblog.com')) {
      return false;
    }

    if ($mail->title !== $externalPostAttributes['title']) {
      return false;
    }

    if ($mail->url !== $externalPostAttributes['url']) {
      return false;
    }

    return true;
  });
});


it('will not accept a suggestion with invalid input', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  Mail::fake();

  $this->post(
    action(ExternalPostSuggestionController::class),
    [
      'url' => 'https://example.com',
    ]
  )
    ->assertSessionHasErrors(['title']);

  expect(ExternalPost::count())->toBe(0);

  Mail::assertNothingSent();
});
