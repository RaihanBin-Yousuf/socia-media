<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this);
        return [
            'comment_id' => $this->id,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'comment' => $this->comment,
            'name'=>$this->user->name,
            'profile_img' => setImage($this->user->profile_img, 'user'),
            'created' => setDateTime($this->created_at),
        ];
    }
}
