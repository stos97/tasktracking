<?php

namespace App\Repositories\Criterias;

use App\Project;
use App\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ProjectBookmarkCriteria
 *
 * @package App\Repositories\Criterias
 */
class ProjectBookmarkCriteria implements CriteriaInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * ProjectMemberCriteria constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model
            ->join('bookmarks', 'bookmarks.bookmarkable_id', '=', 'projects.id',)
            ->where([
                'bookmarkable_type' => Project::class,
                'bookmarks.user_id' => $this->user->id,
            ])->select('projects.*');
    }
}
