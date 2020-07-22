<?php

namespace App\Repositories;

use App\Task;

/**
 * Class TaskRepository
 *
 * @package App\Repositories
 */
class TaskRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Task::class;
    }
}