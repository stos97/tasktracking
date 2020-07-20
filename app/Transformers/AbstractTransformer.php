<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class AbstractTransformer
 *
 * @package App\Transformers
 */
abstract class AbstractTransformer extends TransformerAbstract
{
    /**
     * @return mixed
     */
    protected function getUser()
    {
        return request()->user();
    }
}