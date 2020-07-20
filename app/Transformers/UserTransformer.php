<?php

namespace App\Transformers;

use App\User;

/**
 * Class UserTransformer
 *
 * @package App\Transformers
 */
class UserTransformer extends AbstractTransformer
{
    /**
     * @param User $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'       => $user->id,
            'name'     => $user->name,
            'email'    => $user->email,
            'username' => $user->username,
            'bio'      => $user->bio,
            'img'      => $this->getUserImage($user),
        ];
    }

    /**
     * @param User $user
     *
     * @return string|null
     */
    private function getUserImage(User $user)
    {
        if (!$user->img) {
            return null;
        }

        return asset(config('/') . $user->img);
    }
}