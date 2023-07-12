<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TravelDestinationResource extends JsonResource
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
            "name"          => $this->name,
            "open"          => $this->open,
            "close"         => $this->close,
            "type_ticket"   => $this->type_ticket,
            "type_tour"     => new TourTypeResource($this->typeTour),
            "destination"   => new DestinationPackageResource($this->destination),
            "image"         => asset("storage/travels/".$this->getImage->image)
        ];
    }
}
