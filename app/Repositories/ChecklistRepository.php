<?php

namespace App\Repositories;

use App\Checklist;

/**
 * Class ChecklistRepository
 *
 * @package App\Repositories
 */
class ChecklistRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Checklist::class;
    }
}