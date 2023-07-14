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
            'id'                => $this->id,
            'name'              => $this->name,
            'duration'          => $this->duration,
            'destination'       => new DestinationPackageResource($this->destination),
            'type'              => new TourTypeResource($this->typeTour),
            'price'             => $this->price,
            'promo'             => $this->promo_price,
            'desc'              => $this->desc,
            'image'             => asset("storage/tours/". $this->getImage->image),
        ];
    }
}
