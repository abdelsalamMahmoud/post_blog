<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use ApiResponseTrait;
    public function store(StoreCommentRequest $request, Post $post)
    {
        $comment = Comment::create([
            'content' => $request->get('content'),
            'post_id' => $post->id,
            'user_id' => auth()->id(),
        ]);

        return $this->apiResponse(
            $comment,
            'Comment added successfully',
            201
        );
    }
}
