<?php

use App\Rules\UppercaseRule;

it('will pass for upper cased values', function (string $value, bool $expectedResult) {
  /** @var Illuminate\Foundation\Testing\TestCase this */

  $result = (new UppercaseRule())->passes('name', $value);
  expect($result)->toBe($expectedResult);
})->with([
  ['MY STRING', true],
  ['my string', false],
  ['MY STRINg', false],
  ['My string', false],
]);
