<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketTypesResource extends JsonResource
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
            "id"                => $this->id,
            "adult"             => new AdultResource($this->adult),
            "normal_price"      => $this->normal_price,
            "promo_price"       => $this->promo_price,
            "travel"            => new TravelPackageResource($this->TravelPackage),
        ];
    }
}
