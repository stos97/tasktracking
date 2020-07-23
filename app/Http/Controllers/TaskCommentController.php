<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Task;
use App\Traits\ResponseTrait;
use App\Transformers\CommentTransformer;
use Illuminate\Http\Request;

/**
 * Class TaskCommentController
 *
 * @package App\Http\Controllers
 */
class TaskCommentController extends Controller
{
    use ResponseTrait;

    /**
     * @param Task           $task
     * @param CommentRequest $request
     *
     * @return array
     */
    public function addComment(Task $task, CommentRequest $request)
    {
        $comment          = new Comment();
        $comment->content = $request->get('content');
        $comment->user_id = $request->user()->id;

        $comment = $task->comments()->save($comment);

        return $this->transform($comment, CommentTransformer::class);
    }

    /**
     * @param Task    $task
     * @param Comment $comment
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Task $task, Comment $comment)
    {
        $comment->delete();

        return $this->noContent();
    }
}
