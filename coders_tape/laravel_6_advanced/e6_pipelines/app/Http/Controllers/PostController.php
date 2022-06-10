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

    $posts = app(Pipeline::class)
      ->send(Post::query())
      ->through([
        \App\QueryFilters\Active::class,
        \App\QueryFilters\Sort::class
      ])
      ->thenReturn()
      ->get();

    // dd($pipeline); 

    return view('posts.index', compact('posts'));
  }
}
