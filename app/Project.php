<?php

namespace App;

/**
 * Class Project
 *
 * @package App
 */
class Project extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function isTeamMember(User $user)
    {
        return $this->users()->where('project_user.user_id', $user->id)->exists();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function bookmarks()
    {
        return $this->morphToMany(User::class, 'bookmarkable', 'bookmarks');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function isBookmarked(User $user)
    {
        return $this
            ->bookmarks()
            ->where([
                'user_id'           => $user->id,
                'bookmarkable_id'   => $this->id,
                'bookmarkable_type' => Project::class,
            ])
            ->exists();
    }
}
