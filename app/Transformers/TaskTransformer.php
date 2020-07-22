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
     * @param Task $task
     *
     * @return array
     */
    public function transform(Task $task)
    {
        return [
            'title'       => $task->title,
            'description' => $task->description,
        ];
    }

}