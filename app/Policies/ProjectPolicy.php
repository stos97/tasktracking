<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ProjectPolicy
 *
 * @package App\Policies
 */
class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * @param User    $user
     * @param Project $project
     *
     * @return bool
     */
    public function ownerAction(User $user, Project $project)
    {
        return $user->id == $project->user_id;
    }
}
