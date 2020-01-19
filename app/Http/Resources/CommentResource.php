<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'comment' => $this->content,
            'created' => $this->created_at,
            'post' => $this->post->content,
            'image'=> $this->getImageUrl(),
            'author' => optional($this->commentator)->name
        ];
    }
}
