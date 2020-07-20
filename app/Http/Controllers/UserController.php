<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    use ResponseTrait;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function meAction(Request $request)
    {
        return $this->transform($request->user(), UserTransformer::class);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->transform($this->repository->paginate(), UserTransformer::class);
    }

    /**
     * @param EditProfileRequest $request
     *
     * @return array
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function editProfile(EditProfileRequest $request)
    {
        $data = $request->validated();
        if ($request->has('password')) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = $this->repository->update($data, $request->user()->id);

        return $this->transform($user, UserTransformer::class);
    }
}
