<?php

namespace App\Http\Resources;

use DateTime;
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
            "id"            => $this->id,
            "name"          => $this->name,
            "open"          => (new DateTime($this->open))->format('H:i'),
            "close"         => (new DateTime($this->close))->format('H:i'),
            "type_ticket"   => $this->type_ticket,
            "type_tour"     => new TourTypeResource($this->typeTour),
            "destination"   => new DestinationResource($this->destination),
            // "image"         => asset("storage/travels/".$this->getImage->image) ?? ""
        ];
    }
}
