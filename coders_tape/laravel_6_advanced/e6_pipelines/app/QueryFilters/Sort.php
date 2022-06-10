<?php

namespace App\QueryFilters;

use Closure;

class Sort
{
  public function handle($request, Closure $next)
  {
    if (!request()->has('sort')) {
      return $next($request);
    }
    // localhost:8000/?sort=desc

    $builder = $next($request);
    return $builder->orderBy('title', request('sort'));
  }
}
