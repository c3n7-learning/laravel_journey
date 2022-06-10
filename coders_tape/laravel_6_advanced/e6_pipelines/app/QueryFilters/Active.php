<?php

namespace App\QueryFilters;

use Closure;

class Active
{
  public function handle($request, Closure $next)
  {
    if (!request()->has('active')) {
      return $next($request);
    }

    $builder = $next($request);
    // localhost:8000/?active=1
    return $builder->where('active', request('active'));
  }
}
