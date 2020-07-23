<?php

namespace App;

/**
 * Class Comment
 *
 * @package App
 */
class Comment extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'content',
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
