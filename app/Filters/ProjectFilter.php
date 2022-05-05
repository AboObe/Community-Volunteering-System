<?php

// ItemFilter.php

namespace App\Filters;

class ProjectFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('project_id', $value);
    }
}