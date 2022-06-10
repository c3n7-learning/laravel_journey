<?php

namespace App\QueryFilters;

use Closure;
use Str;

abstract class Filter
{
  public function handle($request, Closure $next)
  {
    if (!request()->has($this->filterName())) {
      return $next($request);
    }
    // localhost:8000/?sort=desc

    $builder = $next($request);
    return $this->applyFilter($builder);
  }

  protected abstract function applyFilter($builder);

  protected function filterName()
  {
    return Str::snake(class_basename($this));
  }
}
