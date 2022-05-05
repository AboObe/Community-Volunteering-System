<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

 /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'period',
        'start_date',
        'owner'
    ];

   /* protected $casts = [
        'start_date' => 'datetime:Y-m-d',
    ];
*/
    
    /**
     * Get the Announcements for the blog Project.
     */
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
