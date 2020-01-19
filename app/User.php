<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    //Task №5
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'commentator_id');
    }

    public function postLimit($request)
    {
        $limit = $request->has('posts_limit') ?
            $request->get('posts_limit')
            : null;

        if (is_numeric($limit)){
            return $this->posts()
                ->limit($limit)
                ->get();
        }

        return $this->posts()->get();
    }
}
