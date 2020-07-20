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
            ->has('users')
            ->orWhere('user_id', $this->user->id);
    }
}
