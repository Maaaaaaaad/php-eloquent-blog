<?php

namespace App\actions;

use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;

class Posts
{
    public static function create($user, $params)
    {
        // BEGIN (write your solution here)
        $user = User::find($user);
        $post = $user->posts()->make($params);

        $post->save();

        return $post;
    }

    public static function createLike($user, $post)
    {
        // BEGIN (write your solution here)
        $like = new PostLike();
        $like->creator()->associate($user);
        $like->post()->associate($post);
        $like->save();

        return $like;
        // END
    }
}
