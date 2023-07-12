<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PassportTypeResource extends JsonResource
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
            "id"        => $this->id,
            "passport_id"   => $this->passport_id,
            "content"   => $this->content,
        ];
    }
}
