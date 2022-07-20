<?php

use App\Actions\SyncExternalPostAction;
use App\Models\ExternalPost;
use App\Support\Rss\RssEntry;
use App\Support\Rss\RssRepository;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('will sync an external feed to the database', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  // arrange
  Http::fake([
    'https://example.com/*' => Http::sequence()
      ->push(getFeed('test-a'))
      ->push(getFeed('test-b'))
  ]);

  // act
  $syncExternalPostAction = app(SyncExternalPostAction::class); // let laravel inject the RssRepository
  $syncExternalPostAction('https://example.com/feed');

  // assert
  assertDatabaseHas(ExternalPost::class, [
    'url' => 'https://example.com',
    'title' => 'test-a',
  ]);

  assertDatabaseMissing(ExternalPost::class, [
    'url' => 'https://example.com',
    'title' => 'test-b',
  ]);

  $syncExternalPostAction('https://example.com/feed');

  assertDatabaseHas(ExternalPost::class, [
    'url' => 'https://example.com',
    'title' => 'test-b',
  ]);
});
