<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\Http\Requests\CreateChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
use App\Project;
use App\Repositories\ChecklistRepository;
use App\Repositories\Criterias\ChecklistCriteria;
use App\Traits\ResponseTrait;
use App\Transformers\ChecklistTransformer;
use Illuminate\Http\Request;

/**
 * Class ChecklistController
 *
 * @package App\Http\Controllers
 */
class ChecklistController extends Controller
{
    use ResponseTrait;

    /**
     * @var ChecklistRepository
     */
    private $repository;

    /**
     * ChecklistController constructor.
     *
     * @param ChecklistRepository $repository
     */
    public function __construct(ChecklistRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateChecklistRequest $request
     *
     * @return array
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(CreateChecklistRequest $request)
    {
        $data = $request->validated();
        $checklist = $this->repository->create($data);

        return $this->transform($checklist, ChecklistTransformer::class);
    }

    /**
     * @param Checklist $checklist
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Checklist $checklist)
    {
        $this->repository->delete($checklist->id);

        return $this->noContent();
    }

    /**
     * @param Checklist              $checklist
     * @param UpdateChecklistRequest $request
     *
     * @return array
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Checklist $checklist, UpdateChecklistRequest $request)
    {
        $data = $request->validated();
        $checklist = $this->repository->update($data, $checklist->id);

        return $this->transform($checklist, ChecklistTransformer::class);
    }

    /**
     * @param Project $project
     *
     * @return array
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getAll(Project $project)
    {
        $this->repository->pushCriteria(new ChecklistCriteria($project));

        return $this->transform($this->repository->paginate(), ChecklistTransformer::class);
    }
}
