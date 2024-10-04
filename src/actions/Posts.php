<?php

namespace App\actions;

use App\Models\Post;

class Posts
{
    public static function index($user, $limit)
    {
        $posts = Post::all();
        $postsID = $posts->pluck('id');
        $like = $user->postLikes()->get();
        $likePostId = $like->pluck('post_id')->unique()->toArray();


        $likePosts = $posts->intersect(Post::whereIn('id', $likePostId)->get());


        foreach ($posts as $key => $value) {

            $result['post'] = $likePosts->toArray();
            $result['liked'] = true;

/*            if ($value->id == $likePosts->post_id) {

            } else {
                $result['post'] = $value->getAttributes();
                $result['liked'] = false;
            }*/

        }
        dump($result);
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
