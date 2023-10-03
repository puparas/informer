<?php

namespace App\Models;

use App\Traits\NotifiUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use JeroenG\Explorer\Application\Explored;
use JeroenG\Explorer\Application\IndexSettings;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Post extends Model implements Explored
{
    use HasFactory, SoftDeletes, Prunable, NotifiUsersTrait, LogsActivity, Searchable;

    protected $fillable = [
        'title',
        'content',
        'priority',
        'role_id',
        'user_id',
        'project_id',

    ];
    protected $casts = [
        'active'          => 'boolean',
        'created_at' => 'datetime:d.m.y',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user', 'comments'];

//    public function toSearchableArray()
//    {
//        return [
//            "title" => $this->title,
//            "content" => $this->content,
//            "project_id" => $this->project_id
//        ];
//    }

    public function mappableAs(): array
    {
        return [
            "title" => "text",
            "content" => "text",
        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function prunable()
    {
        return static::where('deleted_at', '<=', now()->subMonth());
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
}
