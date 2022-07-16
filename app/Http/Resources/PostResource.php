<?php

namespace App\Http\Resources;

use App\Models\Like;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this->user);
        return [
        'id' => $this->id,
        'postdescribe' => $this->description,
        'postprofile_img' => setImage($this->user->profile_img, 'user'),
        'image' => $this->image ? setImage($this->image) : null,
        'created' =>setDateTime($this->created_at),
        'user'=> $this->user,
        'comments'=> CommentResource::collection($this->whenLoaded('comments')),
        'likes'=> LikeResource::collection($this->whenLoaded('likes')),
        'like'=> Like::LIKE,
        'love'=> Like::LOVE,
        'sad'=> Like::SAD,
        'haha'=> Like::HAHA,
        'angry'=> Like::ANGRY,
        'wow'=> Like::WOW,
        ];
    }
}
// "id": 1,
//             "user_id": 4,
//             "image": null,
//             "description": "Non minima eligendi qui quo aliquid est sit in. Veritatis sed nihil quia veritatis. Quia quo odit fugit voluptate consequatur est sapiente.",
//             "status": 2,
//             "created_at": "2022-04-01T14:54:07.000000Z",
//             "updated_at": "2022-04-01T14:54:07.000000Z",
//             "deleted_at": null,
//             "user": {
//                 "id": 4,
//                 "created_at": "2022-04-01T14:54:05.000000Z",
//                 "name": "Miss Melissa Moore Jr.",
//                 "profile_img": null
//             },