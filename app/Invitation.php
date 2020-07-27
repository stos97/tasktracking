<?php

namespace App;

/**
 * Class Invitation
 *
 * @package App
 */
class Invitation extends Model
{
    protected $fillable = [
        'email',
        'token',
        'project_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
