<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ServerMonitor\Models\Host;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Project extends Model
{
    use LogsActivity, HasFactory, SoftDeletes, Prunable;

    protected $fillable = [
        'active',
        'title',
        'url',
        'description',
        'users',

    ];
    protected $casts = [
        'active'          => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable();
    }
    protected static $logAttributes = ['*'];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function monitor()
    {
        return $this->belongsTo(Host::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function postsTrashed()
    {
        return $this->hasMany(Post::class)->withTrashed();
    }
    public function prunable()
    {
        return static::where('deleted_at', '<=', now()->subMonth());
    }


}
