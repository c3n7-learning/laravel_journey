<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
  use HasFactory;

  // protected $fillable = [
  //   'title',
  //   'article_text'
  //   'user_id'
  // ];

  protected $guarded = [
    "id"
  ];

  protected $perPage = 10;

  protected function randomTitle(): Attribute
  {
    return Attribute::make(
      get: fn () => Str::kebab($this->title . " " . Str::random(4)),
    );
  }

  protected function title(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => Str::title($value),
      set: fn ($value) => Str::lower($value),
    );
  }
}
