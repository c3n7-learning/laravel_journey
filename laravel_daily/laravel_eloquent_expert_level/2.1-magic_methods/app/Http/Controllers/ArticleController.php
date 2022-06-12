<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $articles = Article::orderByDesc('id')
      ->paginate();

    return view('articles.index', ["articles" => $articles]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view("articles.create");
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // $article = Article::where('title', $request->title)->first();
    // if (!$article) {
    //   Article::create($request->only(['title', 'article_text']));
    // }

    // $article = Article::firstOrCreate(
    //   ['title' => $request->title],
    //   ['article_text' => $request->article_text]
    // );

    // $article = Article::firstOrNew(
    //   ['title' => $request->title],
    //   ['article_text' => $request->article_text]
    // );
    // $article->field = $value;
    // $article->save();


    $article = Article::updateOrCreate(
      ['title' => $request->title],
      ['article_text' => $request->article_text]
    );


    return redirect()->route('articles.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function show(Article $article)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function edit(Article $article)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Article $article)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function destroy(Article $article)
  {
    //
  }
}
