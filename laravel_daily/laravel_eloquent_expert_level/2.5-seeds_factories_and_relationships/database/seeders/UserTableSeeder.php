<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \App\Models\User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
    ]);

    \App\Models\User::factory(10)->create()->each(function ($user) {
      \App\Models\Article::factory(20)->create([
        "user_id" => $user->id
      ]);
    });
  }
}
