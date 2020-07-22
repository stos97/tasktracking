<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Repositories\TaskRepository;
use App\Traits\ResponseTrait;
use App\Transformers\TaskTransformer;
use Illuminate\Http\Request;

/**
 * Class TaskController
 *
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    use ResponseTrait;

    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * TaskController constructor.
     *
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateTaskRequest $request
     *
     * @return array
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(CreateTaskRequest $request)
    {
        $data = $request->validated();
        $task = $this->repository->create($data);

        return $this->transform($task, TaskTransformer::class);
    }
}
