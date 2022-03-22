<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Filters\ItemFilter;
use Illuminate\Database\Eloquent\Builder;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 
    'image', 
    'status', 
    'type', 
    'description', 
    'location',
    'category_id', 
    'user_id', 
    'date_item'
    ];

    /**
     * Get the category that owns the item.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

     /**
     * Get the user that owns the item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new ItemFilter($request))->filter($builder);
    }
}
