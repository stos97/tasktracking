<?php

namespace App\Policies;

use App\Checklist;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ChecklistPolicy
 *
 * @package App\Policies
 */
class ChecklistPolicy
{
    use HandlesAuthorization;

    /**
     * @param User      $user
     * @param Checklist $checklist
     *
     * @return bool
     */
    public function teamMemberAction(User $user, Checklist $checklist)
    {
        return $checklist->project->isTeamMember($user) || $checklist->project->user_id == $user->id;
//        return $project->isTeamMember($user) || $project->user_id == $user->id;
    }
}
