<?php

namespace App\Transformers;

use App\Project;

/**
 * Class ProjectTransformer
 *
 * @package App\Transformers
 */
class ProjectTransformer extends AbstractTransformer
{
    protected $availableIncludes = [
        'owner',
        'users',
    ];

    /**
     * @param Project $project
     *
     * @return array
     */
    public function transform(Project $project)
    {
        return [
            'id'    => $project->id,
            'title' => $project->title,
        ];
    }

    /**
     * @param Project $project
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeOwner(Project $project)
    {
        return $this->item($project->owner, new UserTransformer());
    }

    /**
     * @param Project $project
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeUsers(Project $project)
    {
        return $this->collection($project->users, new UserTransformer());
    }
}