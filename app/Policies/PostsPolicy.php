<?php

namespace App\Policies;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostsPolicy
{
    public function modify(User $user, Posts $posts): Response
    {
        return $user->id === $posts->user_id
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }
}
