<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\Http\Requests\CreateChecklistRequest;
use App\Repositories\ChecklistRepository;
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
}
