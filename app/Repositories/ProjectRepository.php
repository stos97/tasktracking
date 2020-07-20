<?php

namespace App\Repositories;

use App\Project;

/**
 * Class ProjectRepository
 *
 * @package App\Repositories
 */
class ProjectRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Project::class;
    }
}