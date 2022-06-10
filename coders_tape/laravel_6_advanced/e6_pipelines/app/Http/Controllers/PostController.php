<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::query();

    if (request()->has('active')) {
      // localhost:8000/?active=1
      $posts->where('active', request('active'));
    }


    if (request()->has('sort')) {
      // localhost:8000/?sort=asc
      // localhost:8000/?sort=desc
      $posts->orderBy('title', request('sort'));
    }

    $posts = $posts->get();

    return view('posts.index', compact('posts'));
  }
}
