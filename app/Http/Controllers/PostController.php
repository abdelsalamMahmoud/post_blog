<?php

namespace App\Http\Controllers;

use App\Http\Requests\storePostRequest;
use App\Http\Requests\updatePostRequest;
use App\Models\Post;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use apiResponseTrait;
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Post::with('author');

        // search
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // filter by category
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // filter by author
        if ($request->has('author')) {
            $query->where('author_id', $request->author);
        }

        // date range filter
        if ($request->has(['from', 'to'])) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        return $this->apiResponse(
            $query->paginate(10),
            'Posts loaded successfully',
            200
        );
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = auth()->id();

        $post = Post::create($data);

        return $this->apiResponse(
            $post,
            'Post created successfully',
            201
        );
    }

    public function show(Post $post)
    {
        return $this->apiResponse(
            $post->load('author', 'comments.user'),
            'Post loaded successfully',
            200
        );
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->validated());

        return $this->apiResponse(
            $post,
            'Post updated successfully',
            200
        );
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return $this->apiResponse(
            null,
            'Post deleted successfully',
            200
        );
    }
}
