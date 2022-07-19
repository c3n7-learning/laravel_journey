<?php

use App\Actions\SyncExternalPostAction;
use App\Models\ExternalPost;
use App\Support\Rss\FakeRssRepository;

use function Pest\Laravel\assertDatabaseHas;

it('will sync an external feed to the database', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  // arrange
  $rssRepository = new FakeRssRepository();

  // act
  $syncExternalPostAction = new SyncExternalPostAction($rssRepository);
  $syncExternalPostAction('https://example.com/feed');

  // assert
  assertDatabaseHas(ExternalPost::class, [
    'url' => 'https://test.com',
    'title' => 'test',
  ]);
});
