<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function update(User $user, Post $post)
    {
        // admin = role = 1
        if ($user->role === 1) return true;

        // author can update only his own posts
        return $user->id === $post->author_id;
    }

    public function delete(User $user, Post $post)
    {
        if ($user->role === 1) return true;

        return $user->id === $post->author_id;
    }

    public function view(User $user, Post $post)
    {
        return $user->role === 1 || $user->id === $post->author_id;
    }

    public function create(User $user)
    {
        return true; // both admin and author can create
    }
}
