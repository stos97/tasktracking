<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRegistrationController
 *
 * @package App\Http\Controllers
 */
class UserRegistrationController extends Controller
{
    use ResponseTrait;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserRegistrationController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserRegistrationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function register(UserRegistrationRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $this->repository->create($data);

        return $this->noContent();
    }
}
