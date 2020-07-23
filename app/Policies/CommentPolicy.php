<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CommentPolicy
 *
 * @package App\Policies
 */
class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * @param User    $user
     * @param Comment $comment
     *
     * @return bool
     */
    public function ownerAction(User $user, Comment $comment)
    {
        return $user->id == $comment->user_id;
    }
}
