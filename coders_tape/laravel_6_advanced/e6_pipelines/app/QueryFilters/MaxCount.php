<?php

namespace App\QueryFilters;

use Closure;

class MaxCount extends Filter
{
  protected function applyFilter($builder)
  {
    // dd($this->filterName());
    return $builder->limit(request($this->filterName()));
  }
}
