<?php

use App\Http\Controllers\UploadController;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\post;
use function Spatie\PestPluginTestTime\testTime;

it('can handle an upload', function () {
  /** @var Illuminate\Foundation\Testing\TestCase this */

  testTime()->freeze('2022-02-02 00:00:00');
  Storage::fake('public');

  $file = UploadedFile::fake()->image('test.jpg');

  post(action(UploadController::class), [
    'file' => $file
  ])
    ->assertSuccessful()
    ->assertSee('uploads/2022-02-02-00-00-00-test.jpg');

  Storage::disk('public')->assertExists('uploads/2022-02-02-00-00-00-test.jpg');
});
