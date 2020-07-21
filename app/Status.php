<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 *
 * @package App
 */
class Status extends Model
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
}
