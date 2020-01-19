<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function getCommentsSql($userId)
    {
        $sql = DB::select("SELECT
       comments.content as Comment,
       comments.created_at as Created,
       p.content as Post,
       u.name as Author
FROM public.comments
LEFT JOIN posts p
ON comments.post_id = p.id
LEFT JOIN users u on comments.commentator_id = u.id
WHERE commentator_id = 3
    AND  image_id NOTNULL
    AND u.active = true
ORDER BY Created DESC", [':user_id' => $userId]);
        $query = collect($sql);

        return $query;
    }

    //Task №7.2.1
    public function getCommentsQB($userId)
    {
        $comments = Comment::with(['post' => function ($query) {
            $query->addSelect('id', 'content');
            $query->whereNotNull('image_id');
        },
            'commentator' => function ($query) {
                $query->select('id', 'name');
                $query->where('active', true);
            }
        ])
            ->select('post_id', 'commentator_id', 'content', 'created_at')
            ->where('commentator_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $comments->where('image_id');

        return CommentResource::collection($comments);
    }

}
