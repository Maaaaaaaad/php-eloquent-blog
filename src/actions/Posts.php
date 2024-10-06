<?php

namespace App\actions;

use App\Models\Post;

class Posts
{
    public static function index($user, $limit)
    {
        $posts = Post::limit($limit)->orderBy('created_at', 'desc')->get();

        $likePostIds = $user->postLikes()->pluck('post_id')->unique()->toArray();

        $likePosts = $posts->intersect(Post::whereIn('id', $likePostIds)->get());
        $notLike = $posts->diff($likePosts);



        $result = $posts->map(function ($value) use ($likePosts, $notLike) {
            foreach ($likePosts as $item) {
                if ($value == $item) {
                    return ['post' => $value->toArray(), 'liked' => true];
                }
            }
            foreach ($notLike as $item) {
                if ($value == $item) {
                    return ['post' => $value->toArray(), 'liked' => false];
                }
            }
        });

        return $result->toArray();

    }
    public static function create($user, $params)
    {
        $post = $user->posts()->make($params);
        $post->save();
        return $post;
    }

    public static function createLike($user, $post)
    {
        $like = $post->likes()->make();
        $like->creator()->associate($user);
        $like->save();

        return $like;
        // END
    }
}
