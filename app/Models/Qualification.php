<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * The Announcement that belong to the Qualification.
     */
    public function announcements()
    {
        return $this->belongsToMany(Announcement::class);
    }
     /**
     * The Volunteer that belong to the Qualification.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
