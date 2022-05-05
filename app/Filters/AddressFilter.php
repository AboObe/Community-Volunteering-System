<?php

// ItemFilter.php

namespace App\Filters;

class AddressFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('address', "like","%".$value."%");
    }
}