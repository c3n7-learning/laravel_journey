<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  use HasFactory;

  // protected $fillable = [
  //   'title',
  //   'article_text'
  // ];

  protected $guarded = [
    "id"
  ];


  protected $perPage = 10;
}
