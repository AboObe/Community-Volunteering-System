<?php

// ProductFilter.php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class AnnouncementFilter extends AbstractFilter
{
    protected $filters = [
        'name' => NameFilter::class,
        'description' => DescriptionFilter::class,
        'project_id' => ProjectFilter::class,
        'status' => StatusFilter::class,
        'address' => AddressFilter::class,


    ];
}