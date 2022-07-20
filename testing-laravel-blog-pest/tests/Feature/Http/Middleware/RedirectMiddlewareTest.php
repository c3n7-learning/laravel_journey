<?php

use App\Http\Middleware\RedirectMiddleware;
use App\Models\Redirect;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\get;

test('test the middleware in isolation', function () {
  /** @var Illuminate\Foundation\Testing\TestCase this */

  /** @var $response  */
  $response = (new RedirectMiddleware())->handle(
    createRequest('get', '/'),
    fn () => new Response()
  );

  expect($response->isRedirect())->toBeFalse();


  Redirect::factory()->create([
    'from' => '/',
    'to' => '/new-homepage'
  ]);

  $response = (new RedirectMiddleware())->handle(
    createRequest('get', '/'),
    fn () => new Response()
  );

  expect($response->isRedirect(url('new-homepage')))->toBeTrue();
});


// test the middleware in full app
it('will perform the right redirects', function () {
  /** @var Illuminate\Foundation\Testing\TestCase this */

  // Create a route to use in this test.
  Route::get('my-test-route', fn () => 'ok')
    ->middleware(RedirectMiddleware::class);

  get('my-test-route')->assertStatus(200);

  Redirect::factory()->create([
    'from' => '/my-test-route',
    'to' => '/new-homepage'
  ]);

  get('my-test-route')->assertRedirect('/new-homepage');
});
