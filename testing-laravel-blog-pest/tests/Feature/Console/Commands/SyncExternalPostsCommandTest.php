<?php

use App\Console\Commands\SyncExternalPostsCommand;
use App\Models\ExternalPost;
use Tests\Fakes\RssRepositoryFake;

use function Pest\Laravel\artisan;

it('can sync external feeds', function () {
  /** @var Illuminate\Foundation\Testing\TestCase $this */

  RssRepositoryFake::setUp();

  $urls = [
    'https://test-a.com',
    'https://test-b.com',
    'https://test-c.com',
  ];

  config()->set('services.external_feeds', $urls);

  artisan(SyncExternalPostsCommand::class)->assertExitCode(0);

  RssRepositoryFake::expectFeedUrlsFetched($urls);
  RssRepositoryFake::expectFeedUrlsFetchedCount(3);
});
