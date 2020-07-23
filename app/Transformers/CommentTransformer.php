<?php

namespace App\Transformers;

use App\Comment;

/**
 * Class CommentTransformer
 *
 * @package App\Transformers
 */
class CommentTransformer extends AbstractTransformer
{
    /**
     * @var string[]
     */
    protected $availableIncludes = [
        'user',
    ];

    /**
     * @param Comment $comment
     *
     * @return array
     */
    public function transform(Comment $comment)
    {
        return [
            'id'      => $comment->getRouteKey(),
            'content' => $comment->content,
        ];
    }

    /**
     * @param Comment $comment
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Comment $comment)
    {
        return $this->item($comment->user, new UserTransformer());
    }
}