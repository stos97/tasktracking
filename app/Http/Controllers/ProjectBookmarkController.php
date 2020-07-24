<?php

namespace App\Http\Controllers;

use App\Project;
use App\Traits\ResponseTrait;
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
     * @param Project $project
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProjectBookmark(Project $project, Request $request)
    {
        $project->bookmarks()->attach($request->user()->id);

        return $this->noContent();
    }
}
