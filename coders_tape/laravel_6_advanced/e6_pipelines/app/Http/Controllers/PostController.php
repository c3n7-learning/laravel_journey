<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::query();

    $pipeline = app(Pipeline::class)
      ->send(Post::query())
      ->through([
        \App\QueryFilters\Active::class
      ])
      ->thenReturn()
      ->get();

    dd($pipeline);

    if (request()->has('sort')) {
      // localhost:8000/?sort=asc
      // localhost:8000/?sort=desc
      $posts->orderBy('title', request('sort'));
    }

    $posts = $posts->get();

    return view('posts.index', compact('posts'));
  }
}
