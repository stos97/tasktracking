<?php

namespace App;

/**
 * Class Checklist
 *
 * @package App
 */
class Checklist extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'project_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
