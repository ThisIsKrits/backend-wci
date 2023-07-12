<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TourPackageResource extends JsonResource
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
            'name'              => $this->name,
            'duration'          => $this->duration,
            'destination_id'    => new DestinationPackageResource($this->destination),
            'type_tour_id'      => new TourTypeResource($this->typeTour),
            'price'             => "Rp.".$this->price,
            'promo'             => "Rp.".$this->promo_price,
            'desc'              => $this->desc,
            'image'             => asset("storage/tours/". $this->getImage->image),
        ];
    }
}
