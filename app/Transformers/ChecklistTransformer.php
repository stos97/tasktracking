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
     * @param Checklist $checklist
     *
     * @return array
     */
    public function transform(Checklist $checklist)
    {
        return [
            'id'    => $checklist->getRouteKey(),
            'title' => $checklist->title,
        ];
    }
}