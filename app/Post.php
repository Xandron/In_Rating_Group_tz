<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    //Task №5
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function image()
    {
        return $this->hasMany(Image::class, 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function countOfComments()
    {
        return $this->comments()->count();
    }

    public function getImageUrl()
    {
        $result = $this->image()
            ->pluck('url')
            ->implode('');

        return empty($result) ? null : $result;
    }

}
