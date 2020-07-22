<?php

namespace App\Transformers;

use App\Task;

/**
 * Class TaskTransformer
 *
 * @package App\Transformers
 */
class TaskTransformer extends AbstractTransformer
{
    /**
     * @var string[]
     */
    protected $availableIncludes = [
        'users',
    ];

    /**
     * @param Task $task
     *
     * @return array
     */
    public function transform(Task $task)
    {
        return [
            'id'          => $task->getRouteKey(),
            'title'       => $task->title,
            'description' => $task->description,
        ];
    }

    /**
     * @param Task $task
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeUsers(Task $task)
    {
        return $this->collection($task->users, new UserTransformer());
    }
}