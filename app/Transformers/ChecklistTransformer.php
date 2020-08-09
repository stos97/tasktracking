<?php

namespace App\Transformers;

use App\Checklist;

/**
 * Class ChecklistTransformer
 *
 * @package App\Transformers
 */
class ChecklistTransformer extends AbstractTransformer
{
    /**
     * @var string[]
     */
    protected $availableIncludes = [
        'tasks',
    ];

    /**
     * @param Checklist $checklist
     *
     * @return array
     */
    public function transform(Checklist $checklist)
    {
        return [
            'id'          => $checklist->getRouteKey(),
            'title'       => $checklist->title,
            'tasks_count' => $checklist->tasks_count,
        ];
    }

    /**
     * @param Checklist $checklist
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTasks(Checklist $checklist)
    {
        return $this->collection($checklist->tasks, new TaskTransformer());
    }
}