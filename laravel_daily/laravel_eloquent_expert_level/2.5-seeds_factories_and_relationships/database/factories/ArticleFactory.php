<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      "title" => $this->faker->sentence(3),
      "article_text" => $this->faker->paragraph(4),
      "user_id" => \App\Models\User::factory()->create()->id,
    ];
  }
}
