<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class UserResource extends JsonResource
{


    public function getPosts(){
       return  $this->posts()->where('active', true)
            ->with(['posts' => function ($query) {
                $query->select('posts.content', DB::raw("COUNT(comments.id) as count"));
                $query->leftJoin("comments","comments.post_id","=","posts.id");
                $query->groupBy('posts.content');
                $query->orderBy('posts.content' , 'desc');
            }]);

    }


    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User
     * @return array
     */
    public function toArray($request)
    {
        $postResource = PostResource::collection($this->postLimit($request));
        $posts = $postResource->collection->sortByDesc('count_of_comments');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'posts' => $posts
        ];

    }
}
