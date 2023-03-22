<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\UsersResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MetaPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'page' =>  $this->currentPage(),
            'total_pages' => $this->lastPage(),
            'total_posts' => $this->total(),
            'count' => $this->count(),
            'links' => [
                'next_url' => $this->nextPageUrl(),
                'prev_url' => $this->previousPageUrl()
            ],
            'posts' => PostResource::collection($this),
        ];
    }
}
