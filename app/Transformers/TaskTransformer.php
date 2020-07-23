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
        'checklist',
        'comments',
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

    /**
     * @param Task $task
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeChecklist(Task $task)
    {
        return $this->item($task->checklist, new ChecklistTransformer());
    }

    /**
     * @param Task $task
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeComments(Task $task)
    {
        return $this->collection($task->comments, new CommentTransformer());
    }
}