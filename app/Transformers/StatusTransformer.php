<?php

namespace App\Transformers;

use App\Status;

/**
 * Class StatusTransformer
 *
 * @package App\Transformers
 */
class StatusTransformer extends AbstractTransformer
{
    /**
     * @param Status $status
     *
     * @return array
     */
    public function transform(Status $status)
    {
        return [
            'id'    => $status->id,
            'title' => $status->title,
        ];
    }
}