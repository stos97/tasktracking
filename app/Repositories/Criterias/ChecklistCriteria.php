<?php

namespace App\Repositories\Criterias;

use App\Project;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ChecklistCriteria
 *
 * @package App\Repositories\Criterias
 */
class ChecklistCriteria implements CriteriaInterface
{
    /**
     * @var Project
     */
    private $project;

    /**
     * ChecklistCriteria constructor.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('project_id', $this->project->id);
    }
}
