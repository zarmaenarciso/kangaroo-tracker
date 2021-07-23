<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KangarooResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'weight' => $this->weight,
            'height' => $this->height,
            'gender' => $this->gender,
            'color' => $this->color,
            'friendliness' => $this->friendliness,
            'birthday' => $this->birthday,
        ];
    }
}
