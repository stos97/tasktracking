<?php

namespace App\Http\Controllers;

use App\Project;
use App\Repositories\Criterias\ProjectBookmarkCriteria;
use App\Repositories\ProjectRepository;
use App\Traits\ResponseTrait;
use App\Transformers\ProjectTransformer;
use Illuminate\Http\Request;

/**
 * Class ProjectBookmarkController
 *
 * @package App\Http\Controllers
 */
class ProjectBookmarkController extends Controller
{
    use ResponseTrait;

    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * ProjectBookmarkController constructor.
     *
     * @param ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Project $project
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProjectBookmark(Project $project, Request $request)
    {
        $project->bookmarks()->sync($request->user()->id);

        return $this->noContent();
    }

    /**
     * @param Project $project
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeProjectBookmark(Project $project, Request $request)
    {
        $project->bookmarks()->detach($request->user()->id);

        return $this->noContent();
    }

    /**
     * @param Request $request
     *
     * @return array
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getAll(Request $request)
    {
        $this->repository->pushCriteria(new ProjectBookmarkCriteria($request->user()));

        return $this->transform($this->repository->paginate(), ProjectTransformer::class);
    }
}
