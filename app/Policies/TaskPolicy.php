<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TaskPolicy
 *
 * @package App\Policies
 */
class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Task $task
     *
     * @return bool
     */
    public function teamMemberAction(User $user, Task $task)
    {
        return $task->project->isTeamMember($user) || $task->project->user_id == $user->id;
    }
}
