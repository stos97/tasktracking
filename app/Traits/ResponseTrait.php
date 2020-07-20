<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 * Trait ResponseTrait
 *
 * @package App\Traits
 */
trait ResponseTrait
{
    /**
     * @param int $status
     *
     * @return JsonResponse
     */
    public function noContent($status = 204)
    {
        return new JsonResponse(null, $status);
    }
}