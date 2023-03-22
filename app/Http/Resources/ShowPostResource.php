<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowPostResource extends JsonResource
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
            'post' => [
                'id' => $this->id,
                'title' => $this->title,
                'content' => $this->content,
                'description' => $this->description,
                'main_image' => $this->main_image,
            ]
        ];
    }
}
