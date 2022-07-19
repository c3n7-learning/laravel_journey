<?php

namespace App\Support\Rss;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class FakeRssRepository extends RssRepository
{
  /**
   * @return \Illuminate\Support\Collection|\App\Support\Rss\RssEntry[]
   */
  public function fetch(string $url): Collection
  {

    // [
    //   'url' => 'https://test.com',
    //   'title' => 'test',
    // ]

    return collect([
      new RssEntry('https://test.com', 'test', CarbonImmutable::make('2022-02-02'))
    ]);
  }
}
