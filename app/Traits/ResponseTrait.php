<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Prettus\Repository\Transformer\ModelTransformer as Transformer;
use Spatie\Fractal\Fractal;

/**
 * Trait ResponseTrait
 *
 * @package App\Traits
 */
trait ResponseTrait
{
    protected $metaData = [];

    public function transform(
        $data,
        $transformerName = null,
        array $includes = [],
        array $meta = [],
        $resourceKey = null
    )
    {
        $transformer = new $transformerName();
        if ($transformerName instanceof Transformer) {
            $transformer = $transformerName;
        }
        $includes = array_unique(array_merge($transformer->getDefaultIncludes(), $includes));

        $transformer->setDefaultIncludes($includes);

        $this->metaData = [
            'include' => $transformer->getAvailableIncludes(),
            'custom'  => $meta,
        ];

        $fractal = Fractal::create($data, $transformer)
            ->withResourceName($resourceKey)
            ->addMeta($this->metaData);

        $request = Request::instance();
        if ($requestIncludes = $request->get('include')) {
            $fractal->parseIncludes($requestIncludes);
        }

        return $fractal->toArray();
    }

    /**
     * @param int $status
     *
     * @return JsonResponse
     */
    public function noContent($status = 204)
    {
        return new JsonResponse(null, $status);
    }

    /**
     * @param       $message
     * @param int   $status
     * @param array $headers
     * @param int   $options
     *
     * @return JsonResponse
     */
    public function json($message, $status = 200, array $headers = [], $options = 0)
    {
        return new JsonResponse($message, $status, $headers, $options);
    }
}