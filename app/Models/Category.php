<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'image','description'];
    /**
     * Get the items for the blog category.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}