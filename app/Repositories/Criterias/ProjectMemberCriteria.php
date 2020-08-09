<?php

namespace App\Repositories\Criterias;

use App\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ProjectMemberCriteria
 *
 * @package App\Repositories\Criterias
 */
class ProjectMemberCriteria implements CriteriaInterface
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
            ->leftJoin('project_user', 'project_user.project_id', '=', 'projects.id')
            ->where(function ($query) {
               $query
                   ->where('projects.user_id', $this->user->id)
                   ->orWhere('project_user.user_id', $this->user->id);
            })
            ->select('projects.*');
    }
}
