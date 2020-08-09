<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TaskRepository;
use App\Task;
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

    /**
     * @param Task $task
     *
     * @return array
     */
    public function getOne(Task $task)
    {
        return $this->transform($task, TaskTransformer::class);
    }

    /**
     * @param Task              $task
     * @param UpdateTaskRequest $request
     *
     * @return array
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Task $task, UpdateTaskRequest $request)
    {
        $data = $request->only([
            'title',
            'description',
            'checklist_id',
        ]);

        $task = $this->repository->update($data, $task->id);

        if ($request->has('users')) {
            $task->users()->sync($request->users);
        }

        return $this->transform($task, TaskTransformer::class);
    }
}
