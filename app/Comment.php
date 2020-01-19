<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function Composer\Autoload\includeFile;

class Comment extends Model
{

    //Task №5
    public function commentator()
    {
        return $this->belongsTo(User::class, 'commentator_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getAuthor()
    {
        return $this->commentator()
            ->pluck('name')
            ->implode('');
    }

    public function getImageUrl()
    {
        $result = $this->post
            ->image
            ->pluck('url')
            ->implode('');

        return empty($result) ? null : $result;

    }
}
