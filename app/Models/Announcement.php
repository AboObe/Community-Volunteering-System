<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Filters\AnnouncementFilter;
use Illuminate\Database\Eloquent\Builder;

class Announcement extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'description',
        'hours',
        'project_id',
        'status'
    ];
     /**
     * The Qualifications that belong to the Announcement.
     */
    public function qualifications()
    {
        return $this->belongsToMany(Qualification::class);
    }
    /**
     * The Volunteers that belong to the Announcement.
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'');
    }
    /**
     * Get the project that owns the Announcement.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new AnnouncementFilter($request))->filter($builder);
    }
}
