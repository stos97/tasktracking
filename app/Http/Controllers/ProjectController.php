<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Project;
use App\Repositories\ProjectRepository;
use App\Traits\ResponseTrait;
use App\Transformers\ProjectTransformer;

/**
 * Class ProjectController
 *
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    use ResponseTrait;

    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * ProjectController constructor.
     *
     * @param ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateProjectRequest $request
     *
     * @return array
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(CreateProjectRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $project = $this->repository->create($data);

        return $this->transform($project, ProjectTransformer::class);
    }

    /**
     * @param Project $project
     *
     * @return array
     */
    public function get(Project $project)
    {
        return $this->transform($project, ProjectTransformer::class);
    }
}
