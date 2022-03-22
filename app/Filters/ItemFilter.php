<?php

// ProductFilter.php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class ItemFilter extends AbstractFilter
{
    protected $filters = [
        'type' => TypeFilter::class
    ];
}