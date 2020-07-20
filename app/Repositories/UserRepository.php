<?php

namespace App\Repositories;

use App\User;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}