<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class QuestionResource extends JsonResource
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
            'title' => $this->title,
            'path' =>  $this->path,
            'replies' =>  ReplyResource::collection($this->replies),
            'reply_count' =>  $this->replies->count(),
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'user' => $this->user->name,
            'id' => $this->user_id,
            'slug' => Str::slug($this->title),
        ];
    }
}
