<?php

// ItemFilter.php

namespace App\Filters;

class DescriptionFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('description', "like","%".$value."%");
    }
}