<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PassportRegulationResource extends JsonResource
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
            "adult"         => new AdultResource($this->adult),
            "content"       => $this->content,
        ];
    }
}
