<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    use ResponseTrait;

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function meAction(Request $request)
    {
        return $this->transform($request->user(), UserTransformer::class);
    }
}
