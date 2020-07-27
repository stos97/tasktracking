<?php

namespace App\Repositories;

use App\Invitation;

/**
 * Class InvitationRepository
 *
 * @package App\Repositories
 */
class InvitationRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Invitation::class;
    }
}